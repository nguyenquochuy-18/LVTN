<?php

namespace App\Services;

use App\Repositories\Blog\BlogRepositoryInterface;
use App\Traits\HandleImage;

class BlogService
{
    use HandleImage;

    protected BlogRepositoryInterface $blogRepository;

    public function __construct(BlogRepositoryInterface $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    public function store($request)
    {
        $data = $request->all();
        $data['thumbnail'] = $this->storeImage($request);
        return $this->blogRepository->create($data);
    }

    public function paginate($perPage = 10)
    {
        return $this->blogRepository->paginate($perPage);
    }

    public function find($id)
    {
        return $this->blogRepository->find($id);
    }

    public function update($request, $id)
    {
        $data = $request->all();
        $blog = $this->blogRepository->find($id);
        $data['thumbnail'] = $this->updateImage($request, $blog->thumbnail);
        $blog->update($data);

        return $blog;
    }

    public function delete($id)
    {
        $blog = $this->blogRepository->find($id);
        $blog->delete();

        return $blog;
    }

    public function findBySlug($slug)
    {
        return $this->blogRepository->findBySlug($slug) ?? abort(404);
    }

    public function getTrend()
    {
        return $this->blogRepository->getTrend();
    }
}
