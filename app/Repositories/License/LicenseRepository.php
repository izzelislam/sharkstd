<?php

namespace App\Repositories\License;

use App\Models\License;
use LaravelEasyRepository\Repository;

interface LicenseRepository extends Repository{

    public function withOrderRaw(string $args);
}
