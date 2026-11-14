<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Zarabel — Checkout</title>

<link rel="icon" type="image/png" href="{{ asset('images/zarabelbg.png') }}">
<link rel="apple-touch-icon" href="{{ asset('images/zarabelbg.png') }}">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;500;700&family=Montserrat:wght@400;700&family=Playfair+Display:wght@400;500&family=Poppins:wght@300;400;500;600;700&family=Volkhov&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<link rel="stylesheet" href="{{ asset('css/catalog.css') }}">
<link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
</head>
<body>

@include('partials.svg-icons')

<main>

  <!-- ================= HEADER (sudah login) ================= -->
  @include('partials.header-user', ['headerClass' => 'co-header'])

  <!-- ================= ISI CHECKOUT ================= -->
  <section class="co-main">
    <h1>Checkout Form</h1>

    <div class="co-layout">

      <!-- FORM -->
      <form class="checkout-form" id="coForm" method="GET" action="{{ route('checkout.payment') }}">
        @csrf

        <div class="stepper" id="stepper">
          <div class="stepper-track" aria-hidden="true">
            <span class="step-mark active"><svg class="ic"><use href="#i-st-user"/></svg></span>
            <span class="step-line"></span>
            <span class="step-mark"><svg class="ic"><use href="#i-st-truck"/></svg></span>
            <span class="step-line"></span>
            <span class="step-mark"><svg class="ic"><use href="#i-st-card"/></svg></span>
          </div>
          <ol class="step-labels">
            <li class="active"><span>Step 1</span><strong>Personal Info</strong></li>
            <li><span>Step 2</span><strong>Shipping Delivery</strong></li>
            <li><span>Step 3</span><strong>Confirmation</strong></li>
          </ol>
        </div>

        <section class="form-section contact-section">
          <h2>Contact Person</h2>
          <div class="fields">
            <label class="field" for="name"><span>Name</span>
              <input id="name" name="name" type="text" placeholder="Eg: John Doe" autocomplete="name" required>
            </label>
            <div class="field">
              <span>Phone Number</span>
              <div class="phone-input">
                <label class="country-code">
                  <i aria-hidden="true"></i>
                  <select aria-label="Country calling code">
                    <option value="+62" selected>(+62)</option>
                    <option value="+60">(+60)</option>
                    <option value="+65">(+65)</option>
                  </select>
                </label>
                <input name="phone" type="tel" placeholder="111-2222-33333" required>
              </div>
            </div>
            <label class="field" for="email"><span>Email</span>
              <input id="email" name="email" type="email" placeholder="Eg: example@example.com" required>
            </label>
          </div>
        </section>

        <section class="form-section address-section">
          <h2>Address Detail</h2>
          <div class="fields">
            <label class="field" for="address"><span>Address</span>
              <textarea id="address" name="address" placeholder="Eg: ABC Street 12A, West Java, Indonesia" required></textarea>
            </label>
            <label class="field" for="country"><span>Country</span>
              <select id="country" name="country" required>
                <option value="" disabled selected>--Choose Country--</option>
                <option>Indonesia</option><option>Malaysia</option><option>Singapore</option>
              </select>
            </label>
            <div class="location-row">
              <label class="field" for="province"><span>State/Province</span>
                <select id="province" name="province" required>
                  <option value="" disabled selected>--Choose Province--</option>
                  <option>West Java</option><option>Central Java</option><option>East Java</option>
                </select>
              </label>
              <label class="field" for="postal"><span>Postal Code</span>
                <select id="postal" name="postal" required>
                  <option value="" disabled selected>--Choose ZIP Code--</option>
                  <option>10110</option><option>40115</option><option>60241</option>
                </select>
              </label>
            </div>
          </div>
        </section>

        <button class="continue-button" type="submit">Continue to Shipping</button>
        <p class="success-message" id="success" role="status">Personal information saved. Shipping details are ready for the next step.</p>
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
          <div><dt>Shipping</dt><dd>IDR -</dd></div>
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

  // Render Dynamic Cart Summary in Checkout 1
  function money(n){ return 'IDR ' + Number(n || 0).toLocaleString('id-ID'); }
  (function(){
    var cart = [];
    try { cart = JSON.parse(localStorage.getItem('cart') || '[]'); } catch(e){}
    var container = document.querySelector('.co-products');
    if (cart.length > 0 && container) {
      container.innerHTML = '';
      var subtotal = 0;
      cart.forEach(function(item, idx){
        var price = Number(item.harga || 100000);
        var q = Number(item.qty || 1);
        subtotal += (price * q);
        var art = document.createElement('article');
        art.className = 'co-product';
        art.innerHTML = `
          <div class="co-img-wrap">
            <img class="photo" src="${item.img || '{{ asset('assets/img/cart.png') }}'}" alt="${item.nama}">
            <span class="qty-badge">${q}</span>
          </div>
          <div class="co-copy">
            <h3>${item.nama}</h3>
            <p class="co-price">${q}&nbsp; X&nbsp; ${money(price)} ${item.size ? '<small style="color:#8B4513; font-weight:600;">(' + item.size + ')</small>' : ''}</p>
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

      var disc = (document.getElementById('promo') && !document.getElementById('promo').hidden) ? 50000 : 0;
      var totalsEl = document.querySelector('.totals');
      if (totalsEl) {
        var subtotalEl = totalsEl.querySelector('div:first-child dd');
        if (subtotalEl) subtotalEl.textContent = money(subtotal);
        var grandEl = document.getElementById('grandTotal');
        if (grandEl) grandEl.textContent = money(Math.max(0, subtotal - disc));
      }
    }
  })();

  // Submit form: simpan data customer ke localStorage & lanjut ke step 2
  document.getElementById('coForm').addEventListener('submit', function(e){
    var name = document.getElementById('name').value;
    var phone = document.getElementById('phone') ? document.getElementById('phone').value : '';
    var email = document.getElementById('email') ? document.getElementById('email').value : '';
    var address = document.getElementById('address').value;
    if(name) localStorage.setItem('customerName', name);
    if(phone) localStorage.setItem('customerPhone', phone);
    if(email) localStorage.setItem('customerEmail', email);
    if(address) localStorage.setItem('customerAddress', address);
  });
</script>

</body>
</html>



