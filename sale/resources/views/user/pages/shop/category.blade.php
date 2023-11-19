@extends('user.layouts.master')
@push('css')
    <style>
        .active {
            color: #111111 !important;
        }
    </style>   
@endpush
@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Sản phẩm</h4>
                        <div class="breadcrumb__links">
                            <a href="{{ route('home.index') }}">Trang chủ</a>
                            @isset($category)
                                <a href="">Sản phẩm</a>
                                <span>{{  $category->name }}</span>
                            @else
                                <span>Sản phẩm</span>
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shop Section Begin -->
    <section class="shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    @include('user.pages.shop.sidebar')
                </div>
                <div class="col-lg-9">
                    <div class="shop__product__option">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="shop__product__option__right">
                                    <form action="" method="GET" id="form-sort">
                                        <p>Sắp xếp theo giá:</p>   
                                        <select name="sort">
                                            <option value="" selected>Tùy chọn</option>
                                            <option value="ASC" @if(request()->sort === 'ASC') selected @endif>Thấp đến cao</option>
                                            <option value="DESC" @if(request()->sort === 'DESC') selected @endif>Cao đến thấp</option>
                                        </select>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @forelse ($products as $product)
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="{{ get_image_product($product->thumbnail) }}">
                                    <ul class="product__hover">
                                        <li><a href="javascript:;" class="add-cart"><img src="{{ asset('img/icon/heart.png') }}" alt=""></a></li>
                                        <li>
                                            <a href="{{ route('shop.detail', $product->slug) }}">
                                                <img src="{{ asset('img/icon/search.png') }}" alt="">
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6>{{ $product->name }}</h6>
                                    <button class="add-cart" data-id="{{ $product->id }}" data-price="{{ $product->price }}">+ thêm vào giỏ hàng</button>
                                    <h5>{{ number_format($product->price). '₫' }}</h5>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <p class="text-center">Hiện chưa có sản phẩm nào</p>
                        </div>
                        @endforelse
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="d-flex justify-content-center" id="custom-paginate">
                                {{ $products->onEachSide(1)->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Section End -->
@endsection

@push('js')
    <script>
        if({{ session()->has('message-warning') ? 'true': 'false' }}) {
            toastr.warning('{{ session()->get('message-warning') }}');
        }
    </script>
    <script src="{{ asset('js/user/product/category.js') }}"></script>
@endpush
