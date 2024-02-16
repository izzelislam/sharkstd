<?php

namespace App\Repositories\ProductCategory;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\ProductCategory;

class ProductCategoryRepositoryImplement extends Eloquent implements ProductCategoryRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(ProductCategory $model)
    {
        $this->model = $model;
    }

    public function findSlug($slug)
    {
        return $this->model->where("slug", $slug)->first();
    }

    public function update($id, array $data)
    {
        $model = $this->findSlug($id);
        $model->update($data);
        return $model;
    }

    public function delete($id)
    {
        $model = $this->findSlug($id);
        $model->delete();
        return $model;
    }
}
