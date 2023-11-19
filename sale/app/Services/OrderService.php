<?php

namespace App\Services;

use App\Repositories\Cart\CartRepositoryInterface;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use Illuminate\Support\Str;

class OrderService
{
    protected OrderRepositoryInterface $orderRepository;
    protected CartRepositoryInterface $cartRepository;
    protected ProductRepositoryInterface $productRepository;

    public function __construct(OrderRepositoryInterface $orderRepository, CartRepositoryInterface $cartRepository, ProductRepositoryInterface $productRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->cartRepository = $cartRepository;
        $this->productRepository = $productRepository;
    }

    public function store($request)
    {
        $data = $request->all();

        $user = auth()->user();
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->save();

        $carts = $this->cartRepository->getByIds(json_decode($request->cart_ids));
        $orderDetail = $carts->map(function ($cart) {
            return [
                'product_id' => $cart->product_id,
                'total' => $cart->total,
                'quantity' => $cart->quantity
            ];
        });

        $orderTotal = array_sum($carts->pluck('total')->toArray());

        $data['user_id'] = $user->id;
        $data['status'] = 0;
        $data['order_detail'] = $orderDetail;
        $data['order_total'] = $orderTotal;
        $data['order_code'] = Str::uuid()->toString();

        $order = $this->orderRepository->create($data);

        //create order success then clear cart
        if ($order) $this->cartRepository->deleteMultiple(json_decode($request->cart_ids));

        return $order;
    }

    public function paginateWithRelationship($perPage = 10)
    {
        return $this->orderRepository->getAllWithRelationship($perPage);
    }

    public function findByOrderCode($orderCode)
    {
        return $this->orderRepository->findByOrderCode($orderCode) ?? abort(404);
    }

    public function getByIdsOfOrderDetail($orderDetail)
    {
        $ids = collect($orderDetail)->pluck('product_id')->toArray();
        $products = $this->productRepository->getByIds($ids);
        
        $result = [];
        foreach($orderDetail as $order) {
            foreach($products as $product) {
                if($order['product_id'] === $product->id) {
                    $result[] = [
                        'quantity' => $order['quantity'],
                        'total' => $order['total'],
                        'detail' => $product
                    ];
                }
            }
        }

        return $result;
    }

    public function updateStatus($request)
    {
        $order = $this->orderRepository->find($request->id);
        $order->status = $request->status;
        $order->save();

        return $order;
    }

    public function count()
    {
        return $this->orderRepository->count();
    }

    public function getSales($status = 1)
    {
        $orders = $this->orderRepository->getByStatus($status);
        $arrTotal = $orders->pluck('order_total')->toArray();

        return array_sum($arrTotal);
    }
}
