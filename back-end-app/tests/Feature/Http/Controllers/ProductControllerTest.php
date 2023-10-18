<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ProductController
 */
class ProductControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $products = Product::factory()->count(3)->create();

        $response = $this->get(route('product.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUses(
            \App\Http\Controllers\ProductController::class,
            'store',
            \App\Http\Requests\Products\ProductStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $name = $this->faker->name;
        $description = $this->faker->text;
        $price = $this->faker->randomFloat(/** float_attributes **/);
        $image = $this->faker->word;

        $response = $this->post(route('product.store'), [
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'image' => $image,
        ]);

        $products = Product::query()
            ->where('name', $name)
            ->where('description', $description)
            ->where('price', $price)
            ->where('image', $image)
            ->get();
        $this->assertCount(1, $products);
        $product = $products->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUses(
            \App\Http\Controllers\ProductController::class,
            'update',
            \App\Http\Requests\Products\ProductUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $product = Product::factory()->create();
        $name = $this->faker->name;
        $description = $this->faker->text;
        $price = $this->faker->randomFloat(/** float_attributes **/);
        $image = $this->faker->word;

        $response = $this->put(route('product.update', $product), [
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'image' => $image,
        ]);

        $product->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($name, $product->name);
        $this->assertEquals($description, $product->description);
        $this->assertEquals($price, $product->price);
        $this->assertEquals($image, $product->image);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $product = Product::factory()->create();

        $response = $this->delete(route('product.destroy', $product));

        $response->assertNoContent();

        $this->assertModelMissing($product);
    }
}
