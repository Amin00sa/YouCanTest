<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Http\Services\Products\ProductService;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private ProductService $productService;

    public function __construct(ProductService $productService) {
        $this->productService = $productService;
    }

    public function index()
    {
        $products = $this->productService->getAllProducts();

        return new ProductCollection($products);
    }

    public function store(ProductStoreRequest $request)
    {
        $data = $request->validated();
        $product = $this->productService->createProduct($data);
        return new ProductResource($product);
    }

    public function update(ProductUpdateRequest $request, Product $product)
    {
        $data = $request->validated();
        $product = $this->productService->updateProduct($product,$data);
        return new ProductResource($product);
    }

    public function destroy(Product $product)
    {
        $this->productService->deleteCategory($product);

        return response()->noContent();
    }
}
