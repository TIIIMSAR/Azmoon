<?php

namespace App\Entites\User;

use App\Models\User;

class UserEloquntEntity implements UserEntitiy
{
    protected $user;
    public function __construct(User|null $user)
    {
        $this->user = $user;
    }
    public function getId(): int
    {
        return optional($this->user)->id ?? 0; // یا مقدار مناسب دیگر به جای 0
    }

    public function getFullName(): string
    {
        return optional($this->user)->full_name ?? 'نام پیش‌فرض';
    }

    public function getEmail(): string
    {
        return optional($this->user)->email ?? '123123fa@gmail.com';
    }

    public function getMobile(): string
    {
        return optional($this->user)->mobile ?? 'موبایل پیش‌فرض';
    }

    public function getPassword(): string
    {
        return optional($this->user)->password ?? 'پسورد پیش‌فرض';
    }
}