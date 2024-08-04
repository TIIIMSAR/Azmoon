<?php 


namespace App\Entites\Category;

interface CategoryEntity
{
    public function getId(): int;

    public function getName(): string;

    public function getSlug(): string;
}