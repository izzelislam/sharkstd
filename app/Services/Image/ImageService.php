<?php

namespace App\Services\Image;

use Illuminate\Http\Request;
use LaravelEasyRepository\BaseService;

interface ImageService extends BaseService{

    public function bulkCreate(int $product_id, Request $request);
    public function condition(array $condition);
    
}
