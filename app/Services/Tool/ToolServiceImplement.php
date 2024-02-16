<?php

namespace App\Services\Tool;

use App\Helpers\UploadFile;
use LaravelEasyRepository\Service;
use App\Repositories\Tool\ToolRepository;

class ToolServiceImplement extends Service implements ToolService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(ToolRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    public function create($data)
    {
      $file  = UploadFile::file_upload("tool", $data->file("image_"));
      $data["image"] = $file;
      $model = $this->mainRepository->create($data->all());
      return $model;
    }

    public function updateData($id, $data)
    {
      $model = $this->mainRepository->find($id);
      if (!empty($data->file("image_"))){
        $file  = UploadFile::file_upload("tool", $data->file("image_"), $model->image);
        $data["image"] = $file;
      }
      $model->update($data->all());
      return $model;
    }

    public function delete($id)
    {
      $model = $this->mainRepository->find($id);
      UploadFile::file_delete($model->image);
      $model->delete();
      return $model;
    }
}
