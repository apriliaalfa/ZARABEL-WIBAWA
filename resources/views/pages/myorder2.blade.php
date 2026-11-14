<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Zarabel — Order Detail</title>

<link rel="icon" type="image/png" href="{{ asset('assets/img/zarabelbg.png') }}">
<link rel="apple-touch-icon" href="{{ asset('assets/img/zarabelbg.png') }}">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Abhaya+Libre:wght@400;700&family=Jost:wght@400&family=Lateef:wght@300&family=Lato:wght@400;500;700&family=Nunito+Sans:wght@600;700;800&family=Playfair+Display:wght@400;500&family=Poppins:wght@300;400;500;600;700&family=Volkhov&display=swap" rel="stylesheet">
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
      <div class="setting-tabs" aria-label="Settings sections">
        <a href="{{ route('profile') }}">Profile</a>
        <a href="#notification">Notification</a>
        <a href="{{ route('myorder') }}" class="selected">My Orders</a>
      </div>
    </div>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      @csrf
    </form>
    <button class="logout" type="button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
  </section>

  <!-- ================= DETAIL ORDER ================= -->
  <section class="detail-section">

    <!-- Kiri: info pembayaran (hanya baca) -->
    <div class="pay-info">
      <h2>Payment Information</h2>
      <form onsubmit="return false">
        <label class="pay-field"><span>Nama Customer</span><input type="text" id="dName" readonly></label>
        <label class="pay-field"><span>ID Transaction</span><input type="text" id="dTrx" readonly></label>
        <label class="pay-field"><span>Metode Pembayaran</span><input type="text" id="dMethod" readonly></label>
        <label class="pay-field"><span>Tanggal Pembayaran</span><input type="text" id="dDate" readonly></label>
        <label class="pay-field"><span>Address</span><textarea id="dAddress" readonly></textarea></label>
      </form>
      <a class="back-link" href="{{ route('myorder') }}">‹ Kembali ke My Orders</a>
    </div>

    <!-- Kanan: ringkasan order -->
    <aside class="summary-card" aria-labelledby="sum-title">
      <h2 id="sum-title">ORDER SUMMARY</h2>

      <div class="sum-body">
        <div id="sItems"></div>

        <dl class="sum-rows">
          <div><dt>Subtotal</dt><dd id="sSub"></dd></div>
          <div><dt>Voucher (<span id="sCode"></span>)</dt><dd class="discount" id="sVoucher"></dd></div>
          <div><dt>Shipping</dt><dd>IDR -</dd></div>
          <div class="total"><dt>Total</dt><dd id="sTotal"></dd></div>
        </dl>
      </div>

      <div class="sum-logo-wrap">
        <div class="brand footer-logo">
          <img src="{{ asset('assets/img/zarabelbg.png') }}" alt="">
          <span>arabel</span>
        </div>
      </div>
    </aside>
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

  // Data order (id dikirim lewat ?id=I0001 atau route param). Tiap order bisa berisi beberapa item.
  var ORDERS = {
    I0001:{ status:'Payment received', method:'Transfer Bank BCA', date:'12 Mei 2026',
            items:[ { name:'Sony Alpha A7 IV', qty:1, unit:450000 }, { name:'Lensa Sony 50mm f/1.8', qty:1, unit:150000 } ] },
    I0002:{ status:'Awaiting payment', method:'Virtual Account', date:'-',
            items:[ { name:'ALLTREK Tenda Camping 1', qty:2, unit:450000 }, { name:'Matras Camping', qty:2, unit:50000 } ] },
    I0003:{ status:'Dispatched', method:'QRIS', date:'14 Mei 2026',
            items:[ { name:'Mobil Fortuner Hitam', qty:1, unit:1000000 }, { name:'Sopir Harian', qty:1, unit:300000 } ] },
    I0004:{ status:'Completed', method:'Transfer Bank BNI', date:'02 Mei 2026',
            items:[ { name:'Yamaha Pro Audio Paket', qty:2, unit:750000 }, { name:'Microphone Wireless', qty:2, unit:100000 } ] },
    I0005:{ status:'Awaiting payment', method:'Virtual Account', date:'-',
            items:[ { name:'Iphone 17 Air (Hijau)', qty:1, unit:300000 }, { name:'Casing Iphone 17 Air', qty:1, unit:25000 } ] },
    I0006:{ status:'Completed', method:'GoPay', date:'28 Apr 2026',
            items:[ { name:'Kebaya Cream (1 Set)', qty:1, unit:630000 }, { name:'Selendang Batik', qty:1, unit:75000 } ] }
  };
  var STATUS_UI = {
    'Payment received':{ label:'PAID',       cls:'' },
    'Completed':       { label:'PAID',       cls:'' },
    'Dispatched':      { label:'DISPATCHED', cls:'is-ship' },
    'Awaiting payment':{ label:'UNPAID',     cls:'is-wait' },
    'Cancelled':       { label:'CANCELLED',  cls:'is-cancel' }
  };
  var VOUCHER = { code:'SDKDISCOUNT', amount:50000 };

  function idr(n){ return 'IDR ' + n.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.'); }
  function set(id, v){ document.getElementById(id).textContent = v; }
  function esc(t){ var d = document.createElement('div'); d.textContent = t; return d.innerHTML; }

  var routeId = "{{ $id ?? '' }}";
  var id = routeId || new URLSearchParams(location.search).get('id');
  if (!ORDERS[id]) id = 'I0001';
  var o = ORDERS[id];
  var ui = STATUS_UI[o.status] || STATUS_UI['Payment received'];

  var sub = 0;
  o.items.forEach(function(it){ sub += it.unit * it.qty; });
  var disc = o.status === 'Awaiting payment' ? 0 : VOUCHER.amount;

  // kiri
  document.getElementById('dName').value    = localStorage.getItem('customerName') || 'Aprilia Alfa Gusasti';
  document.getElementById('dTrx').value     = 'TRX-' + id.replace('I','') + '-2026';
  document.getElementById('dMethod').value  = o.method;
  document.getElementById('dDate').value    = o.date;
  document.getElementById('dAddress').value = localStorage.getItem('customerAddress') || 'Tangerang, Banten';

  // kanan: daftar item
  var cartImg = "{{ asset('assets/img/cart.png') }}";
  document.getElementById('sItems').innerHTML = o.items.map(function(it, i){
    return '<div class="sum-item">' +
      '<div class="sum-thumb"><img src="' + cartImg + '" alt=""><span class="qty-badge">' + it.qty + '</span></div>' +
      '<div class="sum-info"><strong>' + esc(it.name) + '</strong>' +
      '<small>' + it.qty + ' x ' + idr(it.unit) + '/hari</small>' +
      (i === 0 ? '<small class="note">Please recheck the size before send to me :)</small>' : '') +
      '</div>' +
      '<span class="status-pill ' + ui.cls + '">' + ui.label + '</span>' +
    '</div>';
  }).join('');

  set('sSub', idr(sub));
  set('sCode', VOUCHER.code);
  set('sVoucher', disc ? idr(disc) : 'IDR -');
  set('sTotal', idr(sub - disc));
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



