<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Zarabel — My Orders</title>

<link rel="icon" type="image/png" href="{{ asset('assets/img/zarabelbg.png') }}">
<link rel="apple-touch-icon" href="{{ asset('assets/img/zarabelbg.png') }}">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Abhaya+Libre:wght@400;700&family=Lato:wght@400;500;700&family=Montserrat:wght@400;600;700&family=Playfair+Display:ital,wght@0,400;0,500;0,600;1,400&family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700&family=Tenor+Sans&family=Volkhov:ital,wght@0,400;1,400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<link rel="stylesheet" href="{{ asset('css/catalog.css') }}">
<link rel="stylesheet" href="{{ asset('css/myorder.css') }}">
</head>
<body>

@include('partials.svg-icons')

<main>

  <!-- ================= HEADER (sudah login) ================= -->
  @include('partials.header-user', ['headerClass' => 'co-header'])

  <!-- ================= SETTINGS HERO ================= -->
  <section class="settings-hero" aria-labelledby="settings-title">
    <div class="settings-copy">
      <h1 id="settings-title">Settings</h1>
      <div class="setting-tabs" role="tablist" aria-label="Settings sections">
        <a href="{{ route('profile') }}">Profile</a>
        <button type="button">Notification</button>
        <a href="{{ route('myorder') }}" class="selected">My Orders</a>
      </div>
    </div>
    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
      @csrf
      <button class="logout" type="submit">
        <span class="avatar">
          @auth
            @if(auth()->user()->avatar)
              <img id="myorderAvatar" src="{{ auth()->user()->avatar }}" alt="Avatar" style="width:100%; height:100%; object-fit:cover; border-radius:50%;">
            @else
              <img id="myorderAvatar" src="{{ asset('assets/img/zarabelbg.png') }}" alt="Avatar">
            @endif
          @else
            <img id="myorderAvatar" src="{{ asset('assets/img/zarabelbg.png') }}" alt="Avatar">
          @endauth
        </span>
        <span>Log Out</span>
        <svg class="ic"><use href="#i-logout"/></svg>
      </button>
    </form>
  </section>

  <!-- ================= MY ORDERS ================= -->
  <section class="orders-section" id="ordersSection">

    <!-- My Orders -->
    <div class="orders-panel" id="ordersPanel">
      <div class="status-filters" role="tablist" aria-label="Filter orders by status">
        <button type="button" role="tab" data-filter="All" aria-selected="true" class="selected"><span class="filter-icon"><svg class="ic"><use href="#i-f-user"/></svg></span><span>All</span></button>
        <button type="button" role="tab" data-filter="Awaiting payment" aria-selected="false"><span class="filter-icon"><svg class="ic"><use href="#i-f-clock"/></svg></span><span>Awaiting payment</span></button>
        <button type="button" role="tab" data-filter="Payment received" aria-selected="false"><span class="filter-icon"><svg class="ic"><use href="#i-f-card"/></svg></span><span>Payment received</span></button>
        <button type="button" role="tab" data-filter="Dispatched" aria-selected="false"><span class="filter-icon"><svg class="ic"><use href="#i-f-truck"/></svg></span><span>Dispatched</span></button>
        <button type="button" role="tab" data-filter="Completed" aria-selected="false"><span class="filter-icon"><svg class="ic"><use href="#i-f-check"/></svg></span><span>Completed</span></button>
        <button type="button" role="tab" data-filter="Cancelled" aria-selected="false"><span class="filter-icon"><svg class="ic"><use href="#i-f-archive"/></svg></span><span>Cancelled</span></button>
      </div>

      <div class="table-shell">
        <div class="order-grid table-head" aria-hidden="true">
          <span>OrderID</span><span>Name</span><span>Category</span><span>Quantity</span><span>Price</span><span>Receipt</span>
        </div>
        <div class="order-list" id="orderList">
          @forelse($orders as $order)
          @php
            $firstItem2 = $order->items->first();
            $imgUrl3 = $firstItem2?->product_image ? asset($firstItem2->product_image) : asset('assets/img/Kirana1.jpg');
            $categoryName = $firstItem2?->product?->category_name ?? $firstItem2?->product?->category?->name ?? 'Modest';
            $statusFilter = match($order->status) {
              'pending' => 'Awaiting payment',
              'paid' => 'Payment received',
              'shipped','dispatched' => 'Dispatched',
              'delivered','completed' => 'Completed',
              'cancelled' => 'Cancelled',
              default => ucfirst($order->status),
            };
          @endphp
          <article class="order-grid order-row" data-status="{{ $statusFilter }}" data-name="{{ $firstItem2?->product_name }}" data-id="{{ $order->order_number }}" data-qty="{{ $order->items->sum('quantity') }}" data-price="IDR {{ number_format($order->total_amount, 0, ',', '.') }}">
            <span class="order-id" data-label="OrderID" style="word-break: break-all; font-size:11px;">{{ $order->order_number }}</span>
            <div class="product" data-label="Name">
              <span class="product-image"><img src="{{ $imgUrl3 }}" alt=""></span>
              <span><strong>{{ $firstItem2?->product_name ?? '—' }}</strong>@if($order->items->count() > 1)<small>+{{ $order->items->count()-1 }} item lain</small>@endif</span>
            </div>
            <span data-label="Category">{{ $categoryName }}</span>
            <span data-label="Quantity">{{ $order->items->sum('quantity') }}</span>
            <span data-label="Price">IDR {{ number_format($order->total_amount, 0, ',', '.') }}</span>
            <span data-label="Receipt"><a href="{{ route('myorder.detail', ['id' => $order->order_number]) }}" class="details-button">View Details</a></span>
          </article>
          @empty
          <div class="order-row" style="grid-column:1/-1; text-align:center; padding:40px; color:#888;">
            <p>Belum ada pesanan. <a href="{{ route('catalog') }}" style="color:#7a5c2e;">Mulai belanja</a></p>
          </div>
          @endforelse
          <div class="no-orders" id="noOrders" hidden>No orders currently match this status.</div>
        </div>
      </div>

      <nav class="pagination" id="pagination" aria-label="Order pages">
        <button type="button" class="selected" aria-current="page">1</button>
        <button type="button">2</button>
        <button type="button">3</button>
        <button type="button" aria-label="Next page" id="nextPage">»</button>
      </nav>
    </div>
  </section>

  <!-- ================= FOOTER ================= -->
  @include('partials.footer')

</main>

<script>
  // Menu HP + scroll halus
  document.querySelectorAll('[data-scroll]').forEach(function(btn){
    btn.addEventListener('click', function(){
      var el = document.getElementById(btn.dataset.scroll);
      if (el) el.scrollIntoView({ behavior:'smooth' });
    });
  });
  var nav = document.getElementById('mainNav');
  var toggle = document.getElementById('menuToggle');
  toggle.addEventListener('click', function(){
    toggle.setAttribute('aria-expanded', nav.classList.toggle('open'));
  });

  // Filter status
  var rows = document.querySelectorAll('.order-row');
  var filterBtns = document.querySelectorAll('.status-filters button');
  filterBtns.forEach(function(b){
    b.addEventListener('click', function(){
      var f = b.dataset.filter, shown = 0;
      filterBtns.forEach(function(x){
        x.classList.toggle('selected', x === b);
        x.setAttribute('aria-selected', x === b);
      });
      rows.forEach(function(r){
        var rStatus = (r.dataset.status || '').trim().toLowerCase();
        var filterVal = f.trim().toLowerCase();
        var ok = (filterVal === 'all') || (rStatus === filterVal);
        r.hidden = !ok;
        if (ok) shown++;
      });
      document.getElementById('noOrders').hidden = shown > 0;
      setPage(1);
    });
  });

  // Pagination (tampilan saja)
  var pages = document.querySelectorAll('#pagination button:not(#nextPage)');
  var current = 1;
  function setPage(n){
    current = n;
    pages.forEach(function(p, i){
      p.classList.toggle('selected', i + 1 === n);
      if (i + 1 === n) p.setAttribute('aria-current','page'); else p.removeAttribute('aria-current');
    });
  }
  pages.forEach(function(p, i){ p.addEventListener('click', function(){ setPage(i + 1); }); });
  document.getElementById('nextPage').addEventListener('click', function(){ setPage(Math.min(pages.length, current + 1)); });
  // Sync avatar dari profile jika user baru saja upload foto
  try {
    var prof = JSON.parse(localStorage.getItem('profile') || '{}');
    if (prof.avatar) {
      var avEl = document.getElementById('myorderAvatar');
      if (avEl) avEl.src = prof.avatar;
    }
  } catch(e) {}
</script>

</body>
</html>



