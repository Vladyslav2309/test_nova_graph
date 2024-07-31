<?php
namespace App\Services;

use App\Models\Brand;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class BrandsService
{
    public function findAll(array $filters, int $page, int $perPage, string $sortBy, string $order): LengthAwarePaginator
    {
        $query = Brand::query();

        if (isset($filters['search'])) {
            $query->where('name', 'like', "%{$filters['search']}%");
        }

        $query->orderBy($sortBy, $order);

        return $query->paginate($perPage, ['*'], 'page', $page);
    }
}
