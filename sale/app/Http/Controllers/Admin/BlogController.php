<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BlogStoreRequest;
use App\Http\Requests\Admin\BlogUpdateRequest;
use App\Services\BlogService;
use App\Services\UploadService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    protected UploadService $uploadService;
    protected BlogService $blogService;

    public function __construct(UploadService $uploadService, BlogService $blogService)
    {
        $this->uploadService = $uploadService;
        $this->blogService = $blogService;
    }

    public function index()
    {
        $blogs = $this->blogService->paginate();
        return view('admin.pages.blog.index', compact('blogs'));
    }

    public function create()
    {
        return view('admin.pages.blog.create');
    }

    public function store(BlogStoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $this->blogService->store($request);
            DB::commit();

            return redirect()->route('admin.blogs.index')->with('message-success', 'thêm blog thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.blogs.index')->with('message-failed', 'thêm blog thất bại!');
        }
    }

    public function edit($id)
    {
        $blog = $this->blogService->find($id);
        return view('admin.pages.blog.edit', compact('blog'));
    }

    public function update(BlogUpdateRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $this->blogService->update($request, $id);
            DB::commit();

            return redirect()->route('admin.blogs.index')->with('message-success', 'sửa blog thành công!');
        } catch (\Exception $e) {
            return redirect()->route('admin.blogs.index')->with('message-failed', 'sửa blog thất bại!');
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $this->blogService->delete($id);
            DB::commit();

            return \response()->json([
                'status' => Response::HTTP_OK,
                'message' => 'xoá thành công'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return \response()->json([
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'xoá thất bại'
            ]);
        }
    }

    public function uploadCkeditor(Request $request)
    {
        try {
            echo $this->uploadService->uploadCkeditor($request);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR
            ]);
        }
    }
}
