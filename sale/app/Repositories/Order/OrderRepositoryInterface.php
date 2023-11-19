<?php

namespace App\Repositories\Order;

interface OrderRepositoryInterface
{
    public function getAllWithRelationship($perPage);

    public function findByOrderCode($orderCode);

    public function getByStatus($status);
}
