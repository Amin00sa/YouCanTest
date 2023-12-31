<?php

namespace App\Services\Products;

use App\Interfaces\Products\ProductServiceInterface;
use App\Repositories\Products\ProductRepository;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductService implements ProductServiceInterface {

    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository) {
        $this->productRepository = $productRepository;
    }
    public function createProduct(array $data) {
        return $this->productRepository->createProduct($data);
    }
    // Implement other methods
    public function updateProduct(Product $product, array $data): Product
    {
        return $this->productRepository->updateProduct($product,$data);
    }

    public function deleteProduct(Product $product): ?bool
    {
        return $this->productRepository->deleteProduct($product);
    }

    public function getAllProducts():Collection
    {
        return $this->productRepository->getAllProducts();
    }

    public function searchProduct(array $data): Collection
    {
        return $this->productRepository->searchProduct($data);
    }
}
