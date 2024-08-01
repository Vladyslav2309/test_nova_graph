<?php
namespace App\Services;

use App\Models\Brand;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class BrandsService
{
    public function find($id, bool $withTrashed = false): mixed
    {
        return Brand::query()->where('id', $id)->first();
    }

    public function findAll(?array $filters, int $page=1, int $first=10, string $sort='name', string $order = 'desc'): LengthAwarePaginator
    {
        $query = Brand::query();

        if (isset($filters['search'])) {
            $query->where('name', 'like', "%{$filters['search']}%");
        }

        $query->orderBy($sort, $order);

        return $query->paginate($first, ['*'], 'page', $page);
    }
}
