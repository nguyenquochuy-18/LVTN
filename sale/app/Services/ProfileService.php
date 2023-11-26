<?php
namespace App\Services;

use App\Models\Admin;
use App\Repositories\Base\BaseRepository;
use App\Repositories\Profile\ProfileRepositoryInterface;
use Illuminate\Support\Str;
use App\Traits\HandleImage;

class ProfileService {

    use HandleImage;

    protected $profileRepository;

    public function __construct(ProfileRepositoryInterface $profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }

    public function store($request)
    {
        $data = $request->all();
        $data['thumbnail'] = $this->storeImage($request);
        $product = $this->profileRepository->create($data);
        $product->addCategories($request->category_ids);

        return $product;
    }

    public function update($request, $id)
    {
        $data = $request->all();
        $product = $this->profileRepository->find($id);
        $data['thumbnail'] = $this->updateImage($request, $product->thumbnail);
        $product->update($data);
        $product->syncCategories($request->category_ids);

        return $product;
    }

    public function paginate($perPage = 10)
    {
        return $this->profileRepository->paginate($perPage);
    }

    public function findWithRelationship($id)
    {
        return $this->profileRepository->findWithRelationship($id, 'categories');
    }

    public function delete($id)
    {
        $product = $this->profileRepository->find($id);
        $product->delete();
        $this->deleteImage($product->thumbnail);

        return $product;
    }

    public function getBestSeller($limit = 8)
    {
        return $this->profileRepository->getByLimit($limit);
    }

    public function getNew($limit = 8)
    {
        $products = $this->profileRepository->getByLimit($limit);
        return $products->filter(function ($product) {
            return now()->diffInDays($product->created_at) <= 4;
        });
    }

    public function getHotSales($limit = 8)
    {
        return $this->profileRepository->getHotSales($limit);
    }

    public function getByCategorySlug($slugCategory)
    {
        $dataFilter = [];
        $dataFilter['brand'] = request()->brand;
        $dataFilter['name'] = request()->name;
        $dataFilter['sort'] = request()->sort;
        return $this->profileRepository->getByCategorySlug($slugCategory, $dataFilter);
    }

    public function getIfHasCategory()
    {
        $dataFilter = [];
        $dataFilter['brand'] = request()->brand;
        $dataFilter['name'] = request()->name;
        $dataFilter['sort'] = request()->sort;

        return $this->profileRepository->getIfHasCategory($dataFilter);
    }

    public function findBySlug($slug)
    {
        return $this->profileRepository->findBySlug($slug) ?? abort(404);
    }

    public function getBrand()
    {
        return $this->profileRepository->getBrand();
    }

    public function count()
    {
        return $this->profileRepository->count();
    }
}
