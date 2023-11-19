<?php
namespace App\Repositories\Base;

interface BaseRepositoryInterface
{
    public function all();

    public function find($id);

    public function create($data);

    public function paginate($perPage);

    public function findWithRelationship($id, $relationship);

    public function count();

}
