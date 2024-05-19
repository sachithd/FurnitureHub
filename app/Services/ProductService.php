<?php

namespace App\Services;

use App\Repositories\ProductRepositoryInterface;

class ProductService
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected ProductRepositoryInterface $repository)
    {
        //
    }

    /**
     * Returns the paginated list of products filter by name and/or code
     * @param int $perPage
     * @param string $name
     * @param string $code
     * @return array
     */
    public function getProducts(int $perPage, string $name, string $code): array
    {
        $response = [
            "error" => false,
            "message" => '',
            "data" => null
        ];
        $result = $this->repository->getPaginatedAndFilteredProducts($perPage, $name, $code);

        if(is_null($result)){
            $response['error'] = true;
            $response['message'] = 'Database error';
        }
        else{
            $response['data'] = $result;
        }

        return $response;
    }
}
