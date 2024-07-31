<?php

namespace App\GraphQL\Queries;

use App\Models\Product;

class ProductQuery
{
    public function __invoke($_, array $args)
    {
        return Product::find($args['input']['id']);
    }
}
