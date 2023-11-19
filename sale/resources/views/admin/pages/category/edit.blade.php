@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-sm-6">
            <h1 class="h3 mb-2 text-gray-800">{{ $category->name }}</h1>
        </div>
        <div class="col-sm-6 text-right">
            <a href="{{ route('admin.categories.index') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-arrow-left"></i>
                Quay lại
            </a>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form điền thông tin</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.categories.update', $category->id) }}">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Tên danh mục</label>
                            <input type="text" class="form-control" name="name" value="{{ $category->name }}">
                            @error('name')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-sm btn-primary">Cập nhật</button>
            </form>
        </div>
    </div>
@endsection
