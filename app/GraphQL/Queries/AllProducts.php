<?php

namespace App\GraphQL\Queries;

use App\Models\Product;

class AllProducts
{
    /**
     * @param  null  $_
     * @param  array  $args
     * @return array
     */
    public function __invoke($_, array $args): array
    {
        $query = Product::query();

        if (!empty($args['input']['search'])) {
            $query->where('name', 'like', '%' . $args['input']['search'] . '%');
        }

        if (!empty($args['input']['sort']) && !empty($args['input']['order'])) {
            $query->orderBy($args['input']['sort'], $args['input']['order']);
        }

        $paginator = $query->paginate(
            $args['input']['first'] ?? 10,
            ['*'],
            'page',
            $args['input']['page'] ?? 1
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
