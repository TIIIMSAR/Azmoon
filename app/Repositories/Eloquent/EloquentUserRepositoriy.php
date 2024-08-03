<?php 

namespace App\Repositories\Eloquent;

use App\Entites\User\UserEloquentEntity;
use App\Entites\User\UserEloquntEntity;
use App\Entites\User\UserJsonEntity;
use App\Models\User;
use App\Repositories\Contracts\UserRepositorieInterface;
use App\Repositories\Eloquent\EloquentBaseRepositoriy;


class EloquentUserRepositoriy extends EloquentBaseRepositoriy implements UserRepositorieInterface
{
    protected $model = User::class;

    public function create(array $data)
    {
        $newUser = parent::create($data);
            
        return new UserEloquntEntity($newUser);
    }

}