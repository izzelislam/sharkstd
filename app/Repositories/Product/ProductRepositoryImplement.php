<?php

namespace App\Repositories\Product;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Product;

class ProductRepositoryImplement extends Eloquent implements ProductRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    public function find($id)
    {
        return $this->model->where("slug", $id)->with([
            'productCategory', 'tools', 'features', 'compatibles', 'licenses', 'images'
        ])->first();
    }

    public function update($id, array $data)
    {
        $model = $this->find($id);
        $model->update($data);
        return $model;
    }

    public function delete($id)
    {
        $model = $this->find($id);
        $model->delete();
        return $model;
    }

    public function findTrashed(string $slug): Product
    {
        try {
            return $this->model->where("slug", $slug)->with([
                'productCategory', 'tools', 'features', 'compatibles', 'licenses', 'images'
            ])->withTrashed()->first();
        } catch (\Throwable $e) {
            return $e->getMessage;
        }
    }

    public function forseDelete(string $slug): bool
    {
        $model = $this->model->find($slug);
        $model->forceDelete();
        return true;
    }

    public function withCondition(array $condition, array $with = [], int $paginate = null , int $limit = null, array $order_by = [])
    {
        $query = $this->model->where($condition);
        
        if (count($order_by) > 0){
            $query->orderBy($order_by[0], $order_by[1]);
        }

        if (count($with) > 0){
            $query->with($with);
        }

        if ($paginate != null){
            $model = $query->paginate($paginate);
        }

        if ($limit != null){
            $model = $query->limit($limit)->get();
        }

        if ($paginate == null && $limit == null){
            $model = $query->get();
        }


        return $model;
    }
}
