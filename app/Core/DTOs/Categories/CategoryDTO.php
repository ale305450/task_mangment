<?php

namespace App\Core\Dtos\Categories;


class CategoryDTO
{
    public string $name;
    public function __construct(string $name)
    {
        $this->name = $name;
    }
}
