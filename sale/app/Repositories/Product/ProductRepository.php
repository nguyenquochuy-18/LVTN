<?php

namespace App\Repositories\Product;

use App\Repositories\Base\BaseRepository;
use App\Models\Product;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    public function getByLimit($limit)
    {
        return $this->model->orderBy('created_at', 'DESC')->take($limit)->get();
    }

    public function getHotSales($limit)
    {
        return $this->model->whereNotNull('discount')->orderBy('discount', 'DESC')->take($limit)->get();
    }

    public function getByCategorySlug($slugCategory, $dataFilter)
    {   
        return $this->model->categorySlug($slugCategory)
            ->withBrand($dataFilter['brand'])
            ->withName($dataFilter['name'])
            ->sortPrice($dataFilter['sort'])
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
    }

    public function getIfHasCategory($dataFilter)
    {   
        return $this->model->has('categories')
            ->withBrand($dataFilter['brand'])
            ->withName($dataFilter['name'])
            ->sortPrice($dataFilter['sort'])
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
    }

    public function findBySlug($slug)
    {   
        return $this->model->where('slug', $slug)->with('categories')->first();
    }

    public function getByIds($ids)
    {
        return $this->model->whereIn('id', $ids)->get();
    }

    public function getBrand()
    {
        return $this->model->whereNotNull('brand')->distinct()->get()->pluck('brand')->unique();
    }
}
