<?php

namespace App\Repositories\Products;

use App\Interfaces\Products\ProductRepositoryInterface;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;

class ProductRepository implements ProductRepositoryInterface {

    // Implement methods
    public function createProduct(array $data)
    {
        return Product::create($data);
    }

    public function updateProduct(Product $product, array $data): Product
    {
        if ($data['image'] != null) {
            $hashedName = hash_file('sha256', $data['image']->path());
            $extension = $data['image']->getClientOriginalExtension();
            $filename = $hashedName . '.' . $extension;
            $data['image']->storeAs('public/products/', $filename);
            if ($product->image) {
                $existingFilePath = $product->image;
                if (Storage::disk('public')->exists($existingFilePath)) {
                    Storage::disk('public')->delete($existingFilePath); // Delete the file from the server
                }
            }
            $pathToFile = asset('storage/products/'.$filename);
            $data['image'] = $pathToFile;
        }
        $product->update($data);
        return $product;
    }

    public function deleteProduct(Product $product): ?bool
    {
        return $product->delete();
    }

    public function searchProduct(array $data): Collection
    {
        $query = Product::with('category');

        if ($data['category_id'] != 'null') {
            $categoryId = $data['category_id'];
            $query->whereHas('category', function ($q) use ($categoryId) {
                $q->where('category_id', $categoryId);
            });
        }

        if ($data['maxPrice'] != 'null') {
            $minPrice = $data['minPrice'];
            $maxPrice = $data['maxPrice'];
            $query->whereBetween('price', [$minPrice, $maxPrice]);
        }

        return $query->get();
    }

    public function getAllProducts(): Collection
    {
        return Product::with('category')->get();
    }
}
