<?php

namespace App\Services\Compatible;

use LaravelEasyRepository\Service;
use App\Repositories\Compatible\CompatibleRepository;

class CompatibleServiceImplement extends Service implements CompatibleService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(CompatibleRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    // Define your custom methods :)
}
