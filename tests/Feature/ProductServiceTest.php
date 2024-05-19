<?php

namespace Tests\Feature;

use App\Services\ProductService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\MockObject\Exception;
use stdClass;
use Tests\TestCase;

class ProductServiceTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * @throws Exception
     */
    public function testGetProducts(){

        $productPerPage = config('custom.vitsoe.database.records_per_page');
        $dataObject = new stdClass();
        $dataObject->data = array_fill(0, $productPerPage, 'Test');

        $response = [
            "error" => false,
            "message" => '',
            "data" => $dataObject
        ];

        $productService = $this->createStub(ProductService::class);
        $productService
            ->method('getProducts')
            ->with(
                $this->equalTo($productPerPage),
            )
            ->willReturn($response);

        $actualResult = $productService->getProducts($productPerPage, "", "");
        $this->assertEquals($actualResult,$response);
    }
}
