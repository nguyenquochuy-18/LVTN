<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\CartService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    protected CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        $userId = auth()->user()->id;
        $cartUserCurrentLogin = $this->cartService->getByUserCurrentLogin($userId);
        $total = $this->cartService->getTotal($userId);

        return view('user.pages.cart.index', compact(
            'cartUserCurrentLogin',
            'total'
        ));
    }

    public function getCount()
    {
        $userId = auth()->user()->id;
        return response()->json([
            'count' => $this->cartService->countCart($userId),
            'status' => Response::HTTP_OK,
            'total' => number_format($this->cartService->getTotal($userId), 0, '', '.')
        ]);
    }

    public function add(Request $request)
    {
        try {
            DB::beginTransaction();
            $this->cartService->store($request);
            DB::commit();

            return response()->json([
                'status' => Response::HTTP_OK,
                'message' => 'đã thêm sản phẩm vào giỏ hàng'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'Có lỗi'
            ]);
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $this->cartService->delete($id);
            DB::commit();

            return response()->json([
                'status' => Response::HTTP_OK,
                'message' => 'Xoá thành công'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'có lỗi'
            ]);
        }
    }

    public function updateQuantity(Request $request)
    {   
        try {
            DB::beginTransaction();
            $this->cartService->updateQuantity($request);
            DB::commit();

            return redirect()->back();
        } catch(Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('message-error', 'có lỗi!');
        }
    }

}
