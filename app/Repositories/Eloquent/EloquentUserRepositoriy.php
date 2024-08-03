<?php 

namespace App\Repositories\Eloquent;

use App\Entites\User\UserEloquentEntity;
use App\Entites\User\UserEloquntEntity;
use App\Entites\User\UserEntitiy;
use App\Entites\User\UserJsonEntity;
use App\Models\User;
use App\Repositories\Contracts\UserRepositorieInterface;
use App\Repositories\Eloquent\EloquentBaseRepositoriy;


class EloquentUserRepositoriy extends EloquentBaseRepositoriy implements UserRepositorieInterface
{
    protected $model = User::class;

    public function create(array $data)
    {
        // dd('4EloquentUserRepositoriy');
        $newUser = parent::create($data);

        return new UserEloquntEntity($newUser);
    }


    public function update(int $id, array $data): UserEntitiy
    {
        if(!parent::update($id, $data))
            throw new \Exception('کاربر بروز رسانی نشد');

        return new UserEloquntEntity(parent::find($id));
    }
}