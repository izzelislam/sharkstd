<?php

namespace App\Services\License;

use App\Models\License;
use LaravelEasyRepository\Service;
use App\Repositories\License\LicenseRepository;

class LicenseServiceImplement extends Service implements LicenseService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(LicenseRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    public function withOrderRaw(string $args)
    {
      return $this->mainRepository->withOrderRaw($args);
    }
}
