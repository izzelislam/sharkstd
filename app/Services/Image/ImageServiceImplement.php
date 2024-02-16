<?php

namespace App\Services\Image;

use App\Helpers\UploadFile;
use LaravelEasyRepository\Service;
use App\Repositories\Image\ImageRepository;
use Illuminate\Http\Request;

class ImageServiceImplement extends Service implements ImageService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(ImageRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    public function bulkCreate(int $product_id, Request $request)
    {
      try {
        $files      = $request->file("images");
        foreach ($files as $index => $value) {
          $file_name = UploadFile::file_upload("product_image", $value);
          $is_main   = 0;
          if ($index == 0){
            $is_main = 1;
          }
          $data = [
            "product_id" => $product_id,
            "image"      => $file_name,
            "is_main"    => $is_main
          ];
          $this->create($data);
        }
        return true;
      } catch (\Throwable $e) {
        return $e->getMessage();
      }
    }

    public function delete($id)
    {
      try {
        $image = $this->mainRepository->find($id);
        UploadFile::file_delete($image->image);
        $image->delete();
        return true;
      } catch (\Throwable $e) {
        return $e->getMessage();
      }
    }

    public function condition(array $condition)
    {
      return $this->mainRepository->withCondition($condition);
    }
}
