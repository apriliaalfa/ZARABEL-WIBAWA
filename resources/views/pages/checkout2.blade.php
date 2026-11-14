<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Zarabel — Checkout Payment</title>

<link rel="icon" type="image/png" href="{{ asset('images/zarabelbg.png') }}">
<link rel="apple-touch-icon" href="{{ asset('images/zarabelbg.png') }}">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;500;700&family=Montserrat:wght@400;700&family=Playfair+Display:wght@400;500&family=Poppins:wght@300;400;500;600;700&family=Volkhov&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<link rel="stylesheet" href="{{ asset('css/catalog.css') }}">
<link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
<script src="{{ $snapJs ?? 'https://app.sandbox.midtrans.com/snap/snap.js' }}" data-client-key="{{ $clientKey ?? '' }}"></script>
</head>
<body>

@include('partials.svg-icons')

<main>

  <!-- ================= HEADER (sudah login) ================= -->
  @include('partials.header-user', ['headerClass' => 'co-header'])

  <!-- ================= ISI CHECKOUT STEP 2 ================= -->
  <section class="co-main">
    <h1>Checkout Form</h1>

    <div class="co-layout">

      <!-- FORM -->
      <form class="checkout-form" id="payForm" method="GET" action="{{ route('order.confirm') }}" novalidate>
        @csrf

        <!-- Stepper: step 1 selesai, step 2 aktif -->
        <div class="stepper" id="stepper">
          <div class="stepper-track" aria-hidden="true">
            <span class="step-mark ok"><svg class="ic"><use href="#i-st-user"/></svg></span>
            <span class="step-line done"></span>
            <span class="step-mark active"><svg class="ic"><use href="#i-st-truck"/></svg></span>
            <span class="step-line"></span>
            <span class="step-mark"><svg class="ic"><use href="#i-st-card"/></svg></span>
          </div>
          <ol class="step-labels">
            <li class="active"><span>Step 1</span><strong>Personal Info</strong></li>
            <li class="active"><span>Step 2</span><strong>Shipping Delivery</strong></li>
            <li><span>Step 3</span><strong>Confirmation</strong></li>
          </ol>
        </div>

        <!-- ===== SHIPPING DELIVERY ===== -->
        <section class="pay-section pay-main">
          <h2>Shipping Delivery</h2>
          <div class="ship-list" role="radiogroup" aria-label="Shipping courier">
            <label class="ship-option">
              <input type="radio" name="courier" value="JNE" data-price="25000">
              <span class="courier-logo"><img src="{{ asset('assets/img/jne.png') }}" alt="JNE"></span>
              <span class="ship-info"><strong>JNE</strong><small>Estimated 2–3 days</small></span>
              <span class="ship-price">IDR 25.000</span>
            </label>
            <label class="ship-option">
              <input type="radio" name="courier" value="TIKI" data-price="30000">
              <span class="courier-logo"><img src="{{ asset('assets/img/tikibg.png') }}" alt="TIKI" style="transform: translateY(-15px) scale(1.5);"></span>
              <span class="ship-info"><strong>TIKI</strong><small>Estimated 2–3 days</small></span>
              <span class="ship-price">IDR 30.000</span>
            </label>
            <label class="ship-option">
              <input type="radio" name="courier" value="J&amp;T" data-price="28000">
              <span class="courier-logo"><img src="{{ asset('assets/img/jntbg.png') }}" alt="J&amp;T" style="transform: translateY(-15px) scale(1.5);"></span>
              <span class="ship-info"><strong>J&amp;T</strong><small>Estimated 2–3 days</small></span>
              <span class="ship-price">IDR 28.000</span>
            </label>
            <label class="ship-option">
              <input type="radio" name="courier" value="SPX Express" data-price="20000">
              <span class="courier-logo"><img src="{{ asset('assets/img/spxbg.png') }}" alt="SPX Express" style="transform: translateY(-15px) scale(1.5);"></span>
              <span class="ship-info"><strong>SPX Express</strong><small>Estimated 2–4 days</small></span>
              <span class="ship-price">IDR 20.000</span>
            </label>
            <label class="ship-option">
              <input type="radio" name="courier" value="SiCepat Express" data-price="27000">
              <span class="courier-logo"><img src="{{ asset('assets/img/sicepatbg.png') }}" alt="SiCepat Express" style="transform: translateY(-15px) scale(1.5);"></span>
              <span class="ship-info"><strong>SiCepat Express</strong><small>Estimated 1–3 days</small></span>
              <span class="ship-price">IDR 27.000</span>
            </label>
            <label class="ship-option">
              <input type="radio" name="courier" value="Lion Parcel" data-price="26000">
              <span class="courier-logo"><img src="{{ asset('assets/img/lionbg.png') }}" alt="Lion Parcel" style="transform: translateY(-15px) scale(1.5);"></span>
              <span class="ship-info"><strong>Lion Parcel</strong><small>Estimated 2–3 days</small></span>
              <span class="ship-price">IDR 26.000</span>
            </label>
          </div>
        </section>

        <!-- ===== PAYMENT METHOD ===== -->
        <section class="pay-section">
          <h2>Payment Method</h2>
          <p class="pay-desc">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will not be shipped until the funds have cleared in our account.</p>

          <div class="pay-box">
            <!-- dropdown metode pembayaran -->
            <input type="hidden" name="payment_method" id="paymentMethod" value="qris">
            <div class="dd" id="ddMethod">
              <button type="button" class="dd-btn" aria-haspopup="listbox" aria-expanded="false">
                <span class="dd-label">QRIS</span>
                <span class="right"><span class="chip"><img src="{{ asset('assets/img/logo qris.png') }}" alt="QRIS"></span><svg class="ic"><use href="#i-chev"/></svg></span>
              </button>
              <ul class="dd-list" role="listbox">
                <li class="dd-item" role="option" data-value="qris" data-label="QRIS" aria-selected="true">QRIS <span class="chip"><img src="{{ asset('assets/img/logo qris.png') }}" alt="QRIS"></span></li>
                <li class="dd-item" role="option" data-value="transfer" data-label="Transfer Bank">Transfer Bank <span class="chip"><img src="{{ asset('assets/img/logo bank tf.png') }}" alt="BANK"></span></li>
                <li class="dd-item" role="option" data-value="ewallet" data-label="E-Wallet">E-Wallet <span class="chip"><img src="{{ asset('assets/img/logo e-wallet.png') }}" alt="E-WALLET"></span></li>
              </ul>
            </div>

            <!-- QRIS -->
            <div class="pay-panel active" id="panel-qris">
              <div class="qris-wrap">
                <img class="qr-img" src="{{ asset('assets/img/qris-code.png') }}" alt="QRIS code">
                <div class="qris-info">
                  <div class="info-row"><span class="lbl">A/n</span><span class="val">ZARABEL</span></div>
                  <div class="info-row"><span class="lbl">Nominal</span><span class="val" data-nominal>IDR 0</span></div>
                </div>
              </div>
              <label class="save-row"><input type="checkbox"> Save This Info For Future</label>
            </div>

            <!-- TRANSFER BANK -->
            <div class="pay-panel" id="panel-transfer">
              <div class="dd" id="ddBank">
                <button type="button" class="dd-btn" aria-haspopup="listbox" aria-expanded="false">
                  <span class="dd-label">BCA</span>
                  <span class="right"><span class="chip"><img src="{{ asset('assets/img/bca.png') }}" alt="BCA"></span><svg class="ic"><use href="#i-chev"/></svg></span>
                </button>
                <ul class="dd-list" role="listbox">
                  <li class="dd-item" role="option" data-label="BCA" data-number="0978 5634 21196" aria-selected="true">BCA <span class="chip"><img src="{{ asset('assets/img/bca.png') }}" alt="BCA"></span></li>
                  <li class="dd-item" role="option" data-label="Mandiri" data-number="4321 8765 4321">Mandiri <span class="chip"><img src="{{ asset('assets/img/mandiri.png') }}" alt="MANDIRI"></span></li>
                  <li class="dd-item" role="option" data-label="BRI" data-number="8765 4321 8765">BRI <span class="chip"><img src="{{ asset('assets/img/bri.png') }}" alt="BRI"></span></li>
                  <li class="dd-item" role="option" data-label="BNI" data-number="1234 9999 0011">BNI <span class="chip"><img src="{{ asset('assets/img/bni.png') }}" alt="BNI"></span></li>
                  <li class="dd-item" role="option" data-label="BSI" data-number="1234 9999 0022">BSI <span class="chip"><img src="{{ asset('assets/img/bsi.png') }}" alt="BSI"></span></li>
                </ul>
              </div>
              <div class="info-row">
                <span class="lbl">No Rekening</span>
                <span class="val"><span id="bankNumber">0978 5634 21196</span>
                  <button type="button" class="copy-btn" data-copy="bankNumber" aria-label="Copy account number"><svg viewBox="0 0 30 30" fill="none"><path d="M5.5 18.8333H4.16667C3.45942 18.8333 2.78115 18.5524 2.28105 18.0523C1.78095 17.5522 1.5 16.8739 1.5 16.1667V4.16667C1.5 3.45942 1.78095 2.78115 2.28105 2.28105C2.78115 1.78095 3.45942 1.5 4.16667 1.5H16.1667C16.8739 1.5 17.5522 1.78095 18.0523 2.28105C18.5524 2.78115 18.8333 3.45942 18.8333 4.16667V5.5M13.5 10.8333H25.5C26.9728 10.8333 28.1667 12.0272 28.1667 13.5V25.5C28.1667 26.9728 26.9728 28.1667 25.5 28.1667H13.5C12.0272 28.1667 10.8333 26.9728 10.8333 25.5V13.5C10.8333 12.0272 12.0272 10.8333 13.5 10.8333Z" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg></button>
                </span>
              </div>
              <div class="info-grid">
                <div class="info-row"><span class="lbl">A/n</span><span class="val">ZARABEL</span></div>
                <div class="info-row"><span class="lbl">Nominal</span><span class="val" data-nominal>IDR 0</span></div>
              </div>
              <label class="save-row"><input type="checkbox"> Save This Info For Future</label>
            </div>

            <!-- E-WALLET -->
            <div class="pay-panel" id="panel-ewallet">
              <div class="dd" id="ddWallet">
                <button type="button" class="dd-btn" aria-haspopup="listbox" aria-expanded="false">
                  <span class="dd-label">GoPay</span>
                  <span class="right"><span class="chip"><img src="{{ asset('assets/img/gopay.png') }}" alt="GOPAY"></span><svg class="ic"><use href="#i-chev"/></svg></span>
                </button>
                <ul class="dd-list" role="listbox">
                  <li class="dd-item" role="option" data-label="GoPay" data-number="0858 4619 7216" aria-selected="true">GoPay <span class="chip"><img src="{{ asset('assets/img/gopay.png') }}" alt="GOPAY"></span></li>
                  <li class="dd-item" role="option" data-label="OVO" data-number="0858 4619 7216">OVO <span class="chip"><img src="{{ asset('assets/img/ovo.png') }}" alt="OVO"></span></li>
                  <li class="dd-item" role="option" data-label="ShopeePay" data-number="0858 4619 7216">ShopeePay <span class="chip"><img src="{{ asset('assets/img/spay.png') }}" alt="SPAY"></span></li>
                  <li class="dd-item" role="option" data-label="Dana" data-number="0858 4619 7216">Dana <span class="chip"><img src="{{ asset('assets/img/dana.png') }}" alt="DANA"></span></li>
                </ul>
              </div>
              <div class="info-row">
                <span class="lbl">Nomor</span>
                <span class="val"><span id="walletNumber">0858 4619 7216</span>
                  <button type="button" class="copy-btn" data-copy="walletNumber" aria-label="Copy wallet number"><svg viewBox="0 0 30 30" fill="none"><path d="M5.5 18.8333H4.16667C3.45942 18.8333 2.78115 18.5524 2.28105 18.0523C1.78095 17.5522 1.5 16.8739 1.5 16.1667V4.16667C1.5 3.45942 1.78095 2.78115 2.28105 2.28105C2.78115 1.78095 3.45942 1.5 4.16667 1.5H16.1667C16.8739 1.5 17.5522 1.78095 18.0523 2.28105C18.5524 2.78115 18.8333 3.45942 18.8333 4.16667V5.5M13.5 10.8333H25.5C26.9728 10.8333 28.1667 12.0272 28.1667 13.5V25.5C28.1667 26.9728 26.9728 28.1667 25.5 28.1667H13.5C12.0272 28.1667 10.8333 26.9728 10.8333 25.5V13.5C10.8333 12.0272 12.0272 10.8333 13.5 10.8333Z" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg></button>
                </span>
              </div>
              <div class="info-grid">
                <div class="info-row"><span class="lbl">A/n</span><span class="val">ZARABEL</span></div>
                <div class="info-row"><span class="lbl">Nominal</span><span class="val" data-nominal>IDR 0</span></div>
              </div>
              <label class="save-row"><input type="checkbox"> Save This Info For Future</label>
            </div>
          </div>
        </section>

        <button class="continue-button" type="submit">Continue to Payment</button>
        <p class="form-error" id="payError" role="alert">Please choose a shipping courier first.</p>
        <p class="success-message" id="success" role="status">Payment details saved. Please complete your transfer and continue to confirmation.</p>
      </form>

      <!-- ORDER SUMMARY -->
      <aside class="summary">
        <h2>Order Summary</h2>
        <div class="summary-card">
          <div class="promo" id="promo">
            <span>Hooray! You use promo code!</span>
            <button type="button" id="closePromo" aria-label="Dismiss promo message"><svg class="ic"><use href="#i-x"/></svg></button>
          </div>
          <div class="co-products">
            <article class="co-product">
              <div class="co-img-wrap">
                <img class="photo" src="{{ asset('assets/img/cart.png') }}" alt="White casual t-shirt">
                <span class="qty-badge">1</span>
              </div>
              <div class="co-copy">
                <h3>White casual t-shirt</h3>
                <p class="co-price">1&nbsp; X&nbsp; IDR 100.000</p>
                <div class="co-notes-wrapper" style="margin-top: 8px;">
                  <div class="co-notes-bar" style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
                    <button type="button" class="add-notes" style="background: none; border: none; border-bottom: 1.5px solid var(--warm-brown, #8B4513); color: var(--warm-brown, #8B4513); font-weight: 600; font-size: 14px; cursor: pointer; padding: 0 0 1px 0;">Notes</button>
                    <em style="font-size: 12px; color: #7a6e65; font-style: italic;">// Klik untuk menambahkan pesan</em>
                  </div>
                  <div class="notes-field" hidden style="margin-top: 6px;">
                    <input type="text" placeholder="Eg: Please recheck the size before send to me :)" value="Please recheck the size before send to me :)" style="width: 100%; padding: 6px 10px; font-size: 13px; border: 1px solid #d4c4b5; border-radius: 6px; font-family: inherit;">
                  </div>
                </div>
              </div>
            </article>
            <hr class="sep">
            <article class="co-product">
              <div class="co-img-wrap">
                <img class="photo" src="{{ asset('assets/img/cart.png') }}" alt="White casual t-shirt">
                <span class="qty-badge">1</span>
              </div>
              <div class="co-copy">
                <h3>White casual t-shirt</h3>
                <p class="co-price">1&nbsp; X&nbsp; IDR 100.000</p>
                <div class="co-notes-wrapper" style="margin-top: 8px;">
                  <div class="co-notes-bar" style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
                    <button type="button" class="add-notes" style="background: none; border: none; border-bottom: 1.5px solid var(--warm-brown, #8B4513); color: var(--warm-brown, #8B4513); font-weight: 600; font-size: 14px; cursor: pointer; padding: 0 0 1px 0;">Notes</button>
                    <em style="font-size: 12px; color: #7a6e65; font-style: italic;">// Klik untuk menambahkan pesan</em>
                  </div>
                  <div class="notes-field" hidden style="margin-top: 6px;">
                    <input type="text" placeholder="Eg: Please double check before packing" value="" style="width: 100%; padding: 6px 10px; font-size: 13px; border: 1px solid #d4c4b5; border-radius: 6px; font-family: inherit;">
                  </div>
                </div>
              </div>
            </article>
          </div>
          <hr class="sep">
        </div>

        <dl class="totals">
          <div><dt>Subtotal</dt><dd>IDR 300.000</dd></div>
          <div id="voucherRow"><dt>Voucher (50KDISCOUNT)</dt><dd class="discount">IDR 50.000</dd></div>
          <div><dt>Shipping</dt><dd id="shippingVal">IDR -</dd></div>
          <div class="grand"><dt>Total</dt><dd id="grandTotal">IDR 250.000</dd></div>
        </dl>

        <p class="privacy-copy">Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our <strong>privacy policy.</strong></p>
      </aside>

    </div>
  </section>

  <!-- ================= FOOTER ================= -->
  @include('partials.footer')

</main>

<script>
  // ---------- Scroll halus + menu HP ----------
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

  // ---------- Hitung total & Muat Item dari Cart ----------
  var SUBTOTAL = 300000;
  var VOUCHER  = 50000;
  var shipping = 0;

  function rp(n){ return 'IDR ' + n.toLocaleString('id-ID'); }

  var cart = [];
  try { cart = JSON.parse(localStorage.getItem('cart') || '[]'); } catch(e){}
  var container = document.querySelector('.co-products');
  if (cart.length > 0 && container) {
    container.innerHTML = '';
    SUBTOTAL = 0;
    cart.forEach(function(item, idx){
      var price = Number(item.harga || 100000);
      var q = Number(item.qty || 1);
      SUBTOTAL += (price * q);
      var art = document.createElement('article');
      art.className = 'co-product';
      art.dataset.productId = item.id || '';
      art.dataset.productCode = item.code || '';
      art.dataset.productName = item.nama || '';
      art.dataset.price = price;
      art.dataset.qty = q;
      art.dataset.size = item.size || 'All Size';
      art.dataset.notes = item.notes || '';
      art.dataset.img = item.img || '';

      art.innerHTML = `
        <div class="co-img-wrap">
          <img class="photo" src="${item.img || '{{ asset('assets/img/cart.png') }}'}" alt="${item.nama}">
          <span class="qty-badge">${q}</span>
        </div>
        <div class="co-copy">
          <h3>${item.nama}</h3>
          <p class="co-price">${q}&nbsp; X&nbsp; ${rp(price)} ${item.size ? '<small style="color:#8B4513; font-weight:600;">(' + item.size + ')</small>' : ''}</p>
          ${item.notes ? '<p class="co-note">' + item.notes + '</p>' : ''}
        </div>
      `;
      container.appendChild(art);
      if (idx < cart.length - 1) {
        var hr = document.createElement('hr');
        hr.className = 'sep';
        container.appendChild(hr);
      }
    });

    var totalsEl = document.querySelector('.totals');
    if (totalsEl) {
      var subtotalEl = totalsEl.querySelector('div:first-child dd');
      if (subtotalEl) subtotalEl.textContent = rp(SUBTOTAL);
    }
  }

  function render(){
    var total = Math.max(0, SUBTOTAL - VOUCHER + shipping);
    document.getElementById('shippingVal').textContent = shipping ? rp(shipping) : 'IDR -';
    document.getElementById('grandTotal').textContent = rp(total);
    document.querySelectorAll('[data-nominal]').forEach(function(el){ el.textContent = rp(total); });
  }

  // Tutup promo -> voucher hilang
  document.getElementById('closePromo').addEventListener('click', function(){
    document.getElementById('promo').hidden = true;
    document.getElementById('voucherRow').hidden = true;
    VOUCHER = 0;
    render();
  });

  // Pilih kurir -> shipping ikut berubah
  document.querySelectorAll('input[name="courier"]').forEach(function(r){
    r.addEventListener('change', function(){
      shipping = parseInt(r.dataset.price, 10) || 0;
      document.getElementById('payError').classList.remove('show');
      render();
    });
  });

  // ---------- Dropdown custom (metode / bank / e-wallet) ----------
  function closeAll(except){
    document.querySelectorAll('.dd.open').forEach(function(d){
      if (d !== except){
        d.classList.remove('open');
        d.querySelector('.dd-btn').setAttribute('aria-expanded','false');
      }
    });
  }

  document.querySelectorAll('.dd').forEach(function(dd){
    var btn = dd.querySelector('.dd-btn');
    btn.addEventListener('click', function(e){
      e.stopPropagation();
      closeAll(dd);
      var open = dd.classList.toggle('open');
      btn.setAttribute('aria-expanded', open);
    });
    dd.querySelectorAll('.dd-item').forEach(function(item){
      item.addEventListener('click', function(){
        dd.querySelectorAll('.dd-item').forEach(function(i){ i.setAttribute('aria-selected','false'); });
        item.setAttribute('aria-selected','true');
        btn.querySelector('.dd-label').textContent = item.dataset.label;
        btn.querySelector('.chip').innerHTML = item.querySelector('.chip').innerHTML;
        dd.classList.remove('open');
        btn.setAttribute('aria-expanded','false');
        dd.dispatchEvent(new CustomEvent('pick', { detail: item.dataset }));
      });
    });
  });
  document.addEventListener('click', function(){ closeAll(null); });

  // Ganti metode -> tampilkan panel yang sesuai
  document.getElementById('ddMethod').addEventListener('pick', function(e){
    var val = e.detail.value;
    document.getElementById('paymentMethod').value = val;
    document.querySelectorAll('.pay-panel').forEach(function(p){ p.classList.remove('active'); });
    document.getElementById('panel-' + val).classList.add('active');
  });
  // Ganti bank / e-wallet -> nomor ikut berubah
  document.getElementById('ddBank').addEventListener('pick', function(e){
    document.getElementById('bankNumber').textContent = e.detail.number;
  });
  document.getElementById('ddWallet').addEventListener('pick', function(e){
    document.getElementById('walletNumber').textContent = e.detail.number;
  });

  // ---------- Copy nomor ----------
  document.querySelectorAll('.copy-btn').forEach(function(b){
    b.addEventListener('click', function(){
      var text = document.getElementById(b.dataset.copy).textContent;
      if (navigator.clipboard){
        navigator.clipboard.writeText(text).then(function(){ alert('Disalin: ' + text); });
      }
    });
  });

  // ---------- Submit Midtrans Snap ----------
  document.getElementById('payForm').addEventListener('submit', function(e){
    e.preventDefault();
    var err = document.getElementById('payError');
    var courierInp = document.querySelector('input[name="courier"]:checked');
    if (!courierInp){
      err.classList.add('show');
      document.querySelector('.ship-list').scrollIntoView({ behavior:'smooth', block:'center' });
      return;
    }
    err.classList.remove('show');

    var submitBtn = this.querySelector('button[type="submit"]');
    var originalText = submitBtn.textContent;
    submitBtn.disabled = true;
    submitBtn.textContent = 'Menyiapkan Pembayaran...';

    // Kumpulkan data customer & produk
    var custName = localStorage.getItem('customerName') || '{{ $user->name ?? "Pelanggan Zarabel" }}';
    var custEmail = localStorage.getItem('customerEmail') || '{{ $user->email ?? "customer@zarabelstudio.com" }}';
    var custPhone = localStorage.getItem('customerPhone') || '{{ $user->phone ?? "081234567890" }}';
    var custAddress = localStorage.getItem('customerAddress') || 'Alamat Pengiriman Zarabel';
    var courierName = courierInp.value;
    var shippingPrice = parseFloat(courierInp.dataset.price || 0);

    // Kumpulkan item dari summary
    var items = [];
    document.querySelectorAll('.co-product').forEach(function(el, index){
      var title = el.dataset.productName || (el.querySelector('h3') ? el.querySelector('h3').textContent.trim() : 'Zarabel Item');
      var itemPrice = parseFloat(el.dataset.price) || 100000;
      var itemQty = parseInt(el.dataset.qty) || 1;
      items.push({
        product_id: el.dataset.productId ? parseInt(el.dataset.productId) : null,
        product_code: el.dataset.productCode || 'ZRB-PROD-' + index,
        product_name: title,
        product_image: el.dataset.img || '',
        price: itemPrice,
        quantity: itemQty,
        size: el.dataset.size || 'All Size',
        notes: el.dataset.notes || ''
      });
    });
    if (items.length === 0) {
      items.push({ product_code: 'ZRB-001', product_name: 'Zarabel Fashion Item', price: 100000, quantity: 1, size: 'All Size' });
    }

    var discount = (document.getElementById('promo') && !document.getElementById('promo').hidden) ? 50000 : 0;

    fetch('{{ route("payment.snap") }}', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      },
      body: JSON.stringify({
        customer_name: custName,
        customer_email: custEmail,
        customer_phone: custPhone,
        shipping_address: custAddress,
        courier: courierName,
        shipping_cost: shippingPrice,
        discount: discount,
        items: items
      })
    })
    .then(function(res){ return res.json(); })
    .then(function(data){
      submitBtn.disabled = false;
      submitBtn.textContent = originalText;

      if (data.status === 'success' && data.snap_token) {
        if (typeof window.snap !== 'undefined') {
          window.snap.pay(data.snap_token, {
            onSuccess: function(result){
              try { localStorage.removeItem('cart'); } catch(e){}
              fetch('{{ route("payment.finish") }}?order_number=' + data.order_number, {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                  result_status: 'success',
                  payment_type: result.payment_type || 'midtrans'
                })
              }).then(function(){
                window.location.href = data.redirect_url;
              });
            },
            onPending: function(result){
              try { localStorage.removeItem('cart'); } catch(e){}
              window.location.href = data.redirect_url;
            },
            onError: function(result){
              alert('Pembayaran gagal atau dibatalkan.');
            },
            onClose: function(){
              // Jika user menutup pop-up
              window.location.href = '{{ route("order.confirm") }}?order=' + data.order_number;
            }
          });
        } else {
          // Fallback jika script snap tidak termuat
          window.location.href = '{{ route("order.confirm") }}?order=' + data.order_number;
        }
      } else {
        alert(data.message || 'Gagal memproses pembayaran. Periksa kredensial Midtrans di .env.');
      }
    })
    .catch(function(err){
      submitBtn.disabled = false;
      submitBtn.textContent = originalText;
      console.error(err);
      // Fallback tetap ke konfirmasi
      window.location.href = '{{ route("order.confirm") }}';
    });
  });

  // Toggle Notes input
  document.querySelectorAll('.co-notes-wrapper').forEach(function(wrap){
    var btn = wrap.querySelector('.add-notes');
    var field = wrap.querySelector('.notes-field');
    if (btn && field) {
      btn.addEventListener('click', function(){
        field.hidden = !field.hidden;
        if (!field.hidden) {
          var inp = field.querySelector('input');
          if (inp) inp.focus();
        }
      });
    }
  });

  render();
</script>

</body>
</html>



