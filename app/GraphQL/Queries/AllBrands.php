<?php

namespace App\GraphQL\Queries;

use App\Models\Brand;
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
        $page = $args['page'] ?? 1;

        $brands = $this->brands->findAll([
            'search' => $args['search'] ?? null,
        ],
            $page,
            $args['first'] ?? 10,
            $args['sort'] ?? 'created_at',
            $args['order'] ?? 'desc',
        );

        return [
            'data' => $brands,
            'paginatorInfo' => [
                'currentPage' => $page,
                'lastPage' => $brands->lastPage(),
                'total' => $brands->total(),
            ],
        ];
    }
}
