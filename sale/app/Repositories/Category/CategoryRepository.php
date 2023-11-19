<?php
namespace App\Repositories\Category;

use App\Models\Category;
use App\Repositories\Base\BaseRepository;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface {

    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    public function getByLimit($limit)
    {
        return $this->model->orderBy('created_at', 'DESC')->take($limit)->get();
    }

    public function findBySlug($slug)
    {
        return $this->model->where('slug', $slug)->with('products')->first();
    }

    public function getAllWithRelationship()
    {
        return $this->model->with('products')->get();
    }
}
