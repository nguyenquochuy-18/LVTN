<?php

namespace App\Repositories\Order;

use App\Models\Order;
use App\Repositories\Base\BaseRepository;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    public function __construct(Order $model)
    {
        parent::__construct($model);
    }

    public function getAllWithRelationship($perPage)
    {
        return $this->model->with('user')->paginate($perPage);
    }

    public function findByOrderCode($orderCode)
    {
        return $this->model->where('order_code', $orderCode)->with('user')->first();
    }

    public function getByStatus($status)
    {
        return $this->model->where('status', $status)->get();
    }
}
