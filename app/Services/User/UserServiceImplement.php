<?php

namespace App\Services\User;

use LaravelEasyRepository\Service;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Crypt;

class UserServiceImplement extends Service implements UserService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(UserRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    public function find($id)
    {
      $id_dec = Crypt::decryptString($id);
      $model = $this->mainRepository->find($id_dec);
      return $model;
    }

    public function update($id, array $data)
    {
      $id_dec      = Crypt::decryptString($id);
      
      if (empty($data["password"])){
        $single_data = $this->find($id); 
        $data["password"] = $single_data->password;
      }

      $model = $this->mainRepository->update($id_dec, $data);
      return $model;
    }

    public function delete($id)
    {
      $id_dec = Crypt::decryptString($id);
      $model  = $this->mainRepository->delete($id_dec);
      return $model;
    }
}
