<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductStoreRequest;
use App\Http\Requests\Admin\ProductUpdateReuqest;
use App\Services\CategoryService;
use App\Services\ProductService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    protected ProductService $productService;
    protected CategoryService $categoryService;

    public function __construct(ProductService $productService, CategoryService $categoryService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $products = $this->productService->paginate();

        return view('admin.pages.product.index', compact('products'));
    }

    public function create()
    {
        $categories = $this->categoryService->all();
        return view('admin.pages.product.create', compact('categories'));
    }

    public function store(ProductStoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $this->productService->store($request);
            DB::commit();

            return redirect()->route('admin.products.index')->with('message-success', 'Thêm sản phẩm thành công!');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.products.index')->with('message-failed', 'Thêm sản phẩm thất bại!');
        }
    }

    public function edit($id)
    {
        $categories = $this->categoryService->all();
        $product = $this->productService->findWithRelationship($id);

        return view('admin.pages.product.edit', compact('categories', 'product'));
    }

    public function update(ProductUpdateReuqest $request, $id)
    {
        try {
            DB::beginTransaction();
            $this->productService->update($request, $id);
            DB::commit();

            return redirect()->route('admin.products.index')->with('message-success', 'sửa sản phẩm thành công!');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.products.index')->with('message-failed', 'sửa sản phẩm thất bại!');
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $this->productService->delete($id);
            DB::commit();

            return response()->json([
                'status' => Response::HTTP_OK,
                'message' => 'xoá sản phẩm thành công!'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'xoá sản phẩm thất bại!'
            ]);
        }
    }
}
