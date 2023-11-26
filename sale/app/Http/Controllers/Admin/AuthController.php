<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use App\Repositories\Profile\ProfileRepository;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

class AuthController extends Controller
{

    public function formLogin()
    {
        if(auth('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only(['email', 'password']);
        $remember = $request->has('remember');

        if (!auth('admin')->attempt($credentials, $remember)) {
            $error = new MessageBag(['error' => 'email hoặc mật khẩu không đúng!!']);
            return redirect()->back()->withInput()->withErrors($error);
        }
        session(['email'=>$request->input('email')]);
        return redirect()->route('admin.dashboard');
    }

    public function logout()
    {
        auth('admin')->logout();
        return redirect()->route('admin.get.login');
    }
}
