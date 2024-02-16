<?php

namespace App\Http\Controllers\BO;

use App\Helpers\Utils;
use App\Http\Controllers\Controller;
use App\Services\ProductCategory\ProductCategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yaza\LaravelGoogleDriveStorage\Gdrive;

class ProductCategoryController extends Controller
{

    protected $productCategoryServeice;

    public function __construct(ProductCategoryService $mainService)
    {
        $this->productCategoryServeice = $mainService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data["route"] = route("bo.product-categories.create");
        return view("bo.category.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data["route"] = route("bo.product-categories.store");
        return view("bo.category.form", $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Utils::Check();
        $request->validate(["name" => "required"]);
        try {
            $this->productCategoryServeice->create($request->all());
            return Utils::RedirectSuccess(route("bo.product-categories.index"), "Success create product-category");
        } catch (\Throwable $e) {
            return Utils::BackFail($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data["model"] = $this->productCategoryServeice->findBySlug($id);
        return view("bo.category.detail", $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data["model"] = $this->productCategoryServeice->findBySlug($id);
        $data["route"] = route("bo.product-categories.update", $id);
        return view("bo.category.form", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(["name" => "required"]);
        try {
            $this->productCategoryServeice->update($id, $request->all());
            return Utils::RedirectSuccess(route("bo.product-categories.index"), "Success update product-category");
        } catch (\Throwable $e) {
            return Utils::BackFail($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->productCategoryServeice->delete($id);
            return Utils::BackSuccess("Success delete product-category");
        } catch (\Throwable $e) {
            return Utils::BackFail($e->getMessage());
        }
    }
}
