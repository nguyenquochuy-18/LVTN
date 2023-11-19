@extends('admin.layouts.master')
@section('content')
    @include('admin.messages.message')
    <div class="row">
        <div class="col-sm-12">
            <h1 class="h3 mb-2 text-gray-800">Quản lý Danh Mục Sản Phẩm</h1>
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
                        <th>Người đặt đơn</th>
                        <th>Số điện thoại</th>
                        <th>Ngày đặt</th>
                        <th>Tổng (vnd)</th>
                        <th class="text-center">Phương thức</th>
                        <th>Trạng thái</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($orders as $order)
                        <tr>
                            <td>{{ $loop->iteration + $orders->firstItem() - 1 }}</td>
                            <td>{{ $order->user->name }}</td>
                            <td>{{ $order->user->phone }}</td>
                            <td>{{ $order->created_at->format('H:s:i, d-m-Y') }}</td>
                            <td>{{ number_format($order->order_total) }}</td>
                            <td class="text-center">
                                @php $type = get_type_payment($order->type_payment); @endphp
                                <span class="badge badge-{{ $type['class'] }}">{{ $type['message'] }}</span>
                            </td>
                            <td>{!! get_status($order->status) !!}</td>
                            <td>
                                <div class="d-flex align-items-center justify-content-center">
                                    <a href="{{ route('admin.orders.show', $order->order_code) }}" class="btn btn-success btn-circle mr-2">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Chưa có đơn hàng nào</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                <div class="paginate d-flex justify-content-end">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('js/admin/category/category.js') }}"></script>
@endpush

