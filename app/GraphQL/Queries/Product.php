<?php

namespace App\GraphQL\Queries;

use App\Models\Product as ProductQuery;
use App\Services\ProductsService;

class Product
{
    protected ProductsService $product;


    public function __construct(ProductsService $product)
    {
        $this->product = $product;
    }


    public function __invoke($_, array $args)
    {
        return $this->product->find($args['slug']);
    }
}
