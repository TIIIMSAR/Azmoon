<?php

namespace App\Entites\User;

class UserJsonEntity implements UserEntity
{
    protected $user;
    public function __construct(array|null $user)
    {
        $this->user = $user;
    }

    public function getId(): int
    {
        return $this->user['id'];
    }

    public function getName(): string
    {
        return $this->user['full_name'];
    }

    public function getEmail(): string
    {
        return $this->user['email'];
    }
}