<?php

namespace App\Http\Controllers;

use App\Exceptions\UploadImageException;
use App\Http\Requests\Products\ProductStoreRequest;
use App\Http\Requests\Products\ProductUpdateRequest;
use App\Http\Resources\Products\ProductCollection;
use App\Http\Resources\Products\ProductResource;
use App\Services\Products\ProductService;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private ProductService $productService;

    public function __construct(ProductService $productService) {
        $this->productService = $productService;
    }

    public function index(): ProductCollection
    {
        $products = $this->productService->getAllProducts();

        return new ProductCollection($products);
    }

    public function store(ProductStoreRequest $request): ProductResource
    {
        $data = $request->validated();
        try {
            if ($request->hasFile('image')) {
            $hashedName = hash_file('sha256', $data['image']->path());
            $extension = $data['image']->getClientOriginalExtension();
            $filename = $hashedName . '.' . $extension;
            $data['image']->storeAs('public/products/', $filename);
            $pathToFile = asset('storage/products/'.$filename);
            $data['image'] = $pathToFile;
            }
        } catch (\Exception $exception) {
            throw new UploadImageException(
                $exception->getCode(),
                $exception
            );
        }

        $product = $this->productService->createProduct($data);
        return new ProductResource($product);
    }

    public function update(ProductUpdateRequest $request, Product $product): ProductResource
    {
        $data = $request->validated();
        $product = $this->productService->updateProduct($product,$data);
        return new ProductResource($product);
    }

    public function destroy(Product $product)
    {
        $this->productService->deleteProduct($product);

        return response()->noContent();
    }

    public function searchProduct(Request $request): ProductCollection
    {

        $data = ['category_id' => $request->category_id,
            'minPrice'=>$request->minPrice,
            'maxPrice'=>$request->maxPrice,
        ];

        return new ProductCollection($this->productService->searchProduct($data));
    }
}
