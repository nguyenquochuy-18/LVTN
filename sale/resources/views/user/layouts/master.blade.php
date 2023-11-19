<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/user/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user/fontawesome/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user/elegant-icons/elegant-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user/magnific-popup/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user/nice-select/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user/owlcarousel/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user/slicknav/slicknav.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"/>
    <link rel="stylesheet" href="{{ asset('css/user/root.css') }}">
    @stack('css')

    <title>Sale</title>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__option">
            @auth
            <div class="offcanvas__links">
                <a href="javascipt:;">
                    <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                    {{ auth()->user()->name }}
                </a>
            </div>
            @else
            <div class="offcanvas__links">
                <a href="{{ route('login.form') }}">Đăng nhập</a>
                <a href="{{ route('register.form') }}">Đăng kí</a>
            </div>
            @endauth

        </div>
        <div class="offcanvas__nav__option">
            <a href="#" class="search-switch"><img src="{{ asset('img/icon/search.png')  }}" alt=""></a>
            <a href="#"><img src="{{ asset('img/icon/heart.png') }}" alt=""></a>
            <a href="#"><img src="{{ asset('img/icon/cart.png') }}" alt=""> <span>0</span></a>
            <div class="price">0.00 vnd</div>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__text">
            <p>Miễn phí vận chuyển, Hoàn hàng trong vòng 30 ngày.</p>
        </div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-7">
                        <div class="header__top__left">
                            <p>Miễn phí vận chuyển, Hoàn hàng trong vòng 30 ngày.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-5">
                        <div class="header__top__right">
                            <div class="header__top__links mr-0">
                                @auth
                                <nav class="header__menu mobile-menu p-0">
                                    <ul>
                                        <li>
                                            <a href="#" style="color: white; font-size: 14px" class="mr-0">
                                                <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                                                {{ auth()->user()->name }}
                                            </a>
                                            <ul class="dropdown" style="width: 200px">
                                                <li>
                                                    <a href="#">Thông tin cá nhân</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('logout') }}">Đăng xuất</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </nav>
                                @else
                                    <a href="{{ route('login.form') }}">Đăng nhập</a>
                                    <a href="{{ route('register.form') }}">Đăng kí</a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="header__logo p-0">
                        <a href="{{ route('home.index') }}"><img src="{{ asset('img/logo.png') }}" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li class="active"><a href="{{ route('home.index') }}">Trang chủ</a></li>
                            <li>
                                <a href="{{ route('shop.index') }}">Sản phẩm</a>
                                <ul class="dropdown">
                                    @foreach ($categories as $category)
                                        <li><a href="{{ route('shop.category', $category->slug) }}">{{ $category->name }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            <li><a href="{{ route('blog.index') }}">Blog</a></li>
                            <li><a href="{{ route('contact.index') }}">Liên hệ</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="header__nav__option">
                        <a href="{{ route('cart.index') }}"><img src="{{ asset('img/icon/cart.png') }}" alt=""> <span class="count-cart">0</span></a>
                        <div class="price">0.00 vnd</div>
                    </div>
                </div>
            </div>
            <div class="canvas__open"><i class="fa fa-bars"></i></div>
        </div>
    </header>
    <!-- Header Section End -->

    <main id="main">
        @yield('content')
    </main>

    <!-- Footer Section Begin -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__logo">
                            <a href="#"><img src="{{ asset('img/footer-logo.png') }}" alt=""></a>
                        </div>
                        <p>Trải nhiệm của khánh hàng luôn mục tiêu hàng đầu, chúng tôi luôn nỗ lực để làm hài lòng các bạn</p>
                        <a href="#"><img src="{{ asset('img/payment.png') }}" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-2 offset-lg-1 col-md-3 col-sm-6">
                    <div class="footer__widget">
                        <h6>Danh mục</h6>
                        <ul>
                            <li><a href="{{ route('home.index') }}">Trang chủ</a></li>
                            <li><a href="#">Sản phẩm</a></li>
                            <li><a href="#">Blog</a></li>
                            <li><a href="#">Liên hệ</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="footer__widget">
                        <h6>Sản phẩm hot</h6>
                        <ul>
                            @foreach ($categoriesFooter as $category)
                                <li><a href="{{ route('shop.category', $category->slug) }}">{{ $category->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 offset-lg-1 col-md-6 col-sm-6">
                    <div class="footer__widget">
                        <h6>Email</h6>
                        <div class="footer__newslatter">
                            <p>Để lại email, bạn sẽ nhận được những ưu đãi, sản phẩm mới của chúng tôi!</p>
                            <form action="#">
                                <input type="text" placeholder="Email">
                                <button type="submit"><span class="icon_mail_alt"></span></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="footer__copyright__text">
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        <p>Copyright ©
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
                            All rights reserved | This template is made with <i class="fa fa-heart-o"
                            aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                        </p>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <input type="hidden" id="route-get-count-cart" data-route="{{ route('cart.count') }}">
    <input type="hidden" id="route-add-to-cart" data-route="{{ route('cart.add') }}">
    <!-- Footer Section End -->
    <script src="{{ asset('js/user/jquery/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/user/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/user/nice-select/nice-select.min.js') }}"></script>
    <script src="{{ asset('js/user/nicescroll/nicescroll.min.js') }}"></script>
    <script src="{{ asset('js/user/magnific-popup/magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/user/countdown/countdown.min.js') }}"></script>
    <script src="{{ asset('js/user/slicknav/slicknav.js') }}"></script>
    <script src="{{ asset('js/user/mixitup/mixitup.min.js') }}"></script>
    <script src="{{ asset('js/user/owlcarousel/owlcarousel.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/common.js') }}"></script>
    <script src="{{ asset('js/user/root.js') }}"></script>
    <script src="{{ asset('js/user/cart.js') }}"></script>
    @stack('js')
</body>

</html>
