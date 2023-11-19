<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryStoreRequest;
use App\Http\Requests\Admin\CategoryUpdateRequest;
use App\Services\CategoryService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    protected CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        $categories = $this->categoryService->paginate();
        return view('admin.pages.category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.pages.category.create');
    }

    public function store(CategoryStoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $this->categoryService->store($request);
            DB::commit();

            return redirect()->route('admin.categories.index')->with('message-success', 'thêm danh mục thành công!');
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->route('admin.categories.index')->with('message-failed', 'thêm danh mục thất bại!');
        }
    }

    public function edit($id)
    {
        $category = $this->categoryService->find($id);
        return view('admin.pages.category.edit', compact('category'));
    }

    public function update(CategoryUpdateRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $this->categoryService->update($request, $id);
            DB::commit();

            return redirect()->route('admin.categories.index')->with('message-success', 'cập nhật danh mục thành công!');
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->route('admin.categories.index')->with('message-failed', 'cập nhật danh mục thất bại!');
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $this->categoryService->delete($id);
            DB::commit();

            return response()->json([
                'status' => Response::HTTP_OK,
                'message' => 'xoá danh mục thành công!'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'xoá danh mục thất bại!'
            ]);
        }
    }
}
