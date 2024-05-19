<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use App\Traits\RestApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use RestApiResponseTrait;
    public function __construct(protected ProductService $productService)
    {
    }

    public function index(Request $request): JsonResponse
    {

        $perPage = $request->input('perPage', config('custom.vitsoe.database.records_per_page'));
        $filterByCode = '';
        $filterByName = '';

        if($request->has('name')){
            $filterByName = $request->input('name');
        }
        if($request->has('code')){
            $filterByCode = $request->input('code');
        }

        $productResponse = $this->productService->getProducts($perPage, $filterByName, $filterByCode);

        if ($productResponse['error']) {
            return $this->error($productResponse['message']);
        }

        return $this->success($productResponse['message'], $productResponse['data'], 200);
    }
}
