<?php

namespace App\Services\License;

use App\Models\License;
use LaravelEasyRepository\BaseService;

interface LicenseService extends BaseService{

    public function withOrderRaw(string $args);
}
