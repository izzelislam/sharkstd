<?php

namespace App\Repositories\Image;

use App\Models\Image;
use LaravelEasyRepository\Repository;

interface ImageRepository extends Repository{

    public function withCondition(array $condition); 
}
