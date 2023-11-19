<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\CartService;
use App\Services\CategoryService;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


class ShopController extends Controller
{
    protected CategoryService $categoryService;
    protected ProductService $productService;
    protected CartService $cartService;

    public function __construct(CategoryService $categoryService, ProductService $productService, CartService $cartService)
    {
        $this->categoryService = $categoryService;
        $this->productService = $productService;
        $this->cartService = $cartService;
        View::share([
            'categoriesSidebar' => $this->categoryService->getAllWithRelationship(),
            'brands' => $this->productService->getBrand()
        ]);
    }

    public function index()
    {
        $products = $this->productService->getIfHasCategory();

        return view('user.pages.shop.category', compact(
            'products',
        ));
    }

    public function category($slug)
    {
        $category = $this->categoryService->findBySlug($slug);
        $products = $this->productService->getByCategorySlug($category->slug);
 
        return view('user.pages.shop.category', compact(
            'category',
            'products',
            'slug'
        ));
    }

    public function detail($slug)
    {
        $product = $this->productService->findBySlug($slug);
        
        return view('user.pages.shop.detail', compact('product'));
    }
}
