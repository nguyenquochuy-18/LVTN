<?php

namespace App\Http\Middleware\User;

use App\Services\CartService;
use Closure;
use Illuminate\Http\Request;

class CheckCartEmpty
{
    protected CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if($this->cartService->checkCartEmpty(auth()->user()->id)) {
            return redirect()->route('shop.index')->with('message-warning', 'cần thêm sản phẩm vào giờ hàng!');
        }
        return $next($request);
    }
}
