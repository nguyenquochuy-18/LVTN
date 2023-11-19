<?php

namespace App\Repositories\Cart;

interface CartRepositoryInterface
{
    public function getByUserCurrentLogin($userId);

    public function countQuantityByUserCurrentLogin($userId);

    public function getTotalPriceAndQuantityByUserCurrentLogin($userId);

    public function getByUserIdAndProductId($userId, $productId);

    public function deleteMultiple($ids);

    public function getByIds($ids);

    public function checkCartEmpty($userId);
}
