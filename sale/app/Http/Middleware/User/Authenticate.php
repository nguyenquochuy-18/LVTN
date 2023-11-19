<?php

namespace App\Http\Middleware\User;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {   
        if(!auth()->check()) {
            if($request->ajax()) {
                return response()->json([
                    'message' => 'bạn cần đăng nhập',
                    'status' => Response::HTTP_FORBIDDEN,
                    'route' => route('login.form')
                ]);
            }
            return redirect()->route('login.form')->with('message-error', 'bạn cần đăng nhập!');
        }
        return $next($request);
    }
}
