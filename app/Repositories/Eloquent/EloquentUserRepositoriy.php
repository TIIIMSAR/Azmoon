<?php 

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Eloquent\EloquentBaseRepositoriy;
use App\Repositories\Contracts\UserRepositoriyInterface;


class EloquentUserRepositoriy extends EloquentBaseRepositoriy implements UserRepositoriyInterface
{
    protected $model = User::class;

}