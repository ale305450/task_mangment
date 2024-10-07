<?php

namespace App\Core\Contracts;

use App\Core\Dtos\Categories\CategoryDTO;
use App\Core\Entities\Category;
use Illuminate\Database\Eloquent\Collection;

interface CategoryRepositoryInterface
{
    public function all(): Collection;
    public function create(CategoryDTO $data): Category;
    public function find($id): Category;
    public function update($id, CategoryDTO $data): Category;
    public function delete($id);
}
