<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ asset('css/admin/fontawesome/css/all.min.css') }}">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/admin/root.min.css') }}">
        <title>Login</title>
    </head>
    <body class="bg-gradient-primary">
        <div class="container">

            <!-- Outer Row -->
            <div class="row justify-content-center" style="height: 100vh; align-content: center">

                <div class="col-xl-10 col-lg-12 col-md-9">

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                                <div class="col-lg-6">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Chào bạn đến trang admin!</h1>
                                        </div>
                                        <form class="user" method="POST" action={{ route('admin.post.login') }}>
                                            @csrf
                                            <div class="form-group">
                                                <input type="email" class="form-control form-control-user"
                                                       id="exampleInputEmail" aria-describedby="emailHelp"
                                                       name="email"
                                                       placeholder="Enter Email Address...">
                                                @error('email')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control form-control-user"
                                                    name="password" id="exampleInputPassword" placeholder="Mật khẩu">
                                                @error('password')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox small">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck" name="remember">
                                                    <label class="custom-control-label" for="customCheck">ghi nhớ đăng nhập</label>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                                Đăng nhập
                                            </button>
                                            @error('error')   
                                            <small class="form-text text-danger text-center">{{ $message }}</small>
                                            @enderror
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
        <script src="{{ asset('js/admin/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('js/admin/bootstrap/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('js/admin/jquery-easing/jquery.easing.min.js') }}"></script>
        <script src="{{ asset('js/admin/root.min.js') }}"></script>
    </body>
</html>
