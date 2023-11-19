<?php
namespace App\Services;

use App\Repositories\Product\ProductRepositoryInterface;
use App\Traits\HandleImage;
use Illuminate\Support\Str;

class ProductService
{
    use HandleImage;

    protected ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function store($request)
    {
        $data = $request->all();
        $data['thumbnail'] = $this->storeImage($request);
        $product = $this->productRepository->create($data);
        $product->addCategories($request->category_ids);

        return $product;
    }

    public function update($request, $id)
    {
        $data = $request->all();
        $product = $this->productRepository->find($id);
        $data['thumbnail'] = $this->updateImage($request, $product->thumbnail);
        $product->update($data);
        $product->syncCategories($request->category_ids);

        return $product;
    }

    public function paginate($perPage = 10)
    {
        return $this->productRepository->paginate($perPage);
    }

    public function findWithRelationship($id)
    {
        return $this->productRepository->findWithRelationship($id, 'categories');
    }

    public function delete($id)
    {
        $product = $this->productRepository->find($id);
        $product->delete();
        $this->deleteImage($product->thumbnail);

        return $product;
    }

    public function getBestSeller($limit = 8)
    {
        return $this->productRepository->getByLimit($limit);
    }

    public function getNew($limit = 8)
    {
        $products = $this->productRepository->getByLimit($limit);
        return $products->filter(function ($product) {
            return now()->diffInDays($product->created_at) <= 4;
        });
    }

    public function getHotSales($limit = 8)
    {
        return $this->productRepository->getHotSales($limit);
    }

    public function getByCategorySlug($slugCategory)
    {
        $dataFilter = [];
        $dataFilter['brand'] = request()->brand;
        $dataFilter['name'] = request()->name;
        $dataFilter['sort'] = request()->sort;
        return $this->productRepository->getByCategorySlug($slugCategory, $dataFilter);
    }

    public function getIfHasCategory()
    {
        $dataFilter = [];
        $dataFilter['brand'] = request()->brand;
        $dataFilter['name'] = request()->name;
        $dataFilter['sort'] = request()->sort;

        return $this->productRepository->getIfHasCategory($dataFilter);
    }

    public function findBySlug($slug)
    {
        return $this->productRepository->findBySlug($slug) ?? abort(404);
    }

    public function getBrand()
    {
        return $this->productRepository->getBrand();
    }

    public function count()
    {
        return $this->productRepository->count();
    }
}
