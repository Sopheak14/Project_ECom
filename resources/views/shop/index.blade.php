@extends('layouts.app')

@section('title', 'Catalog — BASELINE.shop')

@section('content')

<section class="hero">
  <h1>Parts and machines,<br>priced and speced plainly.</h1>
  <p class="hero-sub">Ten components, rendered fresh from the server on every request. Pick a part, add it to the cart, and check out below.</p>
</section>

<section class="catalog-grid">
  @foreach($products as $product)
    <article class="card">
      <a href="{{ route('product.show', $product->id) }}" class="card-icon-link">
        <div class="card-icon">
          @if ($product->image)
            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="card-image">
          @else
            @include('partials.icon', ['category' => $product->category])
          @endif
        </div>
      </a>
      <div class="card-body">
        <p class="card-sku">{{ $product->sku }}</p>
        <h2 class="card-name"><a href="{{ route('product.show', $product->id) }}">{{ $product->name }}</a></h2>
        <p class="card-spec">{{ $product->specShort }}</p>
      </div>
      <div class="card-footer">
        <span class="price">${{ number_format($product->price, 2) }}</span>
        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="inline-form">
          @csrf
          <input type="hidden" name="qty" value="1">
          <button type="submit" class="btn btn-small">Add to cart</button>
        </form>
      </div>
    </article>
  @endforeach
</section>

@endsection
