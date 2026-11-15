<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Zarabel — Catalog</title>

<link rel="icon" type="image/png" href="{{ asset('images/zarabelbg.png') }}">
<link rel="apple-touch-icon" href="{{ asset('images/zarabelbg.png') }}">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Montserrat:wght@400;700&family=Playfair+Display:wght@400;500&family=Poppins:wght@400;500;600;700&family=Volkhov&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<link rel="stylesheet" href="{{ asset('css/catalog.css') }}">
</head>
<body>

<!-- ===== SPRITE SVG ===== -->
@include('partials.svg-icons')

<main>

  <!-- ================= HEADER ================= -->
  <header class="site-header logged catalog-header">
    <a class="brand" href="{{ Auth::check() ? route('homepage2') : route('homepage1') }}" aria-label="Zarabel home">
      <img src="{{ asset('assets/img/zarabelbg.png') }}" alt="">
      <span>arabel</span>
    </a>

    <button class="menu-toggle" id="menuToggle" aria-label="Toggle navigation" aria-expanded="false">
      <span></span><span></span>
    </button>

    <nav id="mainNav" aria-label="Main navigation">
      <button onclick="location.href='{{ Auth::check() ? route('homepage2') : route('homepage1') }}'">Home</button>
      <div class="catalog-control">
        <button class="active" id="catalogBtn" aria-expanded="false">
          Catalog <svg class="ic"><use href="#i-chev"/></svg>
        </button>
        <div class="catalog-menu" id="catalogMenu">
          <button onclick="location.href='{{ route('catalog') }}?cat=Pleats'">Pleats</button>
          <button onclick="location.href='{{ route('catalog') }}?cat=Pashmina'">Pashmina</button>
          <button onclick="location.href='{{ route('catalog') }}?cat=Shirt'">Shirt</button>
          <button onclick="location.href='{{ route('catalog') }}?cat=Outer'">Outer</button>
          <button onclick="location.href='{{ route('catalog') }}?cat=Dress'">Dress</button>
        </div>
      </div>
      <button onclick="location.href='{{ route('catalog') }}'">New Arrival</button>
      <button onclick="location.href='{{ route('about') }}'">About Us</button>
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

  <!-- ================= ISI CATALOG ================= -->
  <section class="catalog-main">
    <h1>All Products</h1>

    <div class="catalog-layout">

      <!-- FILTER -->
      <aside class="filters" aria-label="Product filters">
        <button class="filter-heading" id="catBtn" aria-expanded="true">
          <span>Category</span><svg class="ic"><use href="#i-chev"/></svg>
        </button>
        <div class="filter-options" id="catOptions">
          <label><input type="checkbox" data-cat="Pleats"><span class="checkmark"></span><span>Pleats</span><small>1</small></label>
          <label><input type="checkbox" data-cat="Pashmina"><span class="checkmark"></span><span>Pashmina</span><small>0</small></label>
          <label><input type="checkbox" data-cat="Shirt"><span class="checkmark"></span><span>Shirt</span><small>0</small></label>
          <label><input type="checkbox" data-cat="Outer"><span class="checkmark"></span><span>Outer</span><small>0</small></label>
          <label><input type="checkbox" data-cat="Dress"><span class="checkmark"></span><span>Dress</span><small>0</small></label>
        </div>

        <button class="price-heading" id="priceBtn" aria-expanded="false">
          <span>Price</span><svg class="ic"><use href="#i-chev"/></svg>
        </button>
        <div class="filter-options" id="priceOptions" hidden>
          <label><input type="checkbox" data-min="0" data-max="100000"><span class="checkmark"></span><span>&lt; IDR 100.000</span><small>15</small></label>
          <label><input type="checkbox" data-min="100000" data-max="300000"><span class="checkmark"></span><span>IDR 100.000 - 300.000</span><small>37</small></label>
          <label><input type="checkbox" data-min="300000" data-max="500000"><span class="checkmark"></span><span>IDR 300.000 - 500.000</span><small>99+</small></label>
          <label><input type="checkbox" data-min="500000" data-max="5000000"><span class="checkmark"></span><span>&gt; IDR 500.000</span><small>24</small></label>
        </div>
      </aside>

      <!-- PRODUK (Diambil langsung dari database) -->
      <div class="products-area">
        <div class="catalog-grid" id="grid">
          @forelse($products as $prod)
            @php
              $rawImg = $prod->main_image ?? '';
              if (Str::startsWith($rawImg, ['http://', 'https://'])) {
                  $imgUrl = $rawImg;
              } elseif (!empty($rawImg) && file_exists(public_path($rawImg))) {
                  $imgUrl = asset($rawImg);
              } elseif (!empty($rawImg) && file_exists(public_path('uploads/products/' . basename($rawImg)))) {
                  $imgUrl = asset('uploads/products/' . basename($rawImg));
              } elseif (!empty($rawImg) && file_exists(public_path('assets/img/' . basename($rawImg)))) {
                  $imgUrl = asset('assets/img/' . basename($rawImg));
              } else {
                  $catMap = ['pleats' => 'cat1.jpg', 'pashmina' => 'cat2.jpg', 'shirt' => 'cat3.jpg', 'outer' => 'cat4.jpg', 'dress' => 'cat5.jpg'];
                  $defaultCat = $catMap[strtolower($prod->category_name ?? '')] ?? 'cat1.jpg';
                  $imgUrl = asset('assets/img/' . $defaultCat);
              }
              $discountPrice = $prod->discount_price ? 'IDR ' . number_format($prod->discount_price, 0, ',', '.') : 'IDR ' . number_format($prod->price * 1.25, 0, ',', '.');
            @endphp
            <article class="product-card" data-price="{{ (int)$prod->price }}" data-category="{{ $prod->category_name }}">
              <button class="product-image add-cart" aria-label="Add {{ $prod->name }} to cart" onclick="location.href='{{ route('product', $prod->code) }}'">
                <img src="{{ $imgUrl }}" alt="{{ $prod->name }}" style="object-fit:cover;" onerror="this.onerror=null;this.src='{{ asset('assets/img/cat1.jpg') }}'">
                <span class="rating"><svg class="ic"><use href="#i-star"/></svg> {{ number_format($prod->rating ?? 4.95, 2) }}</span>
                <span class="quick-add">View Product</span>
              </button>
              <p class="product-category">{{ $prod->category_name }}</p>
              <h3 onclick="location.href='{{ route('product', $prod->code) }}'" style="cursor:pointer;">{{ $prod->name }}</h3>
              <p class="price">IDR {{ number_format($prod->price, 0, ',', '.') }} <span>{{ $discountPrice }}</span></p>
            </article>
          @empty
            <div style="grid-column: 1/-1; text-align:center; padding: 40px; color:#69481B;">
              Belum ada produk untuk kategori ini.
            </div>
          @endforelse
        </div>

        <div class="empty-state" id="empty">
          <h3>No products found</h3>
          <p>Try changing your filters.</p>
        </div>

        <nav class="pagination" aria-label="Product pages">
          <button class="arrow" id="pgPrev" aria-label="Previous page"><svg class="ic"><use href="#i-left"/></svg></button>
          <button class="pg current">1</button>
          <button class="pg">2</button>
          <button class="pg">3</button>
          <button class="pg">4</button>
          <button class="pg">5</button>
          <span>...</span>
          <button class="pg">10</button>
          <button class="arrow" id="pgNext" aria-label="Next page"><svg class="ic"><use href="#i-right"/></svg></button>
        </nav>
      </div>
    </div>
  </section>

  <!-- ================= FOOTER ================= -->
  @include('partials.footer')

</main>

<div class="toast" id="toast" role="status"></div>

<script>
  // Smooth scroll
  document.querySelectorAll('[data-scroll]').forEach(function(btn){
    btn.addEventListener('click', function(){
      var el = document.getElementById(btn.dataset.scroll);
      if (el) el.scrollIntoView({ behavior:'smooth' });
      var mNav = document.getElementById('mainNav');
      if (mNav) mNav.classList.remove('open');
    });
  });

  // Mobile menu toggle + dropdown Catalog
  var nav = document.getElementById('mainNav');
  var toggle = document.getElementById('menuToggle');
  if (toggle && nav) {
    toggle.addEventListener('click', function(){
      toggle.setAttribute('aria-expanded', nav.classList.toggle('open'));
    });
  }

  var catalogMenu = document.getElementById('catalogMenu');
  var catalogBtn = document.getElementById('catalogBtn');
  if (catalogBtn && catalogMenu) {
    catalogBtn.addEventListener('click', function(){
      catalogBtn.setAttribute('aria-expanded', catalogMenu.classList.toggle('open'));
    });
  }

  // Accordion filter Category & Price
  function accordion(btnId, boxId){
    var b = document.getElementById(btnId), box = document.getElementById(boxId);
    if (!b || !box) return;
    b.addEventListener('click', function(){
      var open = b.getAttribute('aria-expanded') === 'true';
      b.setAttribute('aria-expanded', !open);
      box.hidden = open;
    });
  }
  accordion('catBtn', 'catOptions');
  accordion('priceBtn', 'priceOptions');

  // Filter kategori & harga gabungan
  var cards = Array.prototype.slice.call(document.querySelectorAll('.catalog-grid .product-card'));
  var empty = document.getElementById('empty');
  var priceChecks = Array.prototype.slice.call(document.querySelectorAll('#priceOptions input'));
  var catChecks = Array.prototype.slice.call(document.querySelectorAll('#catOptions input'));

  function applyFilters(){
    var activePrices = priceChecks.filter(function(c){ return c.checked; });
    var activeCats = catChecks.filter(function(c){ return c.checked; }).map(function(c){ return c.dataset.cat.toLowerCase(); });

    var shown = 0;
    cards.forEach(function(card){
      var p = Number(card.dataset.price);
      var c = (card.dataset.category || '').toLowerCase();

      var matchPrice = activePrices.length === 0 || activePrices.some(function(chk){
        return p >= Number(chk.dataset.min) && p <= Number(chk.dataset.max);
      });

      var matchCat = activeCats.length === 0 || activeCats.includes(c);

      var ok = matchPrice && matchCat;
      card.classList.toggle('hide', !ok);
      if (ok) shown++;
    });
    if (empty) empty.classList.toggle('show', shown === 0);
  }

  priceChecks.forEach(function(c){ c.addEventListener('change', applyFilters); });
  catChecks.forEach(function(c){ c.addEventListener('change', applyFilters); });

  // Auto-check filter dari URL query param (?cat=Pleats)
  (function(){
    var urlParams = new URLSearchParams(window.location.search);
    var catParam = urlParams.get('cat');
    if (catParam) {
      catChecks.forEach(function(chk){
        if (chk.dataset.cat.toLowerCase() === catParam.toLowerCase()) {
          chk.checked = true;
        }
      });
      applyFilters();
    }
  })();

  // Add to cart + toast
  var cartCount = 0;
  var badge = document.getElementById('cartCount');
  var toast = document.getElementById('toast');
  var toastTimer;
  document.querySelectorAll('.add-cart').forEach(function(btn){
    btn.addEventListener('click', function(){
      cartCount++;
      if (badge) {
        badge.textContent = cartCount;
        badge.classList.add('show');
      }
      if (toast) {
        toast.textContent = btn.getAttribute('aria-label').replace('Add ', '').replace(' to cart', '') + ' added to cart';
        toast.classList.add('show');
        clearTimeout(toastTimer);
        toastTimer = setTimeout(function(){ toast.classList.remove('show'); }, 2200);
      }
    });
  });

  // Pagination
  var pages = Array.prototype.slice.call(document.querySelectorAll('.pg'));
  var prev = document.getElementById('pgPrev');
  var next = document.getElementById('pgNext');
  var cur = 0;
  function renderPages(){
    pages.forEach(function(p, i){ p.classList.toggle('current', i === cur); });
    if (prev) prev.disabled = cur === 0;
    if (next) next.disabled = cur === pages.length - 1;
  }
  pages.forEach(function(p, i){ p.addEventListener('click', function(){ cur = i; renderPages(); }); });
  if (prev) prev.addEventListener('click', function(){ if (cur > 0) { cur--; renderPages(); } });
  if (next) next.addEventListener('click', function(){ if (cur < pages.length - 1) { cur++; renderPages(); } });
  renderPages();
</script>

</body>
</html>

