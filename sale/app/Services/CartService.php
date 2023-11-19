<?php

namespace App\Services;

use App\Repositories\Cart\CartRepositoryInterface;
use Exception;
use Illuminate\Http\Response;

class CartService {

    protected CartRepositoryInterface $cartRepository;

    public function __construct(CartRepositoryInterface $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    public function getByUserCurrentLogin($userId)
    {
        return $this->cartRepository->getByUserCurrentLogin($userId);
    }

    public function getTotal($userId)
    {
        $carts = $this->cartRepository->getTotalPriceAndQuantityByUserCurrentLogin($userId);
        return array_sum($carts->pluck('total')->toArray());
    }

    public function countCart($userId)
    {
        return $this->cartRepository->countQuantityByUserCurrentLogin($userId);
    }

    public function store($request)
    {
        $userId = auth()->user()->id;

        $cartExistProduct = $this->cartRepository->getByUserIdAndProductId($userId, $request->product_id);

        if($cartExistProduct) {
            $cartExistProduct->quantity += $request->quantity;
            $cartExistProduct->total += $request->total;

            return $cartExistProduct->save();
        }

        $data = $request->all();
        $data['user_id'] = $userId;
        return $this->cartRepository->create($data);
    }

    public function delete($id)
    {
        $cart = $this->cartRepository->find($id);
        $cart->delete();

        return $cart;
    }

    public function deleteMultiple($ids)
    {
        return $this->cartRepository->deleteMultiple($ids);
    }

    public function getByIds($ids)
    {
        return $this->cartRepository->getByIds($ids);
    }

    public function checkCartEmpty($userId)
    {
        return $this->cartRepository->checkCartEmpty($userId);
    }

    /**
     * @throws Exception
     */
    public function updateQuantity($request)
    {
        $dataInput = $request->get('carts');
        if(!empty($dataInput)) {
            $ids = array_keys($dataInput);
          
            $carts = $this->cartRepository->getByIds($ids);
        
            $carts->each(function($cart) use ($dataInput) {
                $quantity = (int) $dataInput[$cart->id];
               
                if($quantity == 0) {
                    var_dump($quantity);
                    $cart->delete();
                } elseif ($quantity < 0) {
                    throw new Exception('lỗi');
                } elseif ($quantity > 0) {

                    $cart->total = $quantity * ($cart->total / $cart->quantity);
                    $cart->quantity = $quantity;
        
                    $cart->save();
                }
            });
        }

        return true;
    }
}
