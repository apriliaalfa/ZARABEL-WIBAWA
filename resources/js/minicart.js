/* =========================================================
   minicart.js — Mini cart Zarabel (markup dibuat otomatis)
   Pakai:  <script src="assets/js/minicart.js"></script>  (sebelum </body>)
   Buka  :  tombol .cart-button  atau elemen ber-atribut data-open-minicart
   Tambah:  ZarabelCart.add({ id, nama, harga, qty, img, size }, fromEl)
            fromEl (opsional) = elemen yang "terbang" ke ikon keranjang,
            mis. foto produk atau tombol Add to cart
   Preview desain dengan data contoh: tambahkan ?demo=1 di URL
   ========================================================= */
(function () {
  var CART_KEY     = 'cart';              // key localStorage (samakan dengan halaman cart)
  var CART_URL     = '/cart';             // tombol "View Cart"
  var CHECKOUT_URL = '/checkout';         // tombol "Go to Checkout"

  var DEMO = [
    { id:'demo-1', nama:'White casual t-shirt', harga:450000, qty:1, img:'assets/img/cart.png', size:'' },
    { id:'demo-2', nama:'White casual t-shirt', harga:630000, qty:1, img:'assets/img/cart.png', size:'' }
  ];
  var demoMode = /[?&]demo=1/.test(location.search);

  function read(){
    var raw = null;
    try { raw = localStorage.getItem(CART_KEY); } catch(e) {}
    var list = [];
    try { list = JSON.parse(raw || '[]'); } catch(e) {}
    if (!Array.isArray(list)) list = [];
    if (demoMode && list.length === 0) return DEMO.map(function(x){ return Object.assign({}, x); });
    return list;
  }
  function write(list){
    try { localStorage.setItem(CART_KEY, JSON.stringify(list)); } catch(e) {}
  }
  function idr(n){ return 'IDR ' + Number(n || 0).toLocaleString('id-ID'); }
  function esc(s){
    return String(s == null ? '' : s).replace(/[&<>"']/g, function(c){
      return { '&':'&amp;', '<':'&lt;', '>':'&gt;', '"':'&quot;', "'":'&#39;' }[c];
    });
  }

  var REMOVE_SVG = '<svg viewBox="0 0 20 20" aria-hidden="true"><path fill="currentColor" fill-rule="evenodd" clip-rule="evenodd" d="M10 0C4.47727 0 0 4.47727 0 10C0 15.5227 4.47727 20 10 20C15.5227 20 20 15.5227 20 10C20 4.47727 15.5227 0 10 0ZM13.37 7.91545C13.5356 7.744 13.6272 7.51436 13.6252 7.276C13.6231 7.03764 13.5275 6.80963 13.3589 6.64107C13.1904 6.47252 12.9624 6.37691 12.724 6.37484C12.4856 6.37277 12.256 6.4644 12.0845 6.63L10 8.71455L7.91545 6.63C7.83159 6.54317 7.73128 6.47392 7.62037 6.42627C7.50946 6.37863 7.39016 6.35355 7.26946 6.3525C7.14875 6.35145 7.02904 6.37445 6.91731 6.42016C6.80559 6.46587 6.70409 6.53338 6.61873 6.61873C6.53338 6.70409 6.46587 6.80559 6.42016 6.91731C6.37445 7.02904 6.35145 7.14875 6.3525 7.26946C6.35355 7.39016 6.37863 7.50946 6.42627 7.62037C6.47392 7.73128 6.54317 7.83159 6.63 7.91545L8.71455 10L6.63 12.0845C6.54317 12.1684 6.47392 12.2687 6.42627 12.3796C6.37863 12.4905 6.35355 12.6098 6.3525 12.7305C6.35145 12.8513 6.37445 12.971 6.42016 13.0827C6.46587 13.1944 6.53338 13.2959 6.61873 13.3813C6.70409 13.4666 6.80559 13.5341 6.91731 13.5798C7.02904 13.6255 7.14875 13.6485 7.26946 13.6475C7.39016 13.6465 7.50946 13.6214 7.62037 13.5737C7.73128 13.5261 7.83159 13.4568 7.91545 13.37L10 11.2855L12.0845 13.37C12.256 13.5356 12.4856 13.6272 12.724 13.6252C12.9624 13.6231 13.1904 13.5275 13.3589 13.3589C13.5275 13.1904 13.6231 12.9624 13.6252 12.724C13.6272 12.4856 13.5356 12.256 13.37 12.0845L11.2855 10L13.37 7.91545Z"/></svg>';

  /* ---------- markup ---------- */
  var backdrop = document.createElement('div');
  backdrop.className = 'mc-backdrop';
  var panel = document.createElement('aside');
  panel.className = 'mc';
  panel.setAttribute('role', 'dialog');
  panel.setAttribute('aria-label', 'Shopping Cart');
  panel.innerHTML =
    '<div class="mc-head"><h2>Shopping Cart</h2>' +
      '<button type="button" class="mc-close" aria-label="Close">&times;</button></div>' +
    '<div class="mc-items" id="mcItems"></div>' +
    '<div class="mc-foot">' +
      '<div class="mc-sub"><span>Subtotal</span><strong id="mcTotal">IDR 0</strong></div>' +
      '<a class="mc-checkout" id="mcCheckout" href="' + CHECKOUT_URL + '">Go to checkout</a>' +
      '<a class="mc-view" href="' + CART_URL + '">View Cart</a>' +
    '</div>';
  document.body.appendChild(backdrop);
  document.body.appendChild(panel);

  var itemsEl = panel.querySelector('#mcItems');
  var totalEl = panel.querySelector('#mcTotal');
  var checkoutEl = panel.querySelector('#mcCheckout');

  /* ---------- render ---------- */
  function render(){
    var cart = read(), total = 0, count = 0;
    itemsEl.innerHTML = '';

    if (!cart.length){
      itemsEl.innerHTML = '<div class="mc-empty">Your cart is empty.</div>';
    }
    cart.forEach(function(it, i){
      var qty = Math.max(1, Number(it.qty) || 1);
      total += (Number(it.harga) || 0) * qty;
      count += qty;
      var row = document.createElement('article');
      row.className = 'mc-item';
      row.innerHTML =
        '<img src="' + esc(it.img) + '" alt="">' +
        '<div class="mc-info">' +
          '<h3 class="mc-name">' + esc(it.nama) + '</h3>' +
          (it.size ? '<p class="mc-size">Size ' + esc(it.size) + '</p>' : '') +
          '<p class="mc-price">' + idr(it.harga) + '</p>' +
          '<div class="mc-qty">' +
            '<button type="button" data-act="minus" aria-label="Decrease">&minus;</button>' +
            '<span>' + String(qty).padStart(2, '0') + '</span>' +
            '<button type="button" data-act="plus" aria-label="Increase">+</button>' +
          '</div>' +
        '</div>' +
        '<button type="button" class="mc-remove" data-act="remove" aria-label="Remove">' + REMOVE_SVG + '</button>';
      row.addEventListener('click', function(e){
        var b = e.target.closest('[data-act]');
        if (!b) return;
        var list = read();
        if (!list[i]) return;
        if (b.dataset.act === 'plus')  list[i].qty = Math.min(99, (Number(list[i].qty) || 1) + 1);
        if (b.dataset.act === 'minus') list[i].qty = Math.max(1,  (Number(list[i].qty) || 1) - 1);
        if (b.dataset.act === 'remove') list.splice(i, 1);
        write(list);
        render();
      });
      itemsEl.appendChild(row);
    });

    totalEl.textContent = idr(total);
    checkoutEl.setAttribute('aria-disabled', cart.length ? 'false' : 'true');
    var badge = document.getElementById('cartBadge');
    if (badge) badge.textContent = count;
  }

  /* ---------- buka / tutup ---------- */
  function open(){
    render();
    backdrop.classList.add('show');
    panel.classList.add('show');
    document.body.classList.add('mc-open');
  }
  function close(){
    backdrop.classList.remove('show');
    panel.classList.remove('show');
    document.body.classList.remove('mc-open');
  }
  panel.querySelector('.mc-close').addEventListener('click', close);
  backdrop.addEventListener('click', close);
  document.addEventListener('keydown', function(e){ if (e.key === 'Escape') close(); });

  document.querySelectorAll('.cart-button, [data-open-minicart]').forEach(function(b){
    b.removeAttribute('onclick');           // matikan link lama ke halaman cart
    b.addEventListener('click', function(e){ e.preventDefault(); open(); });
  });

  /* ---------- efek terbang ke ikon keranjang ---------- */
  function fly(fromEl, done){
    var target = document.querySelector('.cart-button');
    if (!fromEl || !target || !fromEl.animate){ done(); return; }

    var s = fromEl.getBoundingClientRect();
    var t = target.getBoundingClientRect();
    var size = 110;
    var left = s.left + s.width / 2 - size / 2;
    var top  = s.top  + s.height / 2 - size / 2;
    // jaga supaya titik awal tetap terlihat di layar
    top  = Math.max(8, Math.min(window.innerHeight - size - 8, top));
    left = Math.max(8, Math.min(window.innerWidth  - size - 8, left));

    var el;
    // kalau gambar gagal dimuat, pakai bulatan cokelat supaya efek tetap terlihat
    if (fromEl.tagName === 'IMG' && fromEl.complete && fromEl.naturalWidth > 0){
      el = document.createElement('img');
      el.src = fromEl.currentSrc || fromEl.src;
      el.alt = '';
    } else {
      el = document.createElement('div');
    }
    el.className = 'mc-fly';
    el.style.cssText = 'left:' + left + 'px;top:' + top + 'px;width:' + size + 'px;height:' + size + 'px;';
    document.body.appendChild(el);

    var dx = (t.left + t.width / 2)  - (left + size / 2);
    var dy = (t.top  + t.height / 2) - (top  + size / 2);
    var anim = el.animate([
      { transform:'translate(0,0) scale(1)', opacity:1 },
      { transform:'translate(' + dx * 0.5 + 'px,' + (dy * 0.5 - 70) + 'px) scale(.55)', opacity:.95, offset:.55 },
      { transform:'translate(' + dx + 'px,' + dy + 'px) scale(.12)', opacity:.35 }
    ], { duration:900, easing:'cubic-bezier(.45,.05,.55,.95)', fill:'forwards' });

    anim.onfinish = function(){
      el.remove();
      target.classList.remove('mc-bump');
      void target.offsetWidth;               // restart animasi
      target.classList.add('mc-bump');
      target.addEventListener('animationend', function h(){
        target.classList.remove('mc-bump');
        target.removeEventListener('animationend', h);
      });
      done();
    };
  }

  /* ---------- tambah produk ---------- */
  function add(item, fromEl){
    var list = [];
    try { list = JSON.parse(localStorage.getItem(CART_KEY) || '[]'); } catch(e) {}
    if (!Array.isArray(list)) list = [];
    var qty = Math.max(1, Number(item.qty) || 1);
    var same = list.filter(function(x){ return x.id === item.id && (x.size || '') === (item.size || ''); })[0];
    if (same) same.qty = Math.min(99, (Number(same.qty) || 1) + qty);
    else list.push({ id:item.id, nama:item.nama, harga:Number(item.harga) || 0, qty:qty, img:item.img || '', size:item.size || '' });
    write(list);
    render();
    fly(fromEl, open);          // terbang dulu, baru sidebar terbuka
  }

  window.ZarabelCart = { add:add, open:open, close:close, render:render };
  render();
})();