<?php

namespace App\View\composers;

use App\Services\CategoryService;
use Illuminate\View\View;

class CategoryComposer
{
    protected CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function compose(View $view)
    {
        $categories = $this->categoryService->all();
        $categoriesFooter = $this->categoryService->getByLimit(4);
        $view->with([
            'categories' => $categories,
            'categoriesFooter' => $categoriesFooter
        ]);
    }
}
