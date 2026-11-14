{{--
  PARTIAL: partials/header-user.blade.php
  Header ikon-only untuk semua halaman selain homepage1.
  Cara pakai: @include('partials.header-user', ['active' => 'home'])
  Nilai 'active': 'home' | 'catalog' | 'newarrival' | 'about'
--}}
<header class="site-header logged {{ $headerClass ?? 'catalog-header' }}">
  <a class="brand" href="{{ Auth::check() ? route('homepage2') : route('homepage1') }}" aria-label="Zarabel home">
    <img src="{{ asset('assets/img/zarabelbg.png') }}" alt="">
    <span>arabel</span>
  </a>

  <button class="menu-toggle" id="menuToggle" aria-label="Toggle navigation" aria-expanded="false">
    <span></span><span></span>
  </button>

  <nav id="mainNav" aria-label="Main navigation">
    <button onclick="location.href='{{ Auth::check() ? route('homepage2') : route('homepage1') }}'"
      @if(($active ?? '') === 'home') class="active" @endif>Home</button>
    <button onclick="location.href='{{ route('catalog') }}'"
      @if(($active ?? '') === 'catalog') class="active" @endif>Catalog</button>
    <button onclick="location.href='{{ route('catalog') }}'"
      @if(($active ?? '') === 'newarrival') class="active" @endif>New Arrival</button>
    <button onclick="location.href='{{ route('about') }}'"
      @if(($active ?? '') === 'about') class="active" @endif>About Us</button>
  </nav>

  <div class="header-actions">
    <button aria-label="Search"><svg class="ic"><use href="#i-search"/></svg></button>

    @auth
      @if(Auth::user()->role === 'admin')
        <button aria-label="Admin Dashboard" onclick="location.href='{{ route('admin.dashboard') }}'">
          <svg class="ic"><use href="#i-user"/></svg>
        </button>
      @else
        <button aria-label="Account" onclick="location.href='{{ route('profile') }}'">
          <svg class="ic"><use href="#i-user"/></svg>
        </button>
        <button class="cart-button" aria-label="Cart" onclick="location.href='{{ route('cart') }}'">
          <svg class="ic"><use href="#i-cart"/></svg>
          <span id="cartCount">0</span>
        </button>
      @endif
    @else
      <button aria-label="Sign In" onclick="location.href='{{ route('login') }}'">
        <svg class="ic"><use href="#i-user"/></svg>
      </button>
      <button class="cart-button" aria-label="Cart" onclick="location.href='{{ route('cart') }}'">
        <svg class="ic"><use href="#i-cart"/></svg>
        <span id="cartCount">0</span>
      </button>
    @endauth
  </div>
</header>
