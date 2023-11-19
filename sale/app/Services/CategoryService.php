<?php
namespace App\Services;

use App\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Support\Str;

class CategoryService {

    protected CategoryRepositoryInterface $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function all()
    {
        return $this->categoryRepository->all();
    }

    public function paginate($perPage = 10)
    {
        return $this->categoryRepository->paginate($perPage);
    }

    public function find($id)
    {
        return $this->categoryRepository->find($id);
    }

    public function store($request)
    {
        $data = $request->all();

        return $this->categoryRepository->create($data);
    }

    public function update($request, $id)
    {
        $data = $request->all();
        $category = $this->categoryRepository->find($id);
        $category->update($data);

        return $category;
    }

    public function delete($id)
    {
        $category = $this->categoryRepository->find($id);
        $category->delete();

        return $category;
    }

    public function getByLimit($limit = 3)
    {
        return $this->categoryRepository->getByLimit($limit);
    }

    public function findBySlug($slug)
    {
        return $this->categoryRepository->findBySlug($slug) ?? abort(404);
    }

    public function getAllWithRelationship()
    {
        return $this->categoryRepository->getAllWithRelationship();
    }
}
