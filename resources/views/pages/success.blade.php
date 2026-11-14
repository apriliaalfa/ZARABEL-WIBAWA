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
        <p class="success-msg">Thank you <span id="custName">Joe</span> for buying Candleaf. The nature is grateful to you. Now that your order is confirmed it will be ready to ship in 2 days. Please check your inbox in the future for your order updates.</p>
        <a class="btn-home" href="{{ route('homepage2') }}">Back to ZARABEL Home</a>
        <button class="link-print" type="button" onclick="window.print()">Print Receipt</button>
      </div>

      <!-- KANAN: ORDER SUMMARY -->
      <aside class="receipt">
        <h2>Order Summary</h2>

        <div id="items">
          <article class="rc-item">
            <div class="co-img-wrap">
              <img class="photo" src="{{ asset('assets/img/cart.png') }}" alt="White casual t-shirt">
              <span class="qty-badge">1</span>
            </div>
            <div class="rc-copy">
              <h3>White casual t-shirt</h3>
              <p class="co-price">1&nbsp; X&nbsp; IDR 100.000</p>
              <p class="co-note">Please recheck the size before send to me :)</p>
            </div>
            <span class="paid-btn">PAID</span>
          </article>
          <hr class="sep rc-sep">
          <article class="rc-item">
            <div class="co-img-wrap">
              <img class="photo" src="{{ asset('assets/img/cart.png') }}" alt="White casual t-shirt">
              <span class="qty-badge">1</span>
            </div>
            <div class="rc-copy">
              <h3>White casual t-shirt</h3>
              <p class="co-price">1&nbsp; X&nbsp; IDR 100.000</p>
            </div>
            <span class="paid-btn">PAID</span>
          </article>
        </div>

        <hr class="sep rc-sep">

        <dl class="totals rc-totals">
          <div><dt>Subtotal</dt><dd id="subtotal">IDR 300.000</dd></div>
          <div id="voucherRow"><dt>Voucher (50KDISCOUNT)</dt><dd class="discount">IDR 50.000</dd></div>
          <div><dt>Shipping</dt><dd id="shippingVal">IDR -</dd></div>
          <div class="grand"><dt>Total</dt><dd id="grandTotal">IDR 250.000</dd></div>
        </dl>

        <section class="rc-info">
          <h3>Informasi Customer</h3>
          <dl>
            <div><dt>Nama Customer</dt><dd id="cName">Aprilia Alfa</dd></div>
            <div><dt>Alamat</dt><dd id="cAddress">Jl. Bandung, 45 Braga, Cihampelas No, 58, Kab, Bandung</dd></div>
            <div><dt>Tanggal Pembayaran</dt><dd id="cDate">Kamis, 12 Maret 2026 09.45 AM</dd></div>
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



