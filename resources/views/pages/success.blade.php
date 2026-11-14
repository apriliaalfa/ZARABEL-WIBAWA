<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Zarabel — Payment Success</title>

<link rel="icon" type="image/png" href="{{ asset('images/zarabelbg.png') }}">
<link rel="apple-touch-icon" href="{{ asset('images/zarabelbg.png') }}">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Abhaya+Libre:wght@500&family=Lato:wght@400;500;700&family=Playfair+Display:wght@400;500&family=Poppins:wght@300;400;500;600;700;800&family=Volkhov&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<link rel="stylesheet" href="{{ asset('css/catalog.css') }}">
<link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
</head>
<body>

@include('partials.svg-icons')

<main>

  <!-- ================= HEADER (sudah login) ================= -->
  @include('partials.header-user')

  <!-- ================= ISI SUCCESS ================= -->
  <section class="co-main success-main">
    <div class="success-layout">

      <!-- KIRI -->
      <div class="success-box">
        <div class="success-check" aria-hidden="true"><svg><use href="#i-check"/></svg></div>
        <h1 class="success-title">Payment Success!</h1>
        <p class="success-msg">Thank you <span id="custName">{{ $order->customer_name ?? 'Customer' }}</span> for purchasing from Zarabel Studio. The nature is grateful to you. Now that your order is confirmed it will be ready to ship in 2 days. Please check your inbox in the future for your order updates.</p>
        <a class="btn-home" href="{{ route('homepage2') }}">Back to ZARABEL Home</a>
        <button class="link-print" type="button" onclick="window.print()">Print Receipt</button>
      </div>

      <!-- KANAN: ORDER SUMMARY DARI DATABASE -->
      <aside class="receipt">
        <h2>Order Summary <small style="font-size:13px; color:#8B4513; font-weight:600;">({{ $order->order_number ?? '' }})</small></h2>

        <div id="items">
          @if(isset($order) && $order->items->count() > 0)
            @foreach($order->items as $idx => $it)
              @php
                $itemImg = $it->product_image ? asset($it->product_image) : asset('assets/img/cart.png');
              @endphp
              <article class="rc-item">
                <div class="co-img-wrap">
                  <img class="photo" src="{{ $itemImg }}" alt="{{ $it->product_name }}">
                  <span class="qty-badge">{{ $it->quantity }}</span>
                </div>
                <div class="rc-copy">
                  <h3>{{ $it->product_name }}</h3>
                  <p class="co-price">{{ $it->quantity }}&nbsp; X&nbsp; IDR {{ number_format($it->price, 0, ',', '.') }} {{ $it->size ? '(' . $it->size . ')' : '' }}</p>
                  @if($it->notes)
                    <p class="co-note">{{ $it->notes }}</p>
                  @endif
                </div>
                <span class="paid-btn">{{ strtoupper($order->status == 'paid' ? 'PAID' : $order->status) }}</span>
              </article>
              @if(!$loop->last)
                <hr class="sep rc-sep">
              @endif
            @endforeach
          @else
            <article class="rc-item">
              <div class="co-img-wrap">
                <img class="photo" src="{{ asset('assets/img/cart.png') }}" alt="Zarabel Item">
                <span class="qty-badge">1</span>
              </div>
              <div class="rc-copy">
                <h3>Zarabel Modest Item</h3>
                <p class="co-price">1&nbsp; X&nbsp; IDR 100.000</p>
              </div>
              <span class="paid-btn">PAID</span>
            </article>
          @endif
        </div>

        <hr class="sep rc-sep">

        @php
          $subtotalVal = $order ? $order->subtotal : 300000;
          $discountVal = $order ? $order->discount : 50000;
          $shippingVal = $order ? $order->shipping_cost : 0;
          $totalVal    = $order ? $order->total_amount : 250000;
        @endphp

        <dl class="totals rc-totals">
          <div><dt>Subtotal</dt><dd id="subtotal">IDR {{ number_format($subtotalVal, 0, ',', '.') }}</dd></div>
          @if($discountVal > 0)
            <div id="voucherRow"><dt>Voucher Discount</dt><dd class="discount">IDR {{ number_format($discountVal, 0, ',', '.') }}</dd></div>
          @endif
          <div><dt>Shipping ({{ $order->courier ?? 'Courier' }})</dt><dd id="shippingVal">{{ $shippingVal > 0 ? 'IDR ' . number_format($shippingVal, 0, ',', '.') : 'IDR -' }}</dd></div>
          <div class="grand"><dt>Total</dt><dd id="grandTotal">IDR {{ number_format($totalVal, 0, ',', '.') }}</dd></div>
        </dl>

        <section class="rc-info">
          <h3>Informasi Customer</h3>
          <dl>
            <div><dt>Nama Customer</dt><dd id="cName">{{ $order->customer_name ?? 'Aprilia Alfa' }}</dd></div>
            <div><dt>Alamat</dt><dd id="cAddress">{{ $order->shipping_address ?? 'Jl. Bandung, 45 Braga, Cihampelas' }}</dd></div>
            <div><dt>Tanggal Pembayaran</dt><dd id="cDate">{{ $order ? $order->created_at->translatedFormat('l, d F Y H.i A') : date('l, d F Y') }}</dd></div>
          </dl>
        </section>

        <a class="brand rc-logo" href="{{ route('homepage2') }}" aria-label="Zarabel home">
          <img src="{{ asset('images/zarabelbg.png') }}" alt=""><span>arabel</span>
        </a>
      </aside>

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

  // Data customer & tanggal (fallback ke contoh desain kalau localStorage kosong)
  (function(){
    var bulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
    var hari  = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
    var name = localStorage.getItem('customerName');
    var addr = localStorage.getItem('customerAddress');
    if (name){
      document.getElementById('cName').textContent = name;
      document.getElementById('custName').textContent = name.split(' ')[0];
    }
    if (addr) document.getElementById('cAddress').textContent = addr;

    var n = new Date(), h = n.getHours(), ap = h >= 12 ? 'PM' : 'AM';
    h = h % 12 || 12;
    document.getElementById('cDate').textContent =
      hari[n.getDay()] + ', ' + n.getDate() + ' ' + bulan[n.getMonth()] + ' ' + n.getFullYear() + ' ' +
      String(h).padStart(2,'0') + '.' + String(n.getMinutes()).padStart(2,'0') + ' ' + ap;
  })();
</script>

</body>
</html>



