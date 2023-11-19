<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\OrderService;
use App\Services\ProductService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    protected OrderService $orderService;
    protected ProductService $productService;

    public function __construct(OrderService $orderService, ProductService $productService)
    {
        $this->orderService = $orderService;
        $this->productService = $productService;
    }

    public function index()
    {
        $orders = $this->orderService->paginateWithRelationship();
        return view('admin.pages.order.index', compact('orders'));
    }

    public function show($orderCode)
    {
        $order = $this->orderService->findByOrderCode($orderCode);
        $products = $this->orderService->getByIdsOfOrderDetail($order->order_detail);
        
        return view('admin.pages.order.show', compact('order', 'products'));
    }

    public function updateStatus(Request $request)
    {
        try {

            DB::beginTransaction();
            $this->orderService->updateStatus($request);
            DB::commit();

            return response()->json([
                'status' => Response::HTTP_OK,
                'message' => 'thành công!'
            ]);
        } catch(Exception $e) { 
            DB::rollBack();
            return response()->json([
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'thất bại!'
            ]);
        }
    }
}
