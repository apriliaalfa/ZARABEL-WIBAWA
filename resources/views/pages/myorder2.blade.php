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

  // Data order dari Database Laravel
  @if(isset($order) && $order)
    var dbOrder = {
      order_number: "{{ $order->order_number }}",
      customer_name: "{{ $order->customer_name }}",
      customer_address: "{{ addslashes($order->shipping_address) }}",
      method: "{{ $order->payment?->payment_method ? ucwords(str_replace('_', ' ', $order->payment->payment_method)) : 'QRIS' }}",
      date: "{{ $order->created_at->format('d M Y H:i') }}",
      status: "{{ $order->status }}",
      subtotal: {{ (float)$order->subtotal }},
      discount: {{ (float)$order->discount }},
      shipping: {{ (float)$order->shipping_cost }},
      total: {{ (float)$order->total_amount }},
      items: [
        @foreach($order->items as $it)
        {
          name: "{{ addslashes($it->product_name) }}",
          qty: {{ $it->quantity }},
          unit: {{ (float)$it->price }},
          size: "{{ $it->size ?? 'All Size' }}",
          notes: "{{ addslashes($it->notes ?? '') }}",
          img: "{{ $it->product_image ? asset($it->product_image) : asset('assets/img/cart.png') }}"
        },
        @endforeach
      ]
    };

    function idr(n){ return 'IDR ' + Number(n || 0).toLocaleString('id-ID'); }
    function set(id, v){ if(document.getElementById(id)) document.getElementById(id).textContent = v; }
    function esc(t){ var d = document.createElement('div'); d.textContent = t; return d.innerHTML; }

    var statusText = dbOrder.status.toLowerCase();
    var isPaid = (statusText === 'paid' || statusText === 'completed');
    var statusLabel = isPaid ? 'PAID' : (statusText === 'shipped' ? 'DISPATCHED' : 'AWAITING PAYMENT');
    var statusCls = isPaid ? '' : (statusText === 'shipped' ? 'is-ship' : 'is-wait');

    // Kiri
    document.getElementById('dName').value    = dbOrder.customer_name;
    document.getElementById('dTrx').value     = dbOrder.order_number;
    document.getElementById('dMethod').value  = dbOrder.method;
    document.getElementById('dDate').value    = dbOrder.date;
    document.getElementById('dAddress').value = dbOrder.customer_address;

    // Kanan
    document.getElementById('sItems').innerHTML = dbOrder.items.map(function(it){
      return '<div class="sum-item">' +
        '<div class="sum-thumb"><img src="' + it.img + '" alt=""><span class="qty-badge">' + it.qty + '</span></div>' +
        '<div class="sum-info"><strong>' + esc(it.name) + '</strong>' +
        '<small>' + it.qty + ' x ' + idr(it.unit) + (it.size ? ' (' + it.size + ')' : '') + '</small>' +
        (it.notes ? '<small class="note">' + esc(it.notes) + '</small>' : '') +
        '</div>' +
        '<span class="status-pill ' + statusCls + '">' + statusLabel + '</span>' +
      '</div>';
    }).join('');

    set('sSub', idr(dbOrder.subtotal));
    set('sCode', 'PROMO');
    set('sVoucher', dbOrder.discount > 0 ? idr(dbOrder.discount) : 'IDR 0');
    set('sTotal', idr(dbOrder.total));

  @else
    // Fallback contoh data jika tidak ada order id di URL
    var idr = function(n){ return 'IDR ' + Number(n || 0).toLocaleString('id-ID'); };
    function set(id, v){ if(document.getElementById(id)) document.getElementById(id).textContent = v; }
    document.getElementById('dName').value = 'Customer Zarabel';
    document.getElementById('dTrx').value = 'ZRB-DEMO';
    document.getElementById('dMethod').value = 'QRIS';
    document.getElementById('dDate').value = 'Hari ini';
    document.getElementById('dAddress').value = 'Indonesia';
    set('sSub', idr(100000));
    set('sVoucher', idr(0));
    set('sTotal', idr(100000));
  @endif
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



