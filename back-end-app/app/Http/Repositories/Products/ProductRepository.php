<?php

namespace App\Http\Repositories\Products;

use App\Http\Interfaces\Products\ProductRepositoryInterface;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

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

    public function updateProduct(Product $product, array $data): Product
    {
         $product->update($data);
        return $product;
    }

    public function deleteProduct(Product $product): ?bool
    {
        return $product->delete();
    }

    public function getAllProducts(): Collection
    {
        return Product::with('category')->get();
    }
}
