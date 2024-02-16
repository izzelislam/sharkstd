<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Services\Product\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService){
        $this->productService = $productService;
    }

    public function show($slug)
    {
        $data["product"] = $this->productService->find($slug);
        $data["products"] = $this->productService->withCOndition(
            [["status", 1]],
            ["productCategory", "images"],
            null,
            3,
            ["created_at", "desc"]
        );
        return view("main.front-page.product.detail", $data);
    }
}
