<?php

namespace App\Services\Feature;

use LaravelEasyRepository\Service;
use App\Repositories\Feature\FeatureRepository;

class FeatureServiceImplement extends Service implements FeatureService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(FeatureRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    // Define your custom methods :)
}
