@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-sm-6">
            <h1 class="h3 mb-2 text-gray-800">Viết Blog</h1>
        </div>
        <div class="col-sm-6 text-right">
            <a href="{{ route('admin.blogs.index') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-arrow-left"></i>
                Quay lại
            </a>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">#</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.blogs.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Tiêu đề</label>
                    <input type="text" class="form-control" name="title" />
                    @error('title')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <textarea id="content-blog" name="content" class="form-control"></textarea>
                    @error('content')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="d-block">Thumbnail</label>
                    <input type="file" name="image">
                </div>
                <button type="submit" class="btn btn-sm btn-primary">Thêm</button>
            </form>
        </div>
    </div>
    <input type="hidden" name="route-upload-ckeditor" data-route="{{ route('admin.blogs.upload.ckeditor', ['_token' => csrf_token()]) }}">
@endsection

@push('js')
    <script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/admin/blog/blog.js') }}"></script>
@endpush
