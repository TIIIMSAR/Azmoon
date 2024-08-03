<?php

namespace App\Entites\User;

use App\Models\User;

class UserEloquntEntity implements UserEntitiy
{
    private $user;

    public function __construct(User|null $user)
    {
        // dd('6UserEloquntEntitiy');
        $this->user = $user;
    }

    public function getId(): int
    {
        return $this->user->id;
    }

    public function getFullName(): string
    {
        return $this->user->full_name;
    }

    public function getEmail(): string
    {
        return $this->user->email;
    }

    public function getMobile(): string
    {
        return $this->user->mobile;
    }

    public function getPassword(): string
    {
        return $this->user->password;
    }
}