@extends('user.layouts.master')
@section('content')
    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="hero__slider owl-carousel">
            <div class="hero__items set-bg" data-setbg="img/hero/hero-1.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-5 col-lg-7 col-md-8">
                            <div class="hero__text">
                                <h6>Bộ siêu tập mới</h6>
                                <h2>Bộ siêu tập thu đông 2022</h2>
                                <p>Những item cần thiết cho mùa đông năm nay. thiết kế hot trend với số lượng giới hạn</p>
                                <a href="#" class="primary-btn">Mua ngay <span class="arrow_right"></span></a>
                                <div class="hero__social">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hero__items set-bg" data-setbg="img/hero/hero-2.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-5 col-lg-7 col-md-8">
                            <div class="hero__text">
                                <h6>big sale</h6>
                                <h2>Sale up to 70% toàn bộ sản phẩm</h2>
                                <p>năm cũ sắp kết thúc, Tailo shop giảm giá mạnh các sản phẩm của cửa hàng đòn chào năm mới
                                    đang đến</p>
                                <a href="#" class="primary-btn">Mua ngay <span class="arrow_right"></span></a>
                                <div class="hero__social">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Banner Section Begin -->
    <section class="banner spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 offset-lg-4">
                    <div class="banner__item">
                        <div class="banner__item__pic">
                            <img src="{{ asset('img/banner/banner-1.jpg') }}" alt="">
                        </div>
                        <div class="banner__item__text">
                            <h2>{{ $categoriesBanner[0]->name }}</h2>
                            <a href="#">mua ngay</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="banner__item banner__item--middle">
                        <div class="banner__item__pic">
                            <img src="{{ asset('img/banner/banner-2.jpg') }}" alt="">
                        </div>
                        <div class="banner__item__text">
                            <h2>{{ $categoriesBanner[1]->name }}</h2>
                            <a href="#">mua ngay</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="banner__item banner__item--last">
                        <div class="banner__item__pic">
                            <img src="{{ asset('img/banner/banner-3.jpg') }}" alt="">
                        </div>
                        <div class="banner__item__text">
                            <h2>{{ $categoriesBanner[2]->name }}</h2>
                            <a href="#">mua ngay</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="filter__controls">
                        <li class="active" data-filter=".best-seller">Bán Chạy</li>
                        <li data-filter=".new-arrivals">Sản Phẩm Mới</li>
                        <li data-filter=".hot-sales">Hot Sales</li>
                    </ul>
                </div>
            </div>
            <div class="row product__filter">
                @foreach ($productsBestSeller as $product)
                    <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix best-seller">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="{{ get_image_product($product->thumbnail) }}">
                            <ul class="product__hover">
                                <li><a href="#"><img src="{{ asset('img/icon/cart.png') }}" alt=""></a></li>
                                <li><a href="{{ route('shop.detail', $product->slug) }}"><img src="{{ asset('img/icon/search.png') }}" alt=""></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6>{{ $product->name }}</h6>
                            <button class="add-cart" data-id="{{ $product->id }}" data-price="{{ $product->price }}">+ Thêm vào giỏ hàng</button>
                            <h5>{{ number_format($product->price). ' ₫' }}</h5>
                        </div>
                    </div>
                </div>
                @endforeach
                @foreach ($productsNewArrivals as $productNew)
                    <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix new-arrivals" style="display: none">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="{{ get_image_product($productNew->thumbnail) }}">
                                    <span class="label">New</span>
                                    <ul class="product__hover">
                                        <li><a href="#"><img src="{{ asset('img/icon/cart.png') }}" alt=""></a></li>
                                        <li><a href="{{ route('shop.detail', $productNew->slug) }}"><img src="{{ asset('img/icon/search.png') }}" alt=""></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6>{{ $productNew->name }}</h6>
                                    <button class="add-cart" data-id="{{ $productNew->id }}" data-price="{{ $productNew->price }}">+ Thêm vào giỏ hàng</button>
                                    <h5>{{ number_format($productNew->price) . ' ₫' }}</h5>
                                </div>
                            </div>
                        </div>
                @endforeach
                @foreach($productsHotSales as $productSale)
                    <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix hot-sales" style="display: none">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="{{ get_image_product($productSale->thumbnail) }}">
                                <span class="label">sale {{ $productSale->discount }} %</span>
                                <ul class="product__hover">
                                    <li><a href="#"><img src="{{ asset('img/icon/cart.png') }}" alt=""></a></li>
                                    <li><a href="{{ route('shop.detail', $productSale->slug) }}"><img src="{{ asset('img/icon/search.png') }}" alt=""></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6>{{ $productSale->name }}</h6>
                                <button class="add-cart" data-id="{{ $productSale->id }}" data-price="{{ $productSale->price }}">+ thêm vào giỏ hàng</button>
                                <h5>{{ get_price_sale($productSale->discount, $productSale->price) . ' ₫' }}</h5>
                            </div>
                        </div>
                    </div >
                @endforeach
            </div>
        </div>
    </section>
    <!-- Product Section End -->

    <!-- Instagram Section Begin -->
    <section class="instagram spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="instagram__pic">
                        <div class="instagram__pic__item set-bg" data-setbg="{{ asset('img/instagram/instagram-1.jpg') }}"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="{{ asset('img/instagram/instagram-2.jpg') }}"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="{{ asset('img/instagram/instagram-3.jpg') }}"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="{{ asset('img/instagram/instagram-4.jpg') }}"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="{{ asset('img/instagram/instagram-5.jpg') }}"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="{{ asset('img/instagram/instagram-6.jpg') }}"></div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="instagram__text">
                        <h2>Instagram</h2>
                        <p>Ghé qua instagram của chúng tôi, để xem những tấm ảnh chất của các bạn gửi về nhé.</p>
                        <h3 data-href="https://www.instagram.com/tailoshop/" id="btn-instagram" style="cursor: pointer">#Tailo_Shop</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Instagram Section End -->

    <!-- Latest Blog Section Begin -->
    <section class="latest spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>BLog mới</span>
                        <h2>Fashion New Trends</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($blogsTrend as $blog)
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="blog__item">
                            <div class="blog__item__pic set-bg" data-setbg="{{ get_image_product($blog->thumbnail) }}"></div>
                            <div class="blog__item__text">
                                <span><img src="{{ asset('img/icon/calendar.png') }}" alt=""> 16 February 2020</span>
                                <h5>{{ $blog->title }}</h5>
                                <a href="{{ route('blog.detail', $blog->slug) }}">Xem thêm</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Latest Blog Section End -->

@endsection

@push('js')
    <script>
        $('#btn-instagram').on('click', function (){
            window.open($(this).data('href'), '_blank')
        })
        if({{ session()->has('message-success') ? 'true' : 'false' }}) {
            Swal.fire({
                icon: 'success',
                text: '{{ session()->get('message-success') }}',
                timer: 1500,
                timerProgressBar: true,

            })
        } else if({{ session()->has('message-error') ? 'true' : 'false' }}) {
            Swal.fire({
                icon: 'success',
                text: '{{ session()->get('message-error') }}',
                timer: 1500,
                timerProgressBar: true,
            })
        }
    </script>
@endpush
