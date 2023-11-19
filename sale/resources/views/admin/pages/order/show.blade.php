@extends('admin.layouts.master')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/order/style.css') }}">
@endpush
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h1 class="h3 mb-2 text-gray-800">Chi tiết đơn hàng</h1>
        </div>
    </div>
    <div class="card shadow mb-4 ">
        <article class="card">
            <header class="card-header"> # </header>
            <div class="card-body">
                <h6>Mã đơn hàng: {{ $order->order_code }}</h6>
                <article class="card">
                    <div class="card-body row">
                        <div class="col"> <strong>Người đặt</strong> <br>{{ $order->user->name }} </div>
                        <div class="col"> <strong>Số điện thoại:</strong> <br> <i class="fa fa-phone"></i>
                            {{ $order->user->phone }} </div>
                        <div class="col"> <strong>phương thức thành toán:</strong> <br>
                            {{ get_type_payment($order->type_payment)['message'] }} </div>
                        <div class="col"> <strong>Tổng:</strong> <br> {{ number_format($order->order_total) . 'đ' }}
                        </div>
                        <div class="col">
                            <strong>Trạng thái:</strong> <br>
                            @if ($order->status)
                                {!! get_status($order->status) !!}
                            @else
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="btn-status"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {!! get_status($order->status) !!}
                                        <i class="fa fa-caret-down"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="btn-status" id="dropdown-status">
                                        <a class="dropdown-item" href="javascript:;" data-status="1"
                                            data-id="{{ $order->id }}">Đã giao</a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </article>
                <hr>
                <ul class="row">
                    @foreach ($products as $product)
                        <li class="col-md-4">
                            <figure class="itemside mb-3">
                                <a href="#" class="aside"><img
                                        src="{{ get_image_product($product['detail']->thumbnail) }}"
                                        class="img-sm border"></a>
                                <figcaption class="info align-self-center">
                                    <p class="title">{{ $product['detail']->name }} (x{{ $product['quantity'] }})</p>
                                    @if ($product['detail']->discount)
                                        <span
                                            class="">{{ get_price_sale($product['detail']->discount, $product['detail']->price) . '₫' }}</span>
                                        <span
                                            class="text-muted text-decoration-line-through">{{ number_format($product['detail']->price) . '₫' }}
                                        </span>
                                    @else
                                        <span class="text-muted">{{ number_format($product['detail']->price) . '₫' }}
                                        </span>
                                    @endif
                                </figcaption>
                            </figure>
                        </li>
                    @endforeach
                </ul>
                <hr>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-warning btn-back" data-abc="true"> <i
                        class="fa fa-chevron-left"></i> quay lại</a>
            </div>
        </article>
    </div>
    <input type="hidden" id="route-update-status" data-route="{{ route('admin.orders.update.status') }}">
@endsection

@push('js')
    <script src="{{ asset('js/admin/order/order.js') }}"></script>
@endpush
