<?php

namespace App\Repositories\ProductCategory;

use LaravelEasyRepository\Repository;

interface ProductCategoryRepository extends Repository{

    public function findSlug(string $slug);
}
