<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Zarabel — Shopping Cart</title>

<link rel="icon" type="image/png" href="{{ asset('assets/img/zarabelbg.png') }}">
<link rel="apple-touch-icon" href="{{ asset('assets/img/zarabelbg.png') }}">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;500;700&family=Montserrat:wght@400;700&family=Playfair+Display:wght@400;500&family=Poppins:wght@400;500;600;700&family=Volkhov&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<link rel="stylesheet" href="{{ asset('css/catalog.css') }}">
<link rel="stylesheet" href="{{ asset('css/cart.css') }}">
</head>
<body>

<!-- ===== Ikon SVG ===== -->
@include('partials.svg-icons')

<main>

  <!-- ================= HEADER (sudah login) ================= -->
  @include('partials.header-user')

  <!-- ================= ISI CART ================= -->
  <section class="cart-main">
    <h1>Shopping cart</h1>

    <div class="cart-layout">

      <!-- DAFTAR PRODUK -->
      <section class="cart-list" id="cartList" aria-label="Cart items">

        <article class="cart-product" data-price="100000">
          <div class="product-main">
            <img class="cp-image" src="{{ asset('assets/img/cart.png') }}" alt="Man wearing a white casual t-shirt">
            <div class="cp-details">
              <div class="cp-copy">
                <h2>White casual t-shirt</h2>
                <p>IDR 100.000</p>
              </div>
              <div class="cp-controls">
                <div class="quantity">
                  <button type="button" class="minus" aria-label="Decrease quantity" disabled><svg class="ic"><use href="#i-minus"/></svg></button>
                  <span class="qty">1</span>
                  <button type="button" class="plus" aria-label="Increase quantity"><svg class="ic"><use href="#i-plus"/></svg></button>
                </div>
                <button type="button" class="delete-button"><svg class="ic"><use href="#i-trash"/></svg><span>Delete</span></button>
              </div>
            </div>
          </div>
          <div class="cart-notes-wrapper" style="margin-top: 12px;">
            <div class="cart-notes-bar" style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
              <button type="button" class="add-notes">Notes</button>
              <em class="notes-hint" style="font-size: 13px; color: #7a6e65; font-style: italic;">// Klik untuk menambahkan pesan</em>
            </div>
            <label class="notes-field" hidden style="margin-top: 8px;"><span>Notes:</span><input placeholder="Eg: Please double check before packing."></label>
          </div>
        </article>

        <article class="cart-product" data-price="100000">
          <div class="product-main">
            <img class="cp-image" src="{{ asset('assets/img/cart.png') }}" alt="Man wearing a white casual t-shirt">
            <div class="cp-details">
              <div class="cp-copy">
                <h2>White casual t-shirt</h2>
                <p>IDR 100.000</p>
              </div>
              <div class="cp-controls">
                <div class="quantity">
                  <button type="button" class="minus" aria-label="Decrease quantity" disabled><svg class="ic"><use href="#i-minus"/></svg></button>
                  <span class="qty">1</span>
                  <button type="button" class="plus" aria-label="Increase quantity"><svg class="ic"><use href="#i-plus"/></svg></button>
                </div>
                <button type="button" class="delete-button"><svg class="ic"><use href="#i-trash"/></svg><span>Delete</span></button>
              </div>
            </div>
          </div>
          <div class="cart-notes-wrapper" style="margin-top: 12px;">
            <div class="cart-notes-bar" style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
              <button type="button" class="add-notes">Notes</button>
              <em class="notes-hint" style="font-size: 13px; color: #7a6e65; font-style: italic;">// Klik untuk menambahkan pesan</em>
            </div>
            <label class="notes-field" hidden style="margin-top: 8px;"><span>Notes:</span><input placeholder="Eg: Please double check before packing."></label>
          </div>
        </article>

        <article class="cart-product big" data-price="100000">
          <div class="product-main">
            <img class="cp-image" src="{{ asset('assets/img/cart.png') }}" alt="Man wearing a white casual t-shirt">
            <div class="cp-details">
              <div class="cp-copy">
                <h2>White casual t-shirt</h2>
                <div class="discount-price">
                  <div><span class="old-price">IDR 200.000</span><span class="discount-pill">50%</span></div>
                  <span class="sale-price">IDR 100.000</span>
                </div>
              </div>
              <div class="cp-controls">
                <div class="quantity">
                  <button type="button" class="minus" aria-label="Decrease quantity" disabled><svg class="ic"><use href="#i-minus"/></svg></button>
                  <span class="qty">1</span>
                  <button type="button" class="plus" aria-label="Increase quantity"><svg class="ic"><use href="#i-plus"/></svg></button>
                </div>
                <button type="button" class="delete-button"><svg class="ic"><use href="#i-trash"/></svg><span>Delete</span></button>
              </div>
            </div>
          </div>
          <div class="cart-notes-wrapper" style="margin-top: 12px;">
            <div class="cart-notes-bar" style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
              <button type="button" class="add-notes">Notes</button>
              <em class="notes-hint" style="font-size: 13px; color: #7a6e65; font-style: italic;">// Klik untuk menambahkan pesan</em>
            </div>
            <label class="notes-field" hidden style="margin-top: 8px;"><span>Notes:</span><input placeholder="Eg: Please double check before packing."></label>
          </div>
        </article>

        <div class="empty-cart" id="emptyCart">
          <h2>Your cart is empty</h2>
          <a href="{{ route('catalog') }}">Continue shopping</a>
        </div>
      </section>

      <!-- SHOPPING INFO -->
      <aside class="shopping-info">
        <h2>Shopping Info</h2>

        <div class="promo-banner" id="promo">
          <div>
            <span id="promoText">Hooray! Your promo is applied!</span>
            <button type="button" class="use-promo" id="usePromo" hidden>Use promo code</button>
          </div>
          <button type="button" class="close" id="closePromo" aria-label="Dismiss promo code"><svg class="ic"><use href="#i-x"/></svg></button>
        </div>

        <dl class="totals">
          <div><dt>Subtotal</dt><dd id="subtotal">IDR 300.000</dd></div>
          <div><dt>Total</dt><dd id="total">IDR 250.000</dd></div>
        </dl>

        <button type="button" class="checkout-button" id="checkoutBtn">Proceed to checkout</button>
        <div class="checkout-notice" id="notice" hidden></div>
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

  var PROMO = 50000;
  var promoApplied = true;
  var list = document.getElementById('cartList');
  var emptyBox = document.getElementById('emptyCart');
  var promo = document.getElementById('promo');
  var promoText = document.getElementById('promoText');
  var usePromo = document.getElementById('usePromo');
  var notice = document.getElementById('notice');
  var checkoutBtn = document.getElementById('checkoutBtn');

  function money(n){ return 'IDR ' + n.toLocaleString('id-ID'); }
  function items(){ return Array.prototype.slice.call(list.querySelectorAll('.cart-product')); }

  function update(){
    var subtotal = 0, count = items().length;
    items().forEach(function(it){
      subtotal += Number(it.dataset.price) * Number(it.querySelector('.qty').textContent);
    });
    var total = Math.max(0, subtotal - (promoApplied && count ? PROMO : 0));
    document.getElementById('subtotal').textContent = money(subtotal);
    document.getElementById('total').textContent = money(total);
    emptyBox.classList.toggle('show', count === 0);
    checkoutBtn.disabled = count === 0;
  }

  items().forEach(function(it){
    var qty = it.querySelector('.qty');
    var minus = it.querySelector('.minus');
    it.querySelector('.plus').addEventListener('click', function(){
      qty.textContent = Number(qty.textContent) + 1;
      minus.disabled = false; update();
    });
    minus.addEventListener('click', function(){
      var n = Math.max(1, Number(qty.textContent) - 1);
      qty.textContent = n; minus.disabled = n === 1; update();
    });
    it.querySelector('.delete-button').addEventListener('click', function(){
      it.remove(); update();
    });
    var field = it.querySelector('.notes-field');
    var addNotes = it.querySelector('.add-notes');
    if (addNotes && field) {
      addNotes.addEventListener('click', function(){
        field.hidden = !field.hidden;
        if (!field.hidden) {
          var inp = field.querySelector('input');
          if (inp) inp.focus();
        }
      });
    }
  });

  // Promo
  usePromo.addEventListener('click', function(){
    promoApplied = true;
    promoText.textContent = 'Hooray! Your promo is applied!';
    usePromo.hidden = true; update();
  });
  document.getElementById('closePromo').addEventListener('click', function(){
    promo.hidden = true; promoApplied = false; update();
  });

  // Checkout
  checkoutBtn.addEventListener('click', function(){
    window.location.href = "{{ route('checkout') }}";
  });

  update();
</script>

</body>
</html>



