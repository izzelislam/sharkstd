<?php

namespace App\Http\Controllers\BO;

use App\Helpers\Utils;
use App\Http\Controllers\Controller;
use App\Services\Compatible\CompatibleService;
use App\Services\Feature\FeatureService;
use App\Services\Image\ImageService;
use App\Services\License\LicenseService;
use App\Services\Product\ProductService;
use App\Services\ProductCategory\ProductCategoryService;
use App\Services\Tool\ToolService;
use Dflydev\DotAccessData\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ProductController extends Controller
{
    protected $service;
    protected $categoryService;
    protected $featureService;
    protected $toolService;
    protected $compatibleService;
    protected $licenseService;
    protected $imageService;

    public function __construct(
        ProductService $service, 
        ProductCategoryService $categoryService,
        FeatureService $featureService,
        ToolService $toolService,
        CompatibleService $compatibleService,
        LicenseService $licenseService,
        ImageService $imageService,
    )
    {
        $this->service            = $service;
        $this->categoryService    = $categoryService;
        $this->featureService     = $featureService;
        $this->toolService        = $toolService;
        $this->compatibleService  = $compatibleService;
        $this->licenseService     = $licenseService;
        $this->imageService       = $imageService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data["route"] = route("bo.products.create");
        return view("bo.product.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data["route"]          = route("bo.products.store");
        $data["categories"]     = Utils::SelectFormatter($this->categoryService->all());
        $data["features"]       = Utils::SelectFormatter($this->featureService->all());
        $data["tools"]          = Utils::SelectFormatter($this->toolService->all());
        $data["compatibles"]    = Utils::SelectFormatter($this->compatibleService->all());
        $data["licenses"]       = Utils::SelectFormatter($this->licenseService->all());
        return view("bo.product.form", $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "product_category_id"   => "required|exists:product_categories,id",
            "name"                  => "required|min:5",
            "describtion"           => "required|min:20",
            "file_size"             => "required|numeric|min:2|max:18",
            "file_"                 => "required|mimes:rar,zip",
            "price"                 => "required|min:1",
            "promo"                 => "nullable|min:1",
            "is_free"               => "required",
            "status"                => "required",
            "compatible_ids.*"      => "required|exists:compatibles,id",
            "tool_ids.*"            => "required|exists:tools,id",
            "feature_ids.*"         => "required|exists:features,id",
            "license_ids.*"         => "required|exists:licenses,id",
        ]);

        try {
            $model = $this->service->createData($request);
            return Utils::RedirectSuccess(route("bo.products.show", $model->slug), "Success create product");
        } catch (\Throwable $e) {
            return Utils::BackFail($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data["model"] = $this->service->find($id);
        return view("bo.product.detail", $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data["model"] = $this->service->find($id);
        // dd(Utils::pluckId($data["model"]->compatibles));
        $data["route"] = route("bo.products.update", $id);
        $data["categories"]     = Utils::SelectFormatter($this->categoryService->all());
        $data["categories"]     = Utils::SelectFormatter($this->categoryService->all());
        $data["features"]       = Utils::SelectFormatter($this->featureService->all());
        $data["tools"]          = Utils::SelectFormatter($this->toolService->all());
        $data["compatibles"]    = Utils::SelectFormatter($this->compatibleService->all());
        $data["licenses"]       = Utils::SelectFormatter($this->licenseService->all());
        return view("bo.product.form", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "product_category_id"   => "required|exists:product_categories,id",
            "describtion"           => "required|min:20",
            "file_size"             => "required|numeric|min:2|max:18",
            "file_"                 => "nullable|mimes:rar,zip",
            "price"                 => "required|min:1",
            "promo"                 => "nullable|min:1",
            "is_free"               => "required",
            "status"                => "required",
            "compatible_ids.*"      => "required|exists:compatibles,id",
            "tool_ids.*"            => "required|exists:tools,id",
            "feature_ids.*"         => "required|exists:features,id",
            "license_ids.*"         => "required|exists:licenses,id",
        ]);

        try {
            $model = $this->service->updateData($id, $request);
            return Utils::RedirectSuccess(route("bo.products.show", $model->slug), "Success update product");
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
            $this->service->delete($id);
            return Utils::BackSuccess("Success delete product");
        } catch (\Throwable $e) {
            return Utils::BackFail($e->getMessage());
        }
    }


    public function storeProductImage(Request $request)
    {
        try {
            $total_images = count($request->file("images"));

            if ($total_images > 8){
                return Utils::BackFail("files must not greather tha 8");
            }

            $slug    = Crypt::decryptString($request->_p);
            $product = $this->service->find($slug)->id;
            $this->imageService->bulkCreate($product, $request);

            return Utils::BackSuccess("Succee add product images");
        } catch (\Throwable $e) {
            return Utils::BackFail($e->getMessage());
        }
    }

    public function destroyProductImage($id_enc)
    {
        try {
            $id = Crypt::decryptString($id_enc);
            $this->imageService->delete($id);
            return Utils::BackSuccess("Success dele product-image");
        } catch (\Throwable $e) {
            return Utils::BackFail($e->getMessage());
        }
    }
}
