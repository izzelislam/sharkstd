<?php

namespace App\Services\Blog;

use App\Models\Blog;
use Illuminate\Http\Request;
use LaravelEasyRepository\BaseService;

interface BlogService extends BaseService{

    public function createData(Request $data) :Blog;
    public function updateData(string $slug, Request $data) :bool;
}
