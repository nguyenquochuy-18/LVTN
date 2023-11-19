@extends('user.auth.main', [
    'route' => route('register'),
    'title' => 'Đăng kí',
    'hidden_bgr' => true
])
@section('content')
    <div class="row">
        <div class="form-group mb-3 col-sm-6">
            <label class="label" for="password">Họ và tên <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control" placeholder="Họ và tên">
            @error('name')
            <small class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group mb-3 col-sm-6">
            <label class="label" for="name">Email <span class="text-danger">*</span></label>
            <input type="text" name="email" class="form-control" placeholder="Email">
            @error('email')
            <small class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="row">
        <div class="form-group mb-3 col-sm-6">
            <label class="label" for="password">Địa chỉ</label>
            <input type="text" name="address" class="form-control" placeholder="Địa chỉ">
            @error('address')
            <small class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group mb-3 col-sm-6">
            <label class="label" for="password">Số điện thoại</label>
            <input type="text" name="phone" class="form-control" placeholder="Số điện thoại">
            @error('phone')
            <small class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="row">
        <div class="form-group mb-3 col-sm-6">
            <label class="label" for="password">Mật khẩu<span class="text-danger">*</span></label>
            <input type="password" name="password" class="form-control" placeholder="Mật khẩu">
            @error('password')
            <small class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group mb-3 col-sm-6">
            <label class="label" for="password">Xác nhận mật khẩu<span class="text-danger">*</span></label>
            <input type="password" name="password_confirmation" class="form-control" placeholder="xác nhận mật khẩu">
            @error('password_confirmation')
            <small class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="form-group">
        <button type="submit" class="form-control btn btn-primary rounded submit px-3">
            Đăng kí
        </button>
    </div>
@endsection

@section('hint')
    <p class="text-center">Bạn đã có tài khoản? <a href="{{ route('login.form') }}">Đăng nhập</a></p>
@endsection