<?php

namespace App\Interfaces\Products;

use App\Models\Product;

interface ProductRepositoryInterface {
    public function createProduct(array $data);
    public function updateProduct(Product $product, array $data);
    public function deleteProduct(Product $product);
    public function getAllProducts();
}
