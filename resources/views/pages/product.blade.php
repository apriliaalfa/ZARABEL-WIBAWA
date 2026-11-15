<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Zarabel — Product Details</title>

<link rel="icon" type="image/png" href="{{ asset('images/zarabelbg.png') }}">
<link rel="apple-touch-icon" href="{{ asset('images/zarabelbg.png') }}">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Jost:wght@400&family=Lato:wght@400;500;700&family=Montserrat:wght@400;700&family=Playfair+Display:ital,wght@0,400;0,500;0,600;1,400&family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Poppins:wght@400;500;600;700&family=Tenor+Sans&family=Volkhov:ital,wght@0,400;1,400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<link rel="stylesheet" href="{{ asset('css/catalog.css') }}">
<link rel="stylesheet" href="{{ asset('css/product.css') }}">
<link rel="stylesheet" href="{{ asset('css/minicart.css') }}">
</head>
<body>

<!-- ===== Ikon SVG ===== -->
@include('partials.svg-icons')

<main>

  <!-- ================= HEADER (sudah login) ================= -->
  @include('partials.header-user')

  <!-- ================= ISI PRODUCT (Dinamis dari Database) ================= -->
  @php
    $pName = $product->name ?? 'Nara Pleats';
    $pCat = $product->category_name ?? 'Pleats';
    $pPrice = $product ? number_format($product->price, 0, ',', '.') : '115.000';
    $pDiscountPrice = $product && $product->discount_price ? number_format($product->discount_price, 0, ',', '.') : ($product ? number_format($product->price * 1.25, 0, ',', '.') : '150.000');
    $pStock = $product->stock ?? 10;
    $pDesc = $product->description ?? 'Koleksi busana lipit artistik khas Zarabel.';
    $pInfo = $product->additional_information ?? 'Material premium, adem, dan nyaman dipakai seharian.';
    
    $mainImg = 'assets/img/Kirana1.jpg';
    if (!empty($product->main_image)) {
        $mainImg = $product->main_image;
    }
    $mainImgUrl = Str::startsWith($mainImg, ['http://', 'https://', 'assets/', 'storage/', 'uploads/']) ? asset($mainImg) : asset('assets/img/Kirana1.jpg');
    
    $gallery = is_array($product->gallery_images ?? null) ? $product->gallery_images : [];
    if (!empty($mainImg) && !in_array($mainImg, $gallery)) {
        array_unshift($gallery, $mainImg);
    }
    if (empty($gallery)) {
        $gallery = [$mainImg];
    }
  @endphp
  <section class="pd-main">
    <div class="pd-top">

      <!-- GALERI -->
      <div class="pd-gallery">
        <img class="pd-photo" id="mainPhoto" src="{{ $mainImgUrl }}" alt="{{ $pName }}" style="object-fit:cover;" onerror="this.onerror=null;this.src='{{ asset('assets/img/Kirana1.jpg') }}'">
        <div class="pd-thumbs" id="thumbs">
          @foreach($gallery as $i => $gImg)
            @php
              $gUrl = Str::startsWith($gImg, ['http://', 'https://', 'assets/', 'storage/', 'uploads/']) ? asset($gImg) : asset('assets/img/Kirana1.jpg');
            @endphp
            <button class="{{ $i === 0 ? 'on' : '' }}" data-src="{{ $gUrl }}"><img src="{{ $gUrl }}" alt="" style="object-fit:cover;" onerror="this.closest('button').remove();"></button>
          @endforeach
        </div>
      </div>

      <!-- INFO -->
      <div class="pd-info">

        <div class="pd-head">
          <div class="pd-title-block">
            <div class="pd-cat-row">
              <span class="pd-cat">{{ $pCat }}</span>
              <span class="pd-rate"><svg class="ic"><use href="#i-star"/></svg> {{ number_format($product->rating ?? 4.95, 2) }}</span>
            </div>
            <h1 class="pd-title">{{ $pName }}</h1>
            <div class="pd-viewing"><svg class="ic"><use href="#i-eye"/></svg> 24 people are viewing this right now</div>
          </div>

          <div class="pd-price">
            <div class="row"><span class="old">IDR {{ $pDiscountPrice }}</span><span class="pill">Save</span></div>
            <span class="now">IDR {{ $pPrice }}</span>
          </div>

          <div class="pd-stock">
            <p>Only {{ $pStock }} item(s) left in stock!</p>
            <div class="bar"><i style="width: {{ min(100, max(15, ($pStock / 20) * 100)) }}%;"></i></div>
          </div>
        </div>

        <div class="pd-buy">
          <span class="label">Quantity</span>
          <div class="pd-buy-row">
            <div class="pd-qty">
              <button type="button" id="qMinus" aria-label="Decrease"><svg class="ic"><use href="#i-minus"/></svg></button>
              <span id="qty">1</span>
              <button type="button" id="qPlus" aria-label="Increase"><svg class="ic"><use href="#i-plus"/></svg></button>
            </div>
            <button type="button" class="pd-btn add" id="addBtn">Add to cart <svg class="ic"><use href="#i-addcart"/></svg></button>
            <button type="button" class="pd-btn checkout" id="directCheckoutBtn">Checkout</button>
          </div>
        </div>

        <div class="pd-tools">
          <button type="button"><svg class="ic"><use href="#i-compare"/></svg> Compare</button>
          <button type="button"><svg class="ic"><use href="#i-ask"/></svg> Ask a question</button>
          <button type="button"><svg class="ic"><use href="#i-share"/></svg> Share</button>
        </div>

        <div class="pd-pay">
          <div class="payment-icons">
            <div class="pay-wrap"><img src="https://img.icons8.com/color/48/visa.png" alt="Visa"></div>
            <div class="pay-wrap"><img src="https://img.icons8.com/color/48/mastercard.png" alt="Mastercard"></div>
            <div class="pay-wrap"><img src="https://img.icons8.com/color/48/amex.png" alt="Amex"></div>
            <div class="pay-wrap"><img src="https://img.icons8.com/color/48/jcb.png" alt="JCB"></div>
            <div class="pay-wrap"><img src="https://img.icons8.com/color/48/discover.png" alt="Discover"></div>
            <div class="pay-wrap"><img src="https://img.icons8.com/color/48/paypal.png" alt="PayPal"></div>
            <div class="pay-wrap"><img src="https://img.icons8.com/color/48/bank-card-front-side.png" alt="Card"></div>
            <div class="pay-wrap"><img src="{{ asset('assets/img/bca.png') }}" alt="BCA"></div>
            <div class="pay-wrap"><img src="{{ asset('assets/img/bni.png') }}" alt="BNI"></div>
            <div class="pay-wrap"><img src="{{ asset('assets/img/mandiri.png') }}" alt="Mandiri"></div>
            <div class="pay-wrap"><img src="{{ asset('assets/img/bri.png') }}" alt="BRI"></div>
            <div class="pay-wrap"><img src="{{ asset('assets/img/bsi.png') }}" alt="BSI"></div>
            <div class="pay-wrap"><img src="{{ asset('assets/img/gopay.png') }}" alt="GoPay"></div>
            <div class="pay-wrap"><img src="{{ asset('assets/img/ovo.png') }}" alt="OVO"></div>
            <div class="pay-wrap"><img src="{{ asset('assets/img/dana.png') }}" alt="DANA"></div>
            <div class="pay-wrap"><img src="{{ asset('assets/img/spay.png') }}" alt="ShopeePay"></div>
          </div>
          <p>Guarantee safe &amp; secure checkout</p>
        </div>

      </div>
    </div>

    <!-- TAB -->
    <div class="pd-tabs-wrap">
      <div class="pd-tabs" id="tabs">
        <button class="on" data-tab="desc">Description</button>
        <button data-tab="info">Additional Information</button>
        <button data-tab="rev">Reviews [{{ $reviews->count() }}]</button>
      </div>

      <!-- Description -->
      <div class="pd-panel on" id="tab-desc">
        <h3>{{ $pName }}</h3>
        <p style="white-space: pre-line;">{{ $pDesc }}</p>
      </div>

      <!-- Additional Information -->
      <div class="pd-panel" id="tab-info">
        <p style="white-space: pre-line;">{{ $pInfo }}</p>
      </div>

      <!-- Reviews -->
      <div class="pd-panel" id="tab-rev">
        <div class="rv-head">Reviews <span class="badge">{{ $reviews->count() }}</span></div>

        @forelse($reviews as $review)
        @php $rvAvatar = $review->user_avatar ? asset($review->user_avatar) : asset('assets/img/zarabelbg.png'); @endphp
        <div class="rv">
          <div class="av"><img src="{{ $rvAvatar }}" alt="{{ $review->user_name }}"></div>
          <div>
            <div class="top">
              <div><div class="name">{{ $review->user_name }}</div><div class="role">{{ $review->user_role ?? 'Customer' }}</div></div>
              <div class="meta"><div class="date">{{ $review->created_at->format('d F Y') }}</div><div class="stars">{{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}</div></div>
            </div>
            <p>{{ $review->comment }}</p>
          </div>
        </div>
        @empty
        <p style="color:#888; text-align:center; padding:20px;">Belum ada ulasan untuk produk ini.</p>
        @endforelse

        <button type="button" class="show-all">Show All</button>
      </div>
    </div>
  </section>

  <!-- ================= FOOTER ================= -->
  @include('partials.footer')

</main>

<div class="toast" id="toast" role="status"></div>

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

  // Ganti foto utama lewat thumbnail
  var mainPhoto = document.getElementById('mainPhoto');
  var thumbs = Array.prototype.slice.call(document.querySelectorAll('#thumbs button'));
  thumbs.forEach(function(t){
    t.addEventListener('click', function(){
      mainPhoto.src = t.dataset.src;
      thumbs.forEach(function(x){ x.classList.toggle('on', x === t); });
    });
  });

  // Pilih ukuran
  var sizes = Array.prototype.slice.call(document.querySelectorAll('#sizes button:not([disabled])'));
  sizes.forEach(function(s){
    s.addEventListener('click', function(){
      sizes.forEach(function(x){ x.classList.toggle('on', x === s); });
    });
  });

  // Quantity (maks 9 sesuai stok)
  var qty = document.getElementById('qty');
  document.getElementById('qPlus').addEventListener('click', function(){
    qty.textContent = Math.min(9, Number(qty.textContent) + 1);
  });
  document.getElementById('qMinus').addEventListener('click', function(){
    qty.textContent = Math.max(1, Number(qty.textContent) - 1);
  });

  // Add to cart + terbang ke ikon keranjang & buka minicart
  var toast = document.getElementById('toast');
  var timer;
  document.getElementById('addBtn').addEventListener('click', function(){
    var size = document.querySelector('#sizes button.on');
    var selectedSize = size ? size.textContent.toUpperCase() : 'M';
    var quantity = Number(qty.textContent) || 1;
    var currentPhoto = document.getElementById('mainPhoto');

    var cartItem = {
      id: '{{ $product->id ?? "prod-1" }}',
      code: '{{ $product->code ?? "ZRB-PROD" }}',
      nama: '{{ addslashes($pName) }}',
      harga: {{ (int)($product->price ?? 100000) }},
      qty: quantity,
      img: currentPhoto ? currentPhoto.src : '{{ asset($product->main_image ?? "assets/img/bg35.png") }}',
      size: selectedSize
    };

    if (window.ZarabelCart) {
      window.ZarabelCart.add(cartItem, currentPhoto || document.getElementById('addBtn'));
    } else {
      var currentCart = [];
      try { currentCart = JSON.parse(localStorage.getItem('cart') || '[]'); } catch(e){}
      var existing = currentCart.find(function(x){ return x.id == cartItem.id && x.size == cartItem.size; });
      if (existing) {
        existing.qty += quantity;
      } else {
        currentCart.push(cartItem);
      }
      localStorage.setItem('cart', JSON.stringify(currentCart));

      toast.textContent = quantity + ' x ' + '{{ addslashes($pName) }}' + ' (' + selectedSize + ') added to cart';
      toast.classList.add('show');
      clearTimeout(timer);
      timer = setTimeout(function(){ toast.classList.remove('show'); }, 2200);
    }
  });

  // Tab: Description / Additional Information / Reviews
  var tabBtns = Array.prototype.slice.call(document.querySelectorAll('#tabs button'));
  tabBtns.forEach(function(b){
    b.addEventListener('click', function(){
      tabBtns.forEach(function(x){ x.classList.toggle('on', x === b); });
      document.querySelectorAll('.pd-panel').forEach(function(p){
        p.classList.toggle('on', p.id === 'tab-' + b.dataset.tab);
      });
    });
  });

  // Direct Checkout button
  document.getElementById('directCheckoutBtn').addEventListener('click', function(){
    var size = document.querySelector('#sizes button.on');
    var selectedSize = size ? size.textContent.toUpperCase() : 'M';
    var quantity = Number(qty.textContent) || 1;
    var currentPhoto = document.getElementById('mainPhoto');

    var cartItem = {
      id: '{{ $product->id ?? "prod-1" }}',
      code: '{{ $product->code ?? "ZRB-PROD" }}',
      nama: '{{ addslashes($pName) }}',
      harga: {{ (int)($product->price ?? 100000) }},
      qty: quantity,
      img: currentPhoto ? currentPhoto.src : '{{ asset($product->main_image ?? "assets/img/bg35.png") }}',
      size: selectedSize
    };

    var currentCart = [];
    try { currentCart = JSON.parse(localStorage.getItem('cart') || '[]'); } catch(e){}
    var existing = currentCart.find(function(x){ return x.id == cartItem.id && x.size == cartItem.size; });
    if (existing) {
      existing.qty += quantity;
    } else {
      currentCart.push(cartItem);
    }
    localStorage.setItem('cart', JSON.stringify(currentCart));
    window.location.href = "{{ route('checkout') }}";
  });
</script>
<script src="{{ asset('js/minicart.js') }}"></script>

</body>
</html>



