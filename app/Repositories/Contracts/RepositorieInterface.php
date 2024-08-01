<?php

namespace App\Repositories\Contracts;

interface RepositorieInterface 
{
    public function create(array $data);

    public function update(int $id, array $data);

    public function all(array $where);

    public function delete(array $where);

    public function find(int $id);

}
