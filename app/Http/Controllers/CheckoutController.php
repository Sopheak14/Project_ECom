<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CheckoutController extends Controller
{
    public function __construct(protected CartService $cart)
    {
    }

    public function create()
    {
        $summary = $this->cart->summary();

        if (empty($summary['items'])) {
            return redirect()->route('cart.index');
        }

        return view('checkout.form', [
            'cart' => $summary,
            'cartCount' => $this->cart->count(),
        ]);
    }

    public function store(Request $request)
    {
        $summary = $this->cart->summary();

        if (empty($summary['items'])) {
            return redirect()->route('cart.index');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'payment' => 'nullable|string',
        ]);

        $orderId = 'ORD-'.now()->format('ymd').'-'.random_int(1000, 9999);

        $order = [
            'id' => $orderId,
            'date' => now()->format('M j, Y g:i A'),
            'customer' => [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'address' => $validated['address'],
                'city' => $validated['city'],
                'payment' => $validated['payment'] ?: 'Card on delivery',
            ],
            'items' => $summary['items'],
            'subtotal' => $summary['subtotal'],
            'tax' => $summary['tax'],
            'total' => $summary['total'],
        ];

        // Render the invoice view to a string and save it as a standalone .html file
        $html = view('checkout.invoice', ['order' => $order])->render();
        Storage::disk('public')->put("invoices/{$orderId}.html", $html);

        $this->cart->clear();

        return view('checkout.invoice', ['order' => $order]);
    }

    public function showInvoice(string $orderId)
    {
        $path = "invoices/{$orderId}.html";

        abort_unless(Storage::disk('public')->exists($path), 404);

        return response(Storage::disk('public')->get($path))
            ->header('Content-Type', 'text/html');
    }
}
