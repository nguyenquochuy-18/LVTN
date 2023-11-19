<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/user/login.css') }}">
    <title>{{ $title }}</title>

</head>

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10">
                    @include('user.auth.message')
                    <div class="wrap d-md-flex">
                        <div class="img @isset($hidden_bgr) d-none @endisset"
                            style="background-image: url('https://w0.peakpx.com/wallpaper/589/79/HD-wallpaper-gucci-models-graphy-people-designer-fashion.jpg');">
                        </div>
                        <div class="login-wrap p-4 p-md-5  @isset($hidden_bgr) w-100 @endisset">
                            <div class="d-flex">
                                <div class="w-100">
                                    <h3 class="mb-4">{{ $title }}</h3>
                                </div>
                                <div class="w-100">
                                    <p class="social-media d-flex justify-content-end">
                                        <a href="#"
                                            class="social-icon d-flex align-items-center justify-content-center"><span
                                                class="fa fa-facebook"></span></a>
                                        <a href="#"
                                            class="social-icon d-flex align-items-center justify-content-center"><span
                                                class="fa fa-twitter"></span></a>
                                    </p>
                                </div>
                            </div>
                            <form action="{{ $route }}" class="signin-form" method="POST">
                                @csrf
                                @yield('content')
                            </form>
                            @yield('hint')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('js/user/jquery/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/user/bootstrap/bootstrap.min.js') }}"></script>
</body>

</html>
