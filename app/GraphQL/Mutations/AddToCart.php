<?php declare(strict_types=1);
namespace App\GraphQL\Mutations;
namespace App\GraphQL\Mutations;

use App\Services\CartService;

class AddToCart
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function __invoke($root, array $args)
    {
        $userId = (int) $args['user_id'];
        $productId = (int) $args['product_id'];
        $quantity = (int) $args['quantity'];

        return $this->cartService->addToCart($userId, $productId, $quantity);
    }
}
