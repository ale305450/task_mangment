<?php

namespace App\Core\DTOs\Projects;


class ProjectDTO
{
    public string $name;
    public string $description;
    public int $category_id;
    public int $user_id;

    public function __construct(string $name, string $description, int $category_id,int $user_id)
    {
        $this->name = $name;
        $this->description = $description;
        $this->category_id = $category_id;
        $this->user_id = $user_id;
    }
}
