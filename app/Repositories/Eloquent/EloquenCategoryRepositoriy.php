<?php

namespace App\Repositories\Eloquent;

use App\Entites\Category\CategoryEloquntEntity;
use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositorieInterface;

class EloquenCategoryRepositoriy extends EloquentBaseRepositoriy implements CategoryRepositorieInterface
{
    protected $model = Category::class;
    
    public function create(array $data)
    {
        $createdCategory =  parent::create($data);

        return new CategoryEloquntEntity($createdCategory);
    } 
}