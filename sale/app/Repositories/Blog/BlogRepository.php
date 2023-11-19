<?php

namespace App\Repositories\Blog;

use App\Models\Blog;
use App\Repositories\Base\BaseRepository;


class BlogRepository extends BaseRepository implements BlogRepositoryInterface
{
    public function __construct(Blog $model)
    {
        parent::__construct($model);
    }

    public function findBySlug($slug)
    {
        return $this->model->where('slug', $slug)->first();
    }

    public function getTrend()
    {
        return $this->model->orderBy('created_at', 'DESC')->take(3)->get();
    }
}
