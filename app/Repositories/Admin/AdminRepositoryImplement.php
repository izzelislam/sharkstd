<?php

namespace App\Repositories\Admin;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Admin;

class AdminRepositoryImplement extends Eloquent implements AdminRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Admin $model)
    {
        $this->model = $model;
    }

    public function find($id)
    {
        return $this->model->where("id", $id)->with("wallet")->first();
    }
}