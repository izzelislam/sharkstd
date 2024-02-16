<?php

namespace App\Http\Controllers\BO;

use App\Helpers\UploadFile;
use App\Helpers\Utils;
use App\Http\Controllers\Controller;
use App\Services\Product\ProductService;
use Illuminate\Http\Request;

class ProductTrashedController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $service;

    public function __construct(ProductService $service){
        $this->service = $service;
    }

    public function index()
    {
        return view("bo.product.trashed.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data["model"] = $this->service->findTrashed($id);
        return view("bo.product.detail", $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $model = $this->service->findTrashed($id);
            $model->restore();
            return Utils::BackSuccess("Product has ben restored");
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
            $product = $this->service->findTrashed($id);
            UploadFile::files_delete($product->images->pluck("image")->toArray());
            $product->images()->delete();
            $product->forceDelete();

            return Utils::BackSuccess("Product successfuly deleted permanenly.");

        } catch (\Throwable $e) {
            return utils::BackFail($e->getMessage());
        }
    }
}
