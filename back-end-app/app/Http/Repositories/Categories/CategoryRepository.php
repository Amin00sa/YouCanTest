<?php

namespace App\Http\Repositories\Categories;

use App\Http\Interfaces\Categories\CategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository implements CategoryRepositoryInterface {

    // Implement other methods
    public function createCategory(array $data)
    {
        return Category::create($data);
    }

    public function updateCategory(Category $category, array $data): Category
    {
        $category->update($data);
        return $category;
    }

    public function deleteCategory(Category $category): ?bool
    {
        return $category->delete();
    }

    public function getAllCategories(): Collection
    {
        return Category::with('parent')->get();
    }
}
