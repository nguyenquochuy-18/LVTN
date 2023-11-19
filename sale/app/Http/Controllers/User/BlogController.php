<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\BlogService;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    protected BlogService $blogService;

    public function __construct(BlogService $blogService)
    {
        $this->blogService = $blogService;
    }

    public function index()
    {
        $blogs = $this->blogService->paginate();
        return view('user.pages.blog.index', compact('blogs'));
    }

    public function detail($slug)
    {
        $blog = $this->blogService->findBySlug($slug);
        return view('user.pages.blog.detail', compact('blog'));
    }
}
