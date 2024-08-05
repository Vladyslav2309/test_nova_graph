<?php
namespace App\GraphQL\Mutations;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;

class CartMutations
{
    public function addToCart($_, array $args)
    {
        $cart = Cart::firstOrCreate(['user_id' => $args['user_id']]);

        $product = Product::findOrFail($args['product_id']);
        $price = $product->price;


        $cartItem = CartItem::create([
            'cart_id' => $cart->id,
            'product_id' => $args['product_id'],
            'quantity' => $args['quantity'],
            'price' => $price,
        ]);

        return $cartItem;
    }

    public function removeFromCart($_, array $args)
    {
        $cartItem = CartItem::findOrFail($args['cart_item_id']);
        $cartItem->delete();

        return true;
    }

    public function updateCartItem($_, array $args)
    {
        $cartItem = CartItem::findOrFail($args['cart_item_id']);
        $cartItem->update(['quantity' => $args['quantity']]);

        return $cartItem;
    }
}
