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

    public function update(int $id, array $data)
    {
        if(!parent::update($id, $data))
        {
            throw new \Exception('دسته بندی بروز رسانی نشد');
        }
            return new CategoryEloquntEntity(parent::find($id));
    }
}