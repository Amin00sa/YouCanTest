<?php

namespace App\Http\Repositories\Products;

use App\Http\Interfaces\Products\ProductRepositoryInterface;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface {

    // Implement methods
    public function createProduct(array $data)
    {
        $hashedName = hash_file('sha256', $data['image']->path());
        $extension = $data['image']->getClientOriginalExtension();
        $filename = $hashedName . '.' . $extension;
        $data['image']->storeAs('public/products/', $filename);
        $pathToFile = asset('storage/products/'.$filename);
        $data['image'] = $pathToFile;
        return Product::create($data);
    }

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
        return Product::with('category')->get();
    }
}
