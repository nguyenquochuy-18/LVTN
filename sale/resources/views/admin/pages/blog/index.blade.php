@extends('admin.layouts.master')
@section('content')
    @include('admin.messages.message')
    <div class="row">
        <div class="col-sm-6">
            <h1 class="h3 mb-2 text-gray-800">Quản lý Blog</h1>
        </div>
        <div class="col-sm-6 text-right">
            <a href="{{ route('admin.blogs.create') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-pencil-alt"></i>
                Viết Blog
            </a>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">#</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Tiêu để</th>
                        <td class="text-center">Thumbnail</td>
                        <th>Ngày tạo</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse ($blogs as $blog)
                            <tr>
                                <td>{{ $loop->iteration + $blogs->firstItem() - 1 }}</td>
                                <td>{{ $blog->title }}</td>
                                <td class="text-center"><img src="{{ get_image_product($blog->thumbnail) }}" alt="" width="50" height="50"></td>
                                <td>{{ $blog->created_at }}</td>
                                <td>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <a href="{{ route('admin.blogs.edit', $blog->id) }}"
                                           class="btn btn-warning btn-circle mr-2">
                                            <i class="fa fa-pencil-alt"></i>
                                        </a>
                                        <button class="btn btn-danger btn-circle">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Chưa có blog nào</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="paginate d-flex justify-content-end">
                    {{ $blogs->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection


