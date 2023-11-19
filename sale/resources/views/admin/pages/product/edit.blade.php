@extends('admin.layouts.master')
@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin/product/create.css') }}">
@endpush
@section('content')
    <div class="row">
        <div class="col-sm-6">
            <h1 class="h3 mb-2 text-gray-800">{{ $product->name }}</h1>
        </div>
        <div class="col-sm-6 text-right">
            <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-arrow-left"></i>
                Quay lại
            </a>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form chỉnh sửa thông tin</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Tên sản phẩm</label>
                            <input type="text" class="form-control" name="name" value="{{ $product->name }}">
                            @error('name')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Giá</label>
                            <input type="text" class="form-control" name="price" value="{{ $product->price }}">
                            @error('price')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Giảm giá (%)</label>
                            <input type="text" class="form-control" name="discount" value="{{ $product->discount }}">
                            @error('discount')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Thương hiệu</label>
                            <input type="text" class="form-control" name="brand" value="{{ $product->brand }}">
                            @error('brand')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                  <label>Mô tả</label>
                  <textarea type="text" class="form-control" name="description">{{$product->description}}</textarea>
                </div>

                <div class="form-group">
                    <label>Thuộc danh mục</label>
                    <select name="category_ids[]" id="categories-product" class="form-control" data-live-search="true" multiple>
                        @php
                            $categoryIds = $product->categories->pluck('id')->toArray();
                        @endphp
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @if(in_array((int)$category->id, $categoryIds)) selected @endif>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="d-block">Thumbnail</label>
                    <input type="file" name="image"/>
                </div>

                <button type="submit" class="btn btn-sm btn-primary">Cập nhật</button>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script src="{{ asset('js/admin/product/product.js') }}"></script>
@endpush
