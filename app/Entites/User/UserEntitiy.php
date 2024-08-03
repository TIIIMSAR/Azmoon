<?php

namespace App\Entites\User;

interface UserEntitiy 
{
    public function getId(): int;

    public function getFullName(): string;

    public function getEmail(): string;

    public function getMobile(): string;

    public function getPassword(): string;
}