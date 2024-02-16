<?php

namespace App\Repositories\Wallet;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Wallet;

class WalletRepositoryImplement extends Eloquent implements WalletRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Wallet $model)
    {
        $this->model = $model;
    }

    public function find($id)
    {
        return $this->model->where("id", $id)->with("admin")->first();
    }
}
