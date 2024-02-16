<?php

namespace App\Services\Product;

use App\Models\Product;
use Illuminate\Http\Request;
use LaravelEasyRepository\BaseService;

interface ProductService extends BaseService{

    public function createData(Request $request): Product;
    public function updateData(string $slug, Request $request);
    // public function deleteData(string $slug): bool;
    public function findTrashed(string $slug): Product;
    public function forceDelete(string $slug): bool;
    public function withCOndition(array $condition, array $with = [], int $paginate = null , int $limit = null, array $order_by = []);
}
