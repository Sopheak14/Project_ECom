<?php

namespace App\Services;

use App\Models\Product;

class CartService
{
    protected string $sessionKey = 'cart';

    /** Raw cart as [productId => qty] */
    public function raw(): array
    {
        return session($this->sessionKey, []);
    }

    public function add(int $productId, int $qty = 1): void
    {
        $cart = $this->raw();
        $cart[$productId] = ($cart[$productId] ?? 0) + $qty;
        session([$this->sessionKey => $cart]);
    }

    public function update(int $productId, int $qty): void
    {
        $cart = $this->raw();

        if ($qty < 1) {
            unset($cart[$productId]);
        } else {
            $cart[$productId] = $qty;
        }

        session([$this->sessionKey => $cart]);
    }

    public function remove(int $productId): void
    {
        $cart = $this->raw();
        unset($cart[$productId]);
        session([$this->sessionKey => $cart]);
    }

    public function clear(): void
    {
        session([$this->sessionKey => []]);
    }

    public function count(): int
    {
        return array_sum($this->raw());
    }

    /**
     * Cart items with product objects + totals, ready for a view.
     */
    public function summary(): array
    {
        $items = [];

        foreach ($this->raw() as $productId => $qty) {
            $product = Product::find($productId);
            if (! $product) {
                continue;
            }

            $items[] = [
                'product' => $product,
                'qty' => $qty,
                'lineTotal' => round($product->price * $qty, 2),
            ];
        }

        $subtotal = round(array_sum(array_column($items, 'lineTotal')), 2);
        $tax = round($subtotal * 0.08, 2); // flat 8% demo tax
        $total = round($subtotal + $tax, 2);

        return compact('items', 'subtotal', 'tax', 'total');
    }
}
