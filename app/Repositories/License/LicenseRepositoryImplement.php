<?php

namespace App\Repositories\License;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\License;

class LicenseRepositoryImplement extends Eloquent implements LicenseRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(License $model)
    {
        $this->model = $model;
    }

    public function withOrderRaw(string $args)
    {
        $model= $this->model->orderByraw($args)->get();
        return $model;
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
