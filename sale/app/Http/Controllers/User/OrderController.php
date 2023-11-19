<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\OrderStoreRequest;
use App\Repositories\Cart\CartRepositoryInterface;
use App\Services\CartService;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isEmpty;

class OrderController extends Controller
{
    protected CartService $cartService;
    protected OrderService $orderService;

    public function __construct(CartService $cartService, OrderService $orderService)
    {
        $this->cartService = $cartService;
        $this->orderService = $orderService;
    }

    public function index()
    {
        $userId = auth()->user()->id;
        $cartUserCurrentLogin = $this->cartService->getByUserCurrentLogin($userId);
        $total = $this->cartService->getTotal($userId);

        return view('user.pages.order.index',compact(
            'cartUserCurrentLogin',
            'total'
        ));
    }

    public function store(OrderStoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $this->orderService->store($request);
            DB::commit();

            return redirect()->route('home.index')->with('message-success', 'Đặt hàng thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('home.index')->with('message-error', 'Đã xảy ra lỗi!');
        }
    }
}
