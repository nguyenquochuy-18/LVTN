<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegisterRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\UserService;
use Illuminate\Support\MessageBag;

class AuthController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function formLogin()
    {
        if(auth()->check()) return redirect()->route('home.index');
        return view('user.auth.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only(['email', 'password']);
        $remember = $request->has('remember');

        if(!auth()->attempt($credentials, $remember)) {
            $error = new MessageBag(['error' => 'email hoặc mật khẩu không đúng!!']);
            return redirect()->back()->withInput()->withErrors($error);
        }

        return redirect()->route('home.index');
    }

    public function formRegister()
    {
        if(auth()->check()) return redirect()->route('home.index');
        return view('user.auth.register');
    }

    public function register(RegisterRequest $request)
    {
        try{
            DB::beginTransaction();
            $user = $this->userService->create($request);
            $email = $user->email;
            DB::commit();

            return redirect()->route('login.form')->with([
                'email' => $email,
                'message-success' => 'Đăng kí thành công'
            ]);

        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('message-error', 'opps, đã xảy ra lỗi!!');
        }
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('home.index');
    }
}
