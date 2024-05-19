<?php

namespace App\Repositories;

interface ProductRepositoryInterface
{
    public function getPaginatedAndFilteredProducts(int $perPage, string $name, string $code);
}
