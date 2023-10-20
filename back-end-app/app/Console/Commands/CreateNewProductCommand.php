<?php

namespace App\Console\Commands;

use App\Http\Requests\Categories\CategoryStoreRequest;
use App\Http\Requests\Products\ProductStoreRequest;
use App\Models\Category;
use App\Repositories\Categories\CategoryRepository;
use App\Repositories\Products\ProductRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CreateNewProductCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Product';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    protected CategoryRepository $categoryRepository;

    protected ProductRepository $productRepository;

    public function __construct(
        CategoryRepository $categoryRepository,
        ProductRepository  $productRepository
    )
    {
        parent::__construct();
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * Execute the console command.
     *
     * @return int
     * @throws ValidationException
     */
    public function handle(): int
    {
        // Create a new Category
        $category = $this->handleCategoryCreation();

        //Create a new Product
        $this->handleProductCreation((int)$category);

        return "Product Added successfully";
    }

    /**
     * handleCategoryCreation Creation and display
     * @return Category
     * @throws ValidationException
     */
    private function handleCategoryCreation(): Category
    {
        // Display a list of categories for the user to choose from
        $this->info('Available Categories:');
        $categories = $this->categoryRepository->getAllCategories();
        $categoryRows = $categories->map(function ($category) {
            return [
                'Id' => $category->id,
                'Parent Id' => $category->parent_id,
                'Name' => $category->name,
                'Created At' => $category->created_at->toDateTimeString(),
                'Updated At' => $category->updated_at->toDateTimeString(),
            ];
        })->toArray();

        $this->table(
            ['Id', 'Parent Id', 'Name', 'Created At', 'Updated At'],
            $categoryRows
        );

        $categoryID = $this->ask('Enter the Id of the selected category or enter "create" to create a new category');

        if ($categoryID === 'create') {

            $categoryData = [
                'name' => $this->ask('Enter the name of the new category')
            ];

            $categoryValidator = Validator::make($categoryData, (new CategoryStoreRequest())->rules());

            $this->showErrorMessage($categoryValidator);

            $categoryValidatedData = $categoryValidator->validated();

            $this->info('New category created successfully.');

            $category = $this->categoryRepository->createCategory($categoryValidatedData);

            return $category->id;
        }
        return $categoryID;
    }


    /**
     * @param int $categoryId
     * @return void
     * @throws ValidationException
     */
    private function handleProductCreation(int $categoryId)
    {

        $productData = [
            'name' => $this->ask('Enter the product name'),
            'description' => $this->ask('Enter the product description'),
            'price' => $this->ask('Enter the product price, should be numeric please'),
            'image' => $this->checkFileExist(
                $this->ask('Enter the product image path: image should be in storage/app/products/path')
            ),
            'category_id' => $categoryId
        ];

        $productValidator = Validator::make($productData, (new ProductStoreRequest())->rules());

        $this->showErrorMessage($productValidator);

        $validatedData = $productValidator->validated();

        $this->productRepository->createProduct($validatedData);

        $this->info("Product created successfully!");

    }

    /**
     * @param $validator
     * @return void
     */
    private function showErrorMessage($validator)
    {
        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
            exit(1);
        }
    }

    /**
     * @param string $path
     * @return string|void
     */
    private function checkFileExist(string $path)
    {
        if (!Storage::exists($path)) {
            $this->info('file does note exists in storage/app folder');
            exit(1);
        }
        return $path;
    }
}
