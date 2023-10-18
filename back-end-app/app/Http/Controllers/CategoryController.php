<?php

namespace App\Http\Controllers;

use App\Http\Requests\Categories\CategoryStoreRequest;
use App\Http\Requests\Categories\CategoryUpdateRequest;
use App\Http\Resources\Categories\CategoryCollection;
use App\Http\Resources\Categories\CategoryResource;
use App\Http\Services\Categories\CategoryService;
use App\Models\Category;

class CategoryController extends Controller
{
    private CategoryService $categoryService;

    public function __construct(CategoryService $categoryService) {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $categories = $this->categoryService->getAllCategories();

        return new CategoryCollection($categories);
    }

    public function store(CategoryStoreRequest $request)
    {
        $data = $request->validated();
        $category = $this->categoryService->createCategory($data);
        return new CategoryResource($category);
    }

    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $data = $request->validated();
        $category = $this->categoryService->updateCategory($category,$data);
        return new CategoryResource($category);
    }

    public function destroy(Category $category)
    {
        $this->categoryService->deleteCategory($category);

        return response()->noContent();
    }
}
