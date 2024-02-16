<?php

namespace App\Repositories\Blog;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Blog;

class BlogRepositoryImplement extends Eloquent implements BlogRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Blog $model)
    {
        $this->model = $model;
    }

    public function find($id)
    {
        return $this->model->where("slug", $id)->first();
    }

    public function update($id, array $data)
    {
        $model = $this->find($id);
        $model->update($data);
        return $model;
    }

    public function delete($id)
    {
        $model = $this->find($id);
        $model->delete();
        return $model;
    }
}
