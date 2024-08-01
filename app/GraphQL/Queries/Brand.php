<?php declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Models\Brand as BrandQuery;
use App\Services\BrandsService;

class Brand
{
    protected BrandsService $brands;

    public function __construct(BrandsService $brands)
    {
        $this->brands=$brands;
    }

    public function __invoke($_, array $args)
    {
        return $this->brands->find($args['id']);
    }
}
