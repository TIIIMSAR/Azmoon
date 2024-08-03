<?php

namespace App\Repositories\Json;

use App\Entites\User\UserEntity;
use App\Entites\User\UserJsonEntity;
use App\Repositories\Json\JsonBaseRepository;
use App\Repositories\Contracts\UserRepositorieInterface;

class JsonUserRepository extends JsonBaseRepository implements UserRepositorieInterface
{
    protected $JsonModel = 'users.json';

    public function create(array $data): UserEntity
    {  
       $newUser = parent::create($data);
       
       return new UserEntity($newUser);
    }

    public function find(int $id): UserEntity
    {
        $user = parent::find($id);

        return new UserJsonEntity($user);
    }


}