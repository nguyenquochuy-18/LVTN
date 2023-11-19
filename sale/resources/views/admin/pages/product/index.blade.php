@extends('admin.layouts.master')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/table/dataTables.bootstrap4.min.css') }}">
@endpush
@section('content')
    @include('admin.messages.message')
    <div class="row">
        <div class="col-sm-6">
            <h1 class="h3 mb-2 text-gray-800">Quản lý Sản Phẩm</h1>
        </div>
        <div class="col-sm-6 text-right">
            <a href="{{ route('admin.products.create') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus-circle"></i>
                Thêm sản phẩm
            </a>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Bảng thống kê</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá thành</th>
                            <th class="text-center">Ảnh mô tả</th>
                            <th>Ngày tạo</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td>{{ $loop->iteration + $products->firstItem() - 1 }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td class="text-center"><img src="{{ get_image_product($product->thumbnail) }}"
                                        alt="thumbnail" width="70" height="70"></td>
                                <td>{{ $product->created_at }}</td>
                                <td>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <a href="{{ route('admin.products.edit', $product->id) }}"
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
                                <td colspan="6" class="text-center">Chưa có sản phẩm nào</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="paginate d-flex justify-content-end">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
