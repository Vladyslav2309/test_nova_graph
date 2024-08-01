<?php declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Models\Brand;
use App\Models\Product;
use App\Services\BrandsService;


class AllBrands
{
    protected BrandsService $brands;

    public function __construct(BrandsService $brands)
    {
        $this->brands = $brands;
    }

    public function __invoke($_, array $args): array
    {
        $query = Brand::query();

        if (!empty($args['search'])) {
            $query->where('name', 'like', '%' . $args['search'] . '%');
        }

        if (!empty($args['sort']) && !empty($args['order'])) {
            $query->orderBy($args['sort'], $args['order']);
        }

        $paginator = $query->paginate(
            $args['first'] ?? 10,
            ['*'],
            'page',
            $args['page'] ?? 1
        );

        return [
            'data' => $paginator->items(),
            'paginatorInfo' => [
                'currentPage' => $paginator->currentPage(),
                'lastPage' => $paginator->lastPage(),
                'total' => $paginator->total(),
            ],
        ];
    }
}
