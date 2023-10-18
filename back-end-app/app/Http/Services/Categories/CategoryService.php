<?php

namespace App\Http\Services\Categories;

use App\Http\Interfaces\Categories\CategoryServiceInterface;
use App\Http\Repositories\Categories\CategoryRepository;
use App\Models\Category;

class CategoryService implements CategoryServiceInterface {

    private CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository) {
        $this->categoryRepository = $categoryRepository;
    }
    public function createCategory(array $data)
    {
        return $this->categoryRepository->createCategory($data);
    }
    // Implement other methods
    public function updateCategory(Category $product, array $data)
    {
        // TODO: Implement updateProduct() method.
    }

    public function deleteCategory(Category $product)
    {
        // TODO: Implement deleteProduct() method.
    }

    public function getAllCategories()
    {
        return $this->categoryRepository->getAllCategories();
    }
}
