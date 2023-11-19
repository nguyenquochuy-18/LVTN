@extends('user.layouts.master')
@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Giỏ hàng của {{ auth()->user()->name }}</h4>
                        <div class="breadcrumb__links">
                            <a href="{{ route('home.index') }}">Trang chủ</a>
                            <span>Giỏ hàng</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            @include('user.auth.message')
            <div class="row">
                <div class="col-lg-8">
                    <form action="{{ route('cart.update.quantity') }}" method="POST" id="form-update-cart">
                        @csrf
                        <div class="shopping__cart__table">
                            <table id="table-cart">
                                <thead>
                                    <tr>
                                        <th>Sản phẩm</th>
                                        <th>Số lượng</th>
                                        <th>Tổng</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($cartUserCurrentLogin as $cart)
                                        <tr>
                                            <td class="product__cart__item">
                                                <div class="product__cart__item__pic">
                                                    <img src="{{ get_image_product($cart->product->thumbnail) }}"
                                                        alt="" width="90" height="90">
                                                </div>
                                                <div class="product__cart__item__text">
                                                    <h6>{{ $cart->product->name }}</h6>
                                                    <h5>{{ number_format($cart->product->price) . '₫' }}</h5>
                                                </div>
                                            </td>
                                            <td class="quantity__item">
                                                <div class="quantity">
                                                    <div class="pro-qty-2">
                                                        <input type="text" data-id="{{ $cart->id }}"
                                                            value="{{ $cart->quantity }}" class="input-quantity" name="carts[{{ $cart->id }}]">
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="cart__price">
                                                {{ number_format($cart->product->price * $cart->quantity) . '₫' }}</td>
                                            <td class="cart__close">
                                                <i class="fa fa-close cart-delete"
                                                    data-route="{{ route('cart.delete', $cart->id) }}"
                                                    style="cursor: pointer">
                                                </i>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4">
                                                <p class="text-center">Chưa sản phẩm nào được thêm!</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="continue__btn">
                                    <a href="{{ route('shop.index') }}">Tiếp tục mua hàng</a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="continue__btn update__btn">
                                    <button type="submit">Cập nhật giỏ hàng</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4">
                    <div class="cart__total">
                        <h6>Tổng tiền</h6>
                        <ul>
                            <li>Total <span>{{ number_format($total) . '₫' }}</span></li>
                        </ul>
                        <a href="{{ route('cart.payment') }}" class="primary-btn">Thanh toán</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->
@endsection
