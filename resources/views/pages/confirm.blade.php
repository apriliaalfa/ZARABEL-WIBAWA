<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Zarabel — Confirmation</title>

<link rel="icon" type="image/png" href="{{ asset('images/zarabelbg.png') }}">
<link rel="apple-touch-icon" href="{{ asset('images/zarabelbg.png') }}">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;500;700&family=Montserrat:wght@400;600;700&family=Playfair+Display:ital,wght@0,400;0,500;0,600;1,400&family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700&family=Tenor+Sans&family=Volkhov:ital,wght@0,400;1,400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<link rel="stylesheet" href="{{ asset('css/catalog.css') }}">
<link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
</head>
<body>

@include('partials.svg-icons')

<main>

  <!-- ================= HEADER (sudah login) ================= -->
  @include('partials.header-user')

  <!-- ================= ISI CHECKOUT STEP 3 ================= -->
  <section class="co-main">
    <h1>Confirmation</h1>

    <div class="co-layout">

      <!-- KIRI -->
      <div class="checkout-form confirm-form">

        <!-- Stepper: step 1 & 2 selesai, step 3 aktif -->
        <div class="stepper" id="stepper">
          <div class="stepper-track" aria-hidden="true">
            <span class="step-mark ok"><svg class="ic"><use href="#i-st-user"/></svg></span>
            <span class="step-line done"></span>
            <span class="step-mark ok"><svg class="ic"><use href="#i-st-truck"/></svg></span>
            <span class="step-line done"></span>
            <span class="step-mark active"><svg class="ic"><use href="#i-st-card"/></svg></span>
          </div>
          <ol class="step-labels">
            <li class="active"><span>Step 1</span><strong>Personal Info</strong></li>
            <li class="active"><span>Step 2</span><strong>Shipping Delivery</strong></li>
            <li><span>Step 3</span><strong>Confirmation</strong></li>
          </ol>
        </div>

        <!-- Nomor order + status -->
        <div class="order-meta">
          <div>
            <span class="lbl">Order Number</span>
            <strong class="num" id="orderNumber">12345ASDFGHJ</strong>
          </div>
          <span class="status-badge" id="statusBadge">Waiting For Payment</span>
        </div>

        <!-- Info pembayaran -->
        <section class="pay-info">
          <h2>Payment Information</h2>
          <p>Upon completing a purchase, you will receive a payment confirmation email. This email will contain essential information about the items you have purchased and the total amount that needs to be paid.</p>
        </section>

<button class="continue-button" id="paidBtn" type="button">I Already Pay</button>
        <p class="success-message" id="success" role="status">Thank you! We have received your confirmation and will verify your payment shortly.</p>
      </div>

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
                <p class="co-note">Please recheck the size before send to me :)</p>
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

<!-- Pop up terima kasih -->
<div class="pay-modal" id="payModal" role="dialog" aria-modal="true" aria-labelledby="payModalTitle" hidden>
  <div class="pay-modal-box">
    <div class="pay-modal-check">✓</div>
    <h3 id="payModalTitle">Thank you!</h3>
    <p>We have received your confirmation and will verify your payment shortly.</p>
    <div class="pay-modal-bar"><i></i></div>
    <small>Redirecting to your order receipt…</small>
  </div>
</div>

<script>
  // Scroll halus + menu HP
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

  // Tutup promo -> voucher hilang, total jadi 300.000
  document.getElementById('closePromo').addEventListener('click', function(){
    document.getElementById('promo').hidden = true;
    document.getElementById('voucherRow').hidden = true;
    document.getElementById('grandTotal').textContent = 'IDR 300.000';
  });

  // "I Already Pay" -> pop up terima kasih, lalu pindah ke halaman success
  document.getElementById('paidBtn').addEventListener('click', function(){
    this.disabled = true;
    document.getElementById('payModal').hidden = false;
    setTimeout(function(){
      window.location.href = "{{ route('order.success') }}";
    }, 2500);
  });
</script>

</body>
</html>



