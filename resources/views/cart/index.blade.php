@extends('layouts.app')

@section('title', 'Your Cart — BASELINE.shop')

@section('content')

<h1>Your cart</h1>

@if(empty($cart['items']))
  <div class="empty-state">
    <p>Your cart is empty.</p>
    <a href="{{ route('home') }}" class="btn">Browse the catalog</a>
  </div>
@else
  <table class="cart-table">
    <thead>
      <tr>
        <th>Item</th>
        <th>Price</th>
        <th>Qty</th>
        <th>Line total</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach($cart['items'] as $item)
        <tr>
          <td>
            <a href="{{ route('product.show', $item['product']->id) }}" class="cart-item-name">{{ $item['product']->name }}</a>
            <div class="card-sku">{{ $item['product']->sku }}</div>
          </td>
          <td>${{ number_format($item['product']->price, 2) }}</td>
          <td>
            <form action="{{ route('cart.update', $item['product']->id) }}" method="POST" class="qty-form">
              @csrf
              <input type="number" name="qty" value="{{ $item['qty'] }}" min="1" max="{{ $item['product']->stock }}">
              <button type="submit" class="btn-link">Update</button>
            </form>
          </td>
          <td>${{ number_format($item['lineTotal'], 2) }}</td>
          <td>
            <form action="{{ route('cart.remove', $item['product']->id) }}" method="POST">
              @csrf
              <button type="submit" class="btn-link btn-danger">Remove</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

  <div class="cart-summary">
    <div class="summary-row"><span>Subtotal</span><span>${{ number_format($cart['subtotal'], 2) }}</span></div>
    <div class="summary-row"><span>Tax (8%)</span><span>${{ number_format($cart['tax'], 2) }}</span></div>
    <div class="summary-row summary-total"><span>Total</span><span>${{ number_format($cart['total'], 2) }}</span></div>
    <a href="{{ route('checkout.create') }}" class="btn btn-block">Proceed to checkout</a>
  </div>
@endif

@endsection
