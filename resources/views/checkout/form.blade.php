@extends('layouts.app')

@section('title', 'Checkout — BASELINE.shop')

@section('content')

<h1>Checkout</h1>

<div class="checkout-layout">
  <form action="{{ route('checkout.store') }}" method="POST" class="checkout-form">
    @csrf

    @if($errors->any())
      <p class="form-error">Please fix the fields below before placing the order.</p>
    @endif

    <label for="name">Full name</label>
    <input type="text" id="name" name="name" value="{{ old('name') }}" required>

    <label for="email">Email</label>
    <input type="email" id="email" name="email" value="{{ old('email') }}" required>

    <label for="address">Address</label>
    <input type="text" id="address" name="address" value="{{ old('address') }}" required>

    <label for="city">City</label>
    <input type="text" id="city" name="city" value="{{ old('city') }}" required>

    <label for="payment">Payment method</label>
    <select id="payment" name="payment">
      <option>Card on delivery</option>
      <option>Bank transfer</option>
      <option>Cash on delivery</option>
    </select>

    <button type="submit" class="btn btn-block">Place order</button>
  </form>

  <aside class="order-summary">
    <h2 class="spec-title">Order summary</h2>
    <ul class="summary-items">
      @foreach($cart['items'] as $item)
        <li>
          <span>{{ $item['qty'] }} &times; {{ $item['product']->name }}</span>
          <span>${{ number_format($item['lineTotal'], 2) }}</span>
        </li>
      @endforeach
    </ul>
    <div class="summary-row"><span>Subtotal</span><span>${{ number_format($cart['subtotal'], 2) }}</span></div>
    <div class="summary-row"><span>Tax (8%)</span><span>${{ number_format($cart['tax'], 2) }}</span></div>
    <div class="summary-row summary-total"><span>Total</span><span>${{ number_format($cart['total'], 2) }}</span></div>
  </aside>
</div>

@endsection
