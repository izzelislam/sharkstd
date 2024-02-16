<?php

namespace App\Services\ProductCategory;

use App\Models\ProductCategory;
use LaravelEasyRepository\Service;
use App\Repositories\ProductCategory\ProductCategoryRepository;

class ProductCategoryServiceImplement extends Service implements ProductCategoryService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(ProductCategoryRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    public function findBySlug($slug) :ProductCategory
    {
      return $this->mainRepository->findSlug($slug);
    }
}
