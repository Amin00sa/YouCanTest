<?php

namespace App\Http\Repositories\Categories;

use App\Http\Interfaces\Categories\CategoryRepositoryInterface;
use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface {

    // Implement other methods
    public function createCategory(array $data)
    {
        return Category::create($data);
    }

    public function updateCategory(Category $product, array $data)
    {
        // TODO: Implement updateProduct() method.
    }

    public function deleteCategory(Category $product)
    {
        // TODO: Implement deleteProduct() method.
    }

    public function getAllCategories(): \Illuminate\Database\Eloquent\Collection
    {
        return Category::with('parent')->get();
    }
}
