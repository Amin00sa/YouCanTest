<?php

namespace App\Http\Services\Products;

use App\Http\Interfaces\Products\ProductServiceInterface;
use App\Http\Repositories\Products\ProductRepository;
use App\Models\Product;

class ProductService implements ProductServiceInterface {

    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository) {
        $this->productRepository = $productRepository;
    }
    public function createProduct(array $data) {
        return $this->productRepository->createProduct($data);
    }
    // Implement other methods
    public function updateProduct(Product $product, array $data)
    {
        // TODO: Implement updateProduct() method.
    }

    public function deleteProduct(Product $product)
    {
        // TODO: Implement deleteProduct() method.
    }

    public function getAllProducts()
    {
        return $this->productRepository->getAllProducts();
    }
}
