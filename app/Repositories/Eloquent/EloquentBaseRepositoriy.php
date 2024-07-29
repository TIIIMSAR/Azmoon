<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\RepositorieInterface;

class EloquentBaseRepositoriy implements RepositorieInterface     
{
    protected $model;

    public function create(array $data)
    {
        $this->model::create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->model::where('id', $id)->update($data);
    }

    public function all(array $where)
    {
        $query = $this->model::query();

        // name => ali
        // family => hossiny
        foreach ($where as $key => $value) 
        {
            $query->where($key, $value);
        }

            return $query->get();

    }

    public function delete(array $where)
    {
        
        $query = $this->model::query();

        // name => ali
        // family => hossiny
        foreach ($where as $key => $value) 
        {
            $query->where($key, $value);
        }

            return $query->delete();
    }

    public function find(int $id)
    {
        return $this->model::find($id);
    }    
}