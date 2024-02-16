<?php

namespace App\Services\Product;

use App\Helpers\UploadFile;
use App\Helpers\Utils;
use App\Models\Product;
use LaravelEasyRepository\Service;
use App\Repositories\Product\ProductRepository;
use Illuminate\Http\Request;

class ProductServiceImplement extends Service implements ProductService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(ProductRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    public function createData(Request $request): Product
    {
      $request["file"] = UploadFile::file_upload("product", $request->file("file_"));
      
      $request['admin_id'] = auth()->guard("admin")->user()->id;
      $model = $this->mainRepository->create($request->all());
      $model->features()->attach($request->feature_ids);
      $model->tools()->attach($request->tool_ids);
      $model->compatibles()->attach($request->compatible_ids);
      $model->licenses()->attach($request->license_ids);
      
      return $model;
    }

    public function updateData(string $slug, Request $request): bool
    {
      $model = $this->mainRepository->find($slug);
      if (!empty($request->file("file_"))){
        $request["file"] = UploadFile::file_upload("product", $request->file("file_"), $model->file);
      }
      $model->features()->sync($request->feature_ids);
      $model->tools()->sync($request->tool_ids);
      $model->compatibles()->sync($request->compatible_ids);
      $model->licenses()->sync($request->license_ids);

      $model_data = $this->mainRepository->update($slug, $request->all());
      
      return $model_data;
    }

    public function findTrashed(string $slug): Product
    {
      return $this->mainRepository->findTrashed($slug);
    }

    public function forceDelete(string $slug): bool
    {
        $model = $this->find($slug);
        $model->features()->detach(Utils::pluckId($model->features));
        $model->tools()->detach(Utils::pluckId($model->tools));
        $model->compatibles()->detach(Utils::pluckId($model->compatibles));
        $model->licenses()->detach(Utils::pluckId($model->licenses));

        $model->forceDelete();
        return true;
    }

    public function withCOndition(array $condition, array $with = [], ?int $paginate = null, ?int $limit = null, array $order_by = [])
    {
      return $this->mainRepository->withCondition($condition, $with, $paginate, $limit, $order_by );
    }
}
