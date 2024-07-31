<?php declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Models\Brand;

class BrandQuery
{
    public function __invoke($_, array $args)
    {
        return Brand::find($args['input']['id']);
    }
}
