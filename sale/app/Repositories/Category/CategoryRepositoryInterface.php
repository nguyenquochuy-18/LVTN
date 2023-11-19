<?php
namespace App\Repositories\Category;

interface CategoryRepositoryInterface {

    public function getByLimit($limit);

    public function findBySlug($slug);

    public function getAllWithRelationship();
}
