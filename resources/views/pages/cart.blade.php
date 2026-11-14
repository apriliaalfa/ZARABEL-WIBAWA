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

        <div id="dynamicCartItems"></div>

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

  function money(n){ return 'IDR ' + Number(n || 0).toLocaleString('id-ID'); }

  function getCartData() {
    try {
      var data = JSON.parse(localStorage.getItem('cart') || '[]');
      return Array.isArray(data) ? data : [];
    } catch(e) {
      return [];
    }
  }

  function saveCartData(data) {
    localStorage.setItem('cart', JSON.stringify(data));
  }

  function renderCart() {
    var cart = getCartData();
    var container = document.getElementById('dynamicCartItems');
    container.innerHTML = '';

    if (cart.length === 0) {
      emptyBox.classList.add('show');
      checkoutBtn.disabled = true;
      document.getElementById('subtotal').textContent = money(0);
      document.getElementById('total').textContent = money(0);
      return;
    }

    emptyBox.classList.remove('show');
    checkoutBtn.disabled = false;

    var subtotal = 0;

    cart.forEach(function(item, index) {
      var itemPrice = Number(item.harga || 100000);
      var itemQty = Number(item.qty || 1);
      subtotal += (itemPrice * itemQty);

      var art = document.createElement('article');
      art.className = 'cart-product';
      art.dataset.price = itemPrice;
      art.innerHTML = `
        <div class="product-main">
          <img class="cp-image" src="${item.img || '{{ asset('assets/img/cart.png') }}'}" alt="${item.nama}">
          <div class="cp-details">
            <div class="cp-copy">
              <h2>${item.nama}</h2>
              <p>${money(itemPrice)} ${item.size ? '<small style="color:#8B4513; margin-left:6px; font-weight:600;">(' + item.size + ')</small>' : ''}</p>
            </div>
            <div class="cp-controls">
              <div class="quantity">
                <button type="button" class="minus" aria-label="Decrease quantity" ${itemQty <= 1 ? 'disabled' : ''}><svg class="ic"><use href="#i-minus"/></svg></button>
                <span class="qty">${itemQty}</span>
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
          <label class="notes-field" ${item.notes ? '' : 'hidden'} style="margin-top: 8px;">
            <span>Notes:</span>
            <input class="note-inp" placeholder="Eg: Please double check before packing." value="${item.notes || ''}">
          </label>
        </div>
      `;

      art.querySelector('.plus').addEventListener('click', function(){
        cart[index].qty = (cart[index].qty || 1) + 1;
        saveCartData(cart);
        renderCart();
      });

      art.querySelector('.minus').addEventListener('click', function(){
        if (cart[index].qty > 1) {
          cart[index].qty -= 1;
          saveCartData(cart);
          renderCart();
        }
      });

      art.querySelector('.delete-button').addEventListener('click', function(){
        cart.splice(index, 1);
        saveCartData(cart);
        renderCart();
      });

      var addNotes = art.querySelector('.add-notes');
      var notesField = art.querySelector('.notes-field');
      var noteInp = art.querySelector('.note-inp');
      if (addNotes && notesField) {
        addNotes.addEventListener('click', function(){
          notesField.hidden = !notesField.hidden;
          if (!notesField.hidden) noteInp.focus();
        });
        noteInp.addEventListener('input', function(){
          cart[index].notes = noteInp.value;
          saveCartData(cart);
        });
      }

      container.appendChild(art);
    });

    var total = Math.max(0, subtotal - (promoApplied && cart.length ? PROMO : 0));
    document.getElementById('subtotal').textContent = money(subtotal);
    document.getElementById('total').textContent = money(total);
  }

  // Promo
  usePromo.addEventListener('click', function(){
    promoApplied = true;
    promoText.textContent = 'Hooray! Your promo is applied!';
    usePromo.hidden = true;
    renderCart();
  });
  document.getElementById('closePromo').addEventListener('click', function(){
    promo.hidden = true;
    promoApplied = false;
    renderCart();
  });

  // Checkout
  checkoutBtn.addEventListener('click', function(){
    window.location.href = "{{ route('checkout') }}";
  });

  renderCart();
</script>

</body>
</html>



