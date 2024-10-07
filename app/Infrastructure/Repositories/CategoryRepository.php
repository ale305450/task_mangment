<?php

namespace App\Infrastructure\Repositories;

use App\Core\Contracts\CategoryRepositoryInterface;
use App\Core\Dtos\Categories\CategoryDTO;
use App\Core\Entities\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function all(): Collection
    {
        return Category::all()->select(['id', 'name']);
    }
    public function create(CategoryDTO $categoryDTO): Category
    {
        return Category::create([
            'name' => $categoryDTO->name,
        ]);
    }
    public function find($id): Category
    {
        return Category::find($id);
    }
    public function update($id, CategoryDTO $categoryDTO): Category
    {
        $category = $this->find($id);
        $category->update(['name' => $categoryDTO->name]);
        return $category;
    }
    public function delete($id)
    {
        $category = $this->find($id);
        $category->delete();
    }
}
