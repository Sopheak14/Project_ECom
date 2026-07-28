<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\CartService;

class CatalogController extends Controller
{
    public function __construct(protected CartService $cart)
    {
    }

    public function index()
    {
        return view('shop.index', [
            'products' => Product::all(),
            'cartCount' => $this->cart->count(),
        ]);
    }

    public function show(string $id)
    {
        $product = Product::find($id);

        abort_if(! $product, 404);

        return view('shop.detail', [
            'product' => $product,
            'cartCount' => $this->cart->count(),
        ]);
    }
}
