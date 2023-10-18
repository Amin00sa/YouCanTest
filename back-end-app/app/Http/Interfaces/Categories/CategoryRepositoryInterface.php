<?php

namespace App\Http\Interfaces\Categories;

use App\Models\Category;

interface CategoryRepositoryInterface {
    public function createCategory(array $data);
    public function updateCategory(Category $product, array $data);
    public function deleteCategory(Category $product);
    public function getAllCategories();
}
