<?php

namespace App\Repositories\Cart;

use App\Models\Cart;
use App\Repositories\Base\BaseRepository;

class CartRepository extends BaseRepository implements CartRepositoryInterface{

    public function __construct(Cart $model)
    {
        parent::__construct($model);
    }

    public function getByUserCurrentLogin($userId)
    {
        return $this->model->where('user_id', $userId)->with('product')->get();
    }

    public function countQuantityByUserCurrentLogin($userId)
    {
        return $this->model->where('user_id', $userId)->get()->count();
    }

    public function getTotalPriceAndQuantityByUserCurrentLogin($userId)
    {
        return $this->model->select(['total', 'quantity'])->where('user_id', $userId)->get();
    }

    public function getByUserIdAndProductId($userId, $productId)
    {
        return $this->model->where([
            'user_id' => $userId,
            'product_id' => $productId
        ])->with('product')->first();
    }

    public function deleteMultiple($ids)
    {
        return $this->model->whereIn('id', $ids)->delete();
    }

    public function getByIds($ids)
    {
        return $this->model->whereIn('id', $ids)->get();
    }

    public function checkCartEmpty($userId)
    {
        return $this->model->where('user_id', $userId)->get()->isEmpty();
    }
}
