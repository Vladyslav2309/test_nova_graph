<?php

namespace App\Services;

namespace App\Services;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;

class CartService
{
    public function addToCart(int $userId, int $productId, int $quantity)
    {
        // попробуй переробити, без КартАйтем і зробити через звязок БагатоДоБагатьох сутності Карт до Продуктів з додатковими полями такими як Кількість і ціна
        // і попробуй передавати масив айдішок, не бійся пробувати щось калхозити
        $user = User::find($userId);
        $product = Product::find($productId);

        if (!$user || !$product) {
            return null;
        }

        $cart = $user->cart()->firstOrCreate(['user_id' => $userId]);

        $cartItem = $cart->items()->where('product_id', $productId)->first();

        if ($cartItem) {
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            // Добавление нового товара в корзину
            $cartItem = $cart->items()->create([
                'product_id' => $product->id,
                'quantity' => $quantity,
                'price' => $product->price,
            ]);
        }

        return $cartItem;
    }
}

