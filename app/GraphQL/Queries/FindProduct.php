<?php

namespace App\GraphQL\Queries;

use App\Models\Product;

class FindProduct
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     * @return ProductQuery|null
     */
    public function __invoke($_, array $args): ?Product
    {
        if (isset($args['id'])) {
            return Product::find($args['id']);
        }

        return null;
    }
}
