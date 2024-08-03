<?php

namespace App\Repositories\Json;

use App\Entites\User\UserEntity;
use App\Entites\User\UserJsonEntity;
use App\Repositories\Contracts\RepositorieInterface;

class JsonBaseRepository implements RepositorieInterface
{
    protected $JsonModel; 

    public function create(array $data)
    {
        if (file_exists($this->JsonModel)) {
            $users = json_decode(file_get_contents($this->JsonModel), true);
            $data['id'] = rand(1, 1000);
            array_push($users, $data);
            file_put_contents($this->JsonModel, json_encode($users));
        } else {
            $users = [];
            $data['id'] = rand(1, 1000);
            array_push($users, $data);
            file_put_contents($this->JsonModel, json_encode($users));
        }

        return $data;
    }   

    public function update(int $id, array $data)
    {
        $users = json_decode(file_get_contents('users.json'), true);

        foreach($users as $key => $user)
        {
            if($user['id'] = $id)
                $user['full_name'] = $data['full_name'] ?? $user['full_name'];
                $user['mobile'] = $data['mobile'] ?? $user['mobile'];
                $user['email'] = $data['email'] ?? $user['email'];
                        
                    unset($users[$key]);
                array_push($users, $user); 

                if(file_exists('users.json'))
                unlink('users.json');

                file_put_contents('users.json', json_encode($users));
            break;
        }

    }    

    public function all(array $where)
    {

    }

    public function delete(int $id)
    {
        $users = json_decode(file_get_contents('users.json'), true);

        foreach($users as $key => $user)
        {
            if($user['id'] == $id){

                unset($users[$key]);

                if(file_exists('users.json'))
                    unlink('users.json');

                file_put_contents('users.json', json_encode($users));
            break;
        }
            
        }
    }

    public function deleteBy(array $where)
    {

    }

    public function find(int $id)
    {
        $users = json_decode(file_get_contents(base_path() . 'users.json'), true);
            foreach($users as $user)
                if($user['id'] == $id)
                    return $user;

            return [];
    }


    public function paginate(string $search = null, int $page, int $pagesize = 20)
    {
        $users = json_decode(file_get_contents(base_path() . '/users.json'), true);

        if(!is_null($search))
            foreach($users as $key => $user)
                if(array_search($search, $user))
                    return $users[$key];

        $totalRecords = count($users);
        $totalPage =   ceil($totalRecords / $pagesize);

        if($page > $totalPage)
            $page = $totalPage;

        if($page < 1)
            $page = 1;


        $ofdset = ($page - 1) * $pagesize;

        return array_slice($users, $ofdset, $pagesize);
    }
}