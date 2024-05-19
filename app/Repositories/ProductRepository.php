<?php

namespace App\Repositories;

use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductRepository implements ProductRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Returns the list of products.
     * @param int $perPage
     * @param string $name
     * @param string $code
     * @return LengthAwarePaginator|null
     */
    public function getPaginatedAndFilteredProducts(int $perPage, string $name, string $code): ?LengthAwarePaginator
    {
        $data = null;
        try {
            $qb = DB::table('products');
            if(!empty($name)){
                $qb->where('name', $name);
            }
            if(!empty($code)){
                $qb->where('code', $code);
            }
            $qb->orderBy('code');
            $data = $qb->paginate($perPage);
        } catch (Exception $exception) {
            $this->logException($exception);
        }
        return $data;
    }

    /**
     * Log Exceptions into the log file.
     * Log Query and Bindings separately for any SQL exceptions
     * @param $e
     * @return void
     */
    private function logException($e): void
    {
        Log::error($e->getMessage());
        if ($e instanceof QueryException) {
            Log::error($e->getSql(), $e->getBindings());
        }
    }
}
