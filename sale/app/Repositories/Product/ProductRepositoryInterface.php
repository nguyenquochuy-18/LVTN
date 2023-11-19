<?php
namespace App\Repositories\Product;

interface ProductRepositoryInterface
{
    public function getByLimit($limit);

    public function getHotSales($limit);

    public function getByCategorySlug($slugCategory, $dataFiler);

    public function getIfHasCategory($dataFiler);

    public function findBySlug($slug);

    public function getByIds($ids);

    public function getBrand();
}
