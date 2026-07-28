<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(protected CartService $cart)
    {
    }

    public function index()
    {
        return view('cart.index', [
            'cart' => $this->cart->summary(),
            'cartCount' => $this->cart->count(),
        ]);
    }

    public function add(Request $request, string $id)
    {
        $product = Product::find($id);
        abort_if(! $product, 404);

        $qty = max(1, (int) $request->input('qty', 1));
        $this->cart->add((int) $id, $qty);

        return redirect()->route('cart.index');
    }

    public function update(Request $request, string $id)
    {
        $this->cart->update((int) $id, (int) $request->input('qty', 1));

        return redirect()->route('cart.index');
    }

    public function remove(string $id)
    {
        $this->cart->remove((int) $id);

        return redirect()->route('cart.index');
    }
}
