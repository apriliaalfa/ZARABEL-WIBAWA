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

  <nav id="mainNav" aria-label="Main navigation">
    <div class="nav-drawer-header">
      <span class="nav-drawer-title">Menu</span>
      <button type="button" class="nav-drawer-close" id="navClose" aria-label="Close menu">✕</button>
    </div>
    <button onclick="location.href='{{ Auth::check() ? route('homepage2') : route('homepage1') }}'"
      @if(($active ?? '') === 'home') class="active" @endif>Home</button>
    <button onclick="location.href='{{ route('catalog') }}'"
      @if(($active ?? '') === 'catalog') class="active" @endif>Catalog</button>
    <button onclick="location.href='{{ route('catalog') }}'"
      @if(($active ?? '') === 'newarrival') class="active" @endif>New Arrival</button>
    <button onclick="location.href='{{ route('about') }}'"
      @if(($active ?? '') === 'about') class="active" @endif>About Us</button>
    @auth
      @if(Auth::user()->role === 'admin')
        <button onclick="location.href='{{ route('admin.dashboard') }}'"
          @if(($active ?? '') === 'admin') class="active" @endif>Admin</button>
      @endif
    @endauth

    <div class="nav-drawer-auth">
      @auth
        @if(Auth::user()->role === 'admin')
          <a class="drawer-link-btn" href="{{ route('admin.dashboard') }}">Admin Panel</a>
        @else
          <a class="drawer-link-btn" href="{{ route('profile') }}">My Profile</a>
          <a class="drawer-link-sub" href="{{ route('cart') }}">Shopping Bag</a>
        @endif
      @else
        <a class="drawer-link-signin" href="{{ route('login') }}">Sign In</a>
      @endauth
    </div>
  </nav>

  <div class="header-actions">
    <a href="{{ route('catalog') }}" class="nav-shop-link">Shop</a>
    <button class="icon-btn search-btn" aria-label="Search" onclick="location.href='{{ route('catalog') }}'"><svg class="ic"><use href="#i-search"/></svg></button>

    @auth
      @if(Auth::user()->role === 'admin')
        <button class="icon-btn" aria-label="Admin Dashboard" onclick="location.href='{{ route('admin.dashboard') }}'">
          <svg class="ic"><use href="#i-user"/></svg>
        </button>
      @else
        <button class="icon-btn" aria-label="Account" onclick="location.href='{{ route('profile') }}'">
          <svg class="ic"><use href="#i-user"/></svg>
        </button>
        <button class="icon-btn cart-button" aria-label="Cart" onclick="location.href='{{ route('cart') }}'">
          <svg class="ic"><use href="#i-cart"/></svg>
          <span id="cartCount">0</span>
        </button>
      @endif
    @else
      <a class="sign-in" href="{{ route('login') }}">Sign In</a>
      <button class="icon-btn cart-button" aria-label="Cart" onclick="location.href='{{ route('cart') }}'">
        <svg class="ic"><use href="#i-cart"/></svg>
        <span id="cartCount">0</span>
      </button>
    @endauth

    <button class="menu-toggle" id="menuToggle" aria-label="Toggle navigation" aria-expanded="false">
      <span></span><span></span><span></span>
    </button>
  </div>
</header>

<script>
  (function(){
    function initHeaderDrawer() {
      var nav = document.getElementById('mainNav');
      var toggle = document.getElementById('menuToggle');
      var closeBtn = document.getElementById('navClose');
      if (!nav || !toggle || toggle.dataset.drawerBound) return;
      toggle.dataset.drawerBound = 'true';

      function openNav() {
        nav.classList.add('open');
        toggle.setAttribute('aria-expanded', 'true');
        document.body.classList.add('drawer-open');
      }
      function closeNav() {
        nav.classList.remove('open');
        toggle.setAttribute('aria-expanded', 'false');
        document.body.classList.remove('drawer-open');
      }

      toggle.addEventListener('click', function(e){
        e.stopPropagation();
        if (nav.classList.contains('open')) {
          closeNav();
        } else {
          openNav();
        }
      });

      if (closeBtn) {
        closeBtn.addEventListener('click', function(e){
          e.stopPropagation();
          closeNav();
        });
      }

      document.addEventListener('click', function(e){
        if (nav.classList.contains('open') && !nav.contains(e.target) && !toggle.contains(e.target)) {
          closeNav();
        }
      });

      document.addEventListener('keydown', function(e){
        if (e.key === 'Escape' && nav.classList.contains('open')) {
          closeNav();
        }
      });
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initHeaderDrawer);
    } else {
      initHeaderDrawer();
    }
  })();
</script>
