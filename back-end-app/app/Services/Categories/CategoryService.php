<?php

namespace App\Services\Categories;

use App\Interfaces\Categories\CategoryServiceInterface;
use App\Repositories\Categories\CategoryRepository;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

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
    public function updateCategory(Category $category, array $data): Category
    {
        return $this->categoryRepository->updateCategory($category,$data);
    }

    public function deleteCategory(Category $category): ?bool
    {
        return $this->categoryRepository->deleteCategory($category);
    }

    public function getAllCategories(): Collection
    {
        return $this->categoryRepository->getAllCategories();
    }
}
