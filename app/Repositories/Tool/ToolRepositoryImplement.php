<?php

namespace App\Repositories\Tool;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Tool;

class ToolRepositoryImplement extends Eloquent implements ToolRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Tool $model)
    {
        $this->model = $model;
    }

    public function find($id)
    {
        return $this->model->whereSlug($id)->first();
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
