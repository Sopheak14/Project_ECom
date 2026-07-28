<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Baseline — Computer Shop')</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;700&family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
  <header class="site-header">
    <div class="wrap header-row">
      <a href="{{ route('home') }}" class="brand">
        <span class="brand-mark"></span> BASELINE<span class="brand-dim">.shop</span>
      </a>
      <nav class="main-nav">
        <a href="{{ route('home') }}">Catalog</a>
        <a href="{{ route('cart.index') }}" class="cart-link">
          Cart
          @if(($cartCount ?? 0) > 0)
            <span class="cart-badge">{{ $cartCount }}</span>
          @endif
        </a>
      </nav>
    </div>
  </header>

  <main class="wrap page">
    @yield('content')
  </main>

  <footer class="site-footer">
    <div class="wrap footer-row">
      <span>BASELINE.shop — server-rendered demo storefront</span>
      <span class="footer-dim">Every page is rendered on the server with Laravel Blade. No client-side framework.</span>
    </div>
  </footer>
</body>
</html>
