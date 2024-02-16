<?php

namespace App\Services\ProductCategory;

use App\Models\ProductCategory;
use LaravelEasyRepository\BaseService;

interface ProductCategoryService extends BaseService{
    public function findBySlug(string $slug):ProductCategory;
}
