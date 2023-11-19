@extends('user.auth.main', [
    'route' => route('login'),
    'title' => 'Đăng nhập'
])
@section('content')
    <div class="form-group mb-3">
        @php
            $email = session()->has('email') ? session()->get('email') : old('email', request()->email)
        @endphp
        <label class="label" for="name">Email</label>
        <input type="text" name="email" class="form-control" placeholder="Email" value="{{ $email }}">
        @error('email')
        <small class="form-text text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group mb-3">
        <label class="label" for="password">Mật khẩu</label>
        <input type="password" name="password" class="form-control" placeholder="Mật khẩu">
        @error('password')
        <small class="form-text text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group">
        <button type="submit" class="form-control btn btn-primary rounded submit px-3">
            Đăng nhập
        </button>
        @error('error')   
        <small class="form-text text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group d-md-flex">
        <div class="w-50 text-left">
            <label class="checkbox-wrap checkbox-primary mb-0">
                Ghi nhớ mật khẩu
                <input type="checkbox" name="remember">
                <span class="checkmark"></span>
            </label>
        </div>
        <div class="w-50 text-md-right">
            <a href="#">Quên mật khẩu</a>
        </div>
    </div>
@endsection

@section('hint')
    <p class="text-center">Bạn chưa có tài khoản? <a href="{{ route('register.form') }}">Đăng kí</a></p>
@endsection