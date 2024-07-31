<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProductsService
{
    public function findAll(array $filters, int $page, int $perPage, string $sortBy, string $order): LengthAwarePaginator
    {
        $query = Product::query();


        if (isset($filters['search'])) {
            $query->where('name', 'like', "%{$filters['search']}%");
        }

        $query->orderBy($sortBy, $order);


        return $query->paginate($perPage, ['*'], 'page', $page);
    }
}
