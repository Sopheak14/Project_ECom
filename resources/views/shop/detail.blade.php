@extends('layouts.app')

@section('title', $product->name.' — BASELINE.shop')

@section('content')

<p class="breadcrumb"><a href="{{ route('home') }}">Catalog</a> / <span>{{ $product->name }}</span></p>

<section class="detail-layout">
  <div class="detail-icon">
    @if ($product->image)
      <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="detail-image">
    @else
      @include('partials.icon', ['category' => $product->category])
    @endif
  </div>

  <div class="detail-info">
    <p class="card-sku">{{ $product->sku }} &middot; {{ $product->category }}</p>
    <h1>{{ $product->name }}</h1>
    <p class="price price-large">${{ number_format($product->price, 2) }}</p>
    <p class="stock {{ $product->stock > 0 ? 'in-stock' : 'out-stock' }}">
      {{ $product->stock > 0 ? $product->stock.' in stock' : 'Out of stock' }}
    </p>

    <p class="detail-desc">{{ $product->description }}</p>

    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="add-form">
      @csrf
      <label for="qty">Qty</label>
      <input type="number" id="qty" name="qty" value="1" min="1" max="{{ $product->stock }}">
      <button type="submit" class="btn" @disabled($product->stock === 0)>Add to cart</button>
    </form>
  </div>
</section>

<section class="spec-sheet">
  <h2 class="spec-title">Spec sheet</h2>
  <table class="spec-table">
    <tbody>
      @foreach($product->specs as $label => $value)
        <tr>
          <th>{{ $label }}</th>
          <td>{{ $value }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</section>

@endsection
