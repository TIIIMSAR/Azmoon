<?php 

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Contracts\UserRepositorieInterface;
use App\Repositories\Eloquent\EloquentBaseRepositoriy;


class EloquentUserRepositoriy extends EloquentBaseRepositoriy implements UserRepositorieInterface
{
    protected $model = User::class;

}