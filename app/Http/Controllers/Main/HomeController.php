<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Services\Product\ProductService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $data["picked_products"] = $this->productService->withCOndition(
            [["status", 1]],
            ["productCategory", "images"],
            null,
            4,
            ["created_at", "desc"]
        );

        $data["product_fonts"] = $this->productService->withCOndition(
            [["status", 1]],
            ["productCategory", "images"],
            null,
            8,
            ["created_at", "desc"]
        );

        return view("main.front-page.home.home", $data);
    }
}
