<?php

namespace App\Services\Payout;

use LaravelEasyRepository\Service;
use App\Repositories\Payout\PayoutRepository;

class PayoutServiceImplement extends Service implements PayoutService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(PayoutRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    // Define your custom methods :)
}
