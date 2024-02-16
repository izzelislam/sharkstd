<?php

namespace App\Repositories\Product;

use App\Models\Product;
use Illuminate\Http\Request;
use LaravelEasyRepository\Repository;

interface ProductRepository extends Repository{
    public function findTrashed(string $slug) : Product;
    public function forseDelete(string $slug) : bool;
    public function withCondition(array $condition, array $with = [], int $paginate = null, int $Limit = 0, array $order_by = []);
}
