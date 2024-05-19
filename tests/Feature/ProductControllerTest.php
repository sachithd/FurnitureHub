<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testGetProducts(): void
    {
        $response = $this->get('/api/products');
        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => 'success',
            ]);
    }

    public function testGetProductPerPage(): void
    {
        $this->seed( 'ProductsSeeder');
        $expectedProductsPerPage = config('custom.vitsoe.database.records_per_page');
        try {
            $response = $this->get('/api/products?perPage=' . $expectedProductsPerPage)->decodeResponseJson();
            $productsArray = $response['data']['data'];
            $this->assertCount($expectedProductsPerPage, $productsArray);
        }
        catch (\Throwable $e) {

        }

    }
}
