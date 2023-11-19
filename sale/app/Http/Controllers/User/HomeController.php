<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\BlogService;
use App\Services\CategoryService;
use App\Services\ProductService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected CategoryService $categoryService;
    protected ProductService $productService;
    protected BlogService $blogService;

    public function __construct(CategoryService $categoryService, ProductService $productService, BlogService $blogService)
    {
        $this->categoryService = $categoryService;
        $this->productService = $productService;
        $this->blogService = $blogService;
    }

    public function index()
    {
        $categoriesBanner = $this->categoryService->getByLimit();
        $productsBestSeller = $this->productService->getBestSeller();
        $productsNewArrivals = $this->productService->getNew();
        $productsHotSales = $this->productService->getHotSales();
        $blogsTrend = $this->blogService->getTrend();

        return view('user.pages.home.index', compact(
            'categoriesBanner',
            'productsBestSeller',
            'productsNewArrivals',
            'productsHotSales',
            'blogsTrend'
        ));
    }


}
