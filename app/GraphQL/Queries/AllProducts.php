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
        $query = Product::query();

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
