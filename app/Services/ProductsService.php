<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProductsService
{

    public function find(string $slug, bool $withTrashed = false): mixed
    {
        return Product::query()->where('is_published', true)->where('slug', $slug)->first();
    }
    public function findAll(?array $filters, int $page=1, int $first=10, string $sort='name', string $order = 'desc'): LengthAwarePaginator
    {
        $query = Product::query();


        if (isset($filters['search'])) {
            $query->where('name', 'like', "%{$filters['search']}%");
        }

        $query->orderBy($sort, $order);


        return $query->paginate($first, ['*'], 'page', $page);
    }
}
