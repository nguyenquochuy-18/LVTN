<?php
namespace App\Repositories\Base;

use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterface
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        // TODO: Implement all() method.
        return $this->model->all();
    }

    public function find($id)
    {
        // TODO: Implement find() method.
        return $this->model->findOrFail($id);
    }

    public function create($data)
    {
        // TODO: Implement create() method.
        return $this->model->create($data);
    }

    public function paginate($perPage)
    {
        return $this->model->orderBy('created_at', 'DESC')->paginate($perPage);
    }

    public function findWithRelationship($id, $relationship)
    {
        return $this->model->with($relationship)->findOrFail($id);
    }

    public function count()
    {
        return $this->model->count();
    }
}
