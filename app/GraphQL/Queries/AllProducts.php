<?php

namespace App\GraphQL\Queries;

use App\Models\Product;

use App\Services\ProductsService;

class AllProducts
{
    /**
     * @param  null  $_
     * @param  array  $args
     * @return array
     */

    protected ProductsService $products;

    public function __construct(ProductsService $products)
    {
        $this->products = $products;
    }
    public function __invoke($_, array $args): array
    {
        $page = $args['page'] ?? 1;

        $products = $this->products->findAll([
            'search' => $args['search'] ?? null,
        ],
            $page,
            $args['first'] ?? 10,
            $args['sort'] ?? 'created_at',
            $args['order'] ?? 'desc',
        );

        return [
            'data' => $products,
            'paginatorInfo' => [
                'currentPage' => $page,
                'lastPage' => $products->lastPage(),
                'total' => $products->total(),
            ],
        ];
    }

}
