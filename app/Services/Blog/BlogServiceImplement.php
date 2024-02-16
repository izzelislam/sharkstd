<?php

namespace App\Services\Blog;

use App\Helpers\UploadFile;
use App\Models\Blog;
use LaravelEasyRepository\Service;
use App\Repositories\Blog\BlogRepository;
use Illuminate\Http\Request;

class BlogServiceImplement extends Service implements BlogService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(BlogRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    public function createData(Request $data): Blog
    {
      $data["image_cover"] = UploadFile::file_upload("post", $data->file("image_cover_"));
      $data["admin_id"]    = 1;
      $model = $this->mainRepository->create($data->all());
      return $model;
    }

    public function updateData(string $slug, Request $data): bool
    {
      $model   = $this->mainRepository->find($slug);
      if ($data->file("image_cover_")){
        $data["image_cover"] = UploadFile::file_upload("post", $data->file("image_cover_"), $model->image_cover);
      }
      $data["admin_id"]      = 1;

      $updated               =  $this->mainRepository->update($slug, $data->all());
      return $updated;
    }
}
