<?php

namespace App\Repositories\Payout;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Payout;

class PayoutRepositoryImplement extends Eloquent implements PayoutRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Payout $model)
    {
        $this->model = $model;
    }

    public function find($id)
    {
        return $this->model->where("id", $id)->with("admin.wallet")->first();
    }
}
