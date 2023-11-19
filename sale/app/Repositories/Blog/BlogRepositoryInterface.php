<?php

namespace App\Repositories\Blog;

interface BlogRepositoryInterface
{
    public function findBySlug($slug);

    public function getTrend();
}
