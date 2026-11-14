<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Zarabel — Member Home</title>

<link rel="icon" type="image/png" href="{{ asset('assets/img/zarabelbg.png') }}">
<link rel="apple-touch-icon" href="{{ asset('assets/img/zarabelbg.png') }}">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Montserrat:wght@400;700&family=Playfair+Display:wght@400;500&family=Poppins:wght@400;500;600;700&family=Volkhov&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<link rel="stylesheet" href="{{ asset('css/minicart.css') }}">
</head>
<body>

<!-- ===== Ikon SVG (dipakai berulang lewat <use>) ===== -->
@include('partials.svg-icons')

<main>

  <!-- ================= HEADER ================= -->
  @include('partials.header-user', ['active' => 'home'])

  <!-- ================= HERO ================= -->
  <section id="home" class="hero">
    <img class="hero-image" src="{{ asset('assets/img/hero2.jpeg') }}" alt="Woman wearing Zarabel modest fashion">
    <div class="hero-copy">
      <p>made in Indonesia, dedicated to Indonesia</p>
      <h1>Artistic Printed Wonderful Indonesian Textile Design</h1>
    </div>
    <div class="customer-stack" aria-label="23,000 plus customers">
      <div>
        <img src="{{ asset('assets/img/model1.png') }}" alt="">
        <img src="{{ asset('assets/img/model2.png') }}" alt="">
        <img src="{{ asset('assets/img/model3.png') }}" alt="">
      </div>
      <strong>23000+</strong>
      <span>our customers</span>
    </div>
    <button class="scroll-down" data-scroll="categories">
      scroll down <svg class="ic"><use href="#i-chev2"/></svg>
    </button>
  </section>

  <!-- ================= MARQUEE ================= -->
  <div class="marquee" aria-label="Product categories">
    <div>
      <span>Pleats</span><span>Pashmina</span><span>Shirt</span><span>Outer</span><span>Dress</span><span>Pleats</span><span>Pashmina</span>
      <span>Pleats</span><span>Pashmina</span><span>Shirt</span><span>Outer</span><span>Dress</span><span>Pleats</span><span>Pashmina</span>
    </div>
  </div>

  <!-- ================= CATEGORY ================= -->
  <section id="categories" class="category-section section-pad">
    <h2>Explore<br>Our Category</h2>
    <div class="category-grid">
      <button class="category-card" onclick="location.href='{{ route('catalog') }}?cat=Pleats'"><img src="{{ asset('assets/img/cat1.jpg') }}" alt="Pleats collection"><span>Pleats</span></button>
      <button class="category-card" onclick="location.href='{{ route('catalog') }}?cat=Pashmina'"><img src="{{ asset('assets/img/cat2.jpg') }}" alt="Pashmina collection"><span>Pashmina</span></button>
      <button class="category-card" onclick="location.href='{{ route('catalog') }}?cat=Shirt'"><img src="{{ asset('assets/img/cat3.jpg') }}" alt="Shirt collection"><span>Shirt</span></button>
      <button class="category-card category-wide" onclick="location.href='{{ route('catalog') }}?cat=Outer'"><img src="{{ asset('assets/img/cat4.jpg') }}" alt="Outer collection"><span>Outer</span></button>
      <button class="category-card" onclick="location.href='{{ route('catalog') }}?cat=Dress'"><img src="{{ asset('assets/img/cat5.jpg') }}" alt="Dress collection"><span>Dress</span></button>
    </div>
  </section>

  <!-- ================= VIDEO ================= -->
  <section class="video-section section-pad">
    <div class="video-frame" id="videoFrame" style="position:relative; overflow:hidden;">
      <img id="videoPoster" src="{{ asset('assets/img/prodkirana1.jpeg') }}" alt="Zarabel collection video cover">
      
      <video id="zarabelVideo" controls preload="metadata" style="display:none; position:absolute; inset:0; width:100%; height:100%; object-fit:cover; z-index:3; background:#000;">
        <source src="{{ asset('assets/video/zarabelvid.mp4') }}" type="video/mp4">
        Browser Anda tidak mendukung pemutar video HTML5.
      </video>

      <button class="play-button" id="playBtn" style="z-index:4;">
        <svg class="ic"><use href="#i-play"/></svg>
        <span>Play videos</span>
      </button>

      <button id="closeVideo" aria-label="Close video" style="display:none; position:absolute; top:20px; right:25px; z-index:6; background:rgba(0,0,0,0.6); color:#fff; border:1px solid rgba(255,255,255,0.4); border-radius:30px; padding:8px 18px; font-size:14px; font-weight:600; cursor:pointer; letter-spacing:1px; text-transform:uppercase; transition:all 0.2s;">
        ✕ Close Video
      </button>
    </div>
  </section>

  <!-- ================= PRODUCTS ================= -->
  <div id="new-arrivals">
    @php
      $dressProducts = $products->take(4);
      $outfitProducts = $products->slice(4)->take(4);
      if ($outfitProducts->isEmpty()) {
          $outfitProducts = $products->take(4);
      }
    @endphp

    <section class="products section-pad">
      <h2>the best dress for the best woman</h2>
      <div class="product-grid">
        @foreach($dressProducts as $prod)
          @php
            $imgUrl = Str::startsWith($prod->main_image, ["http://", "https://", "assets/", "storage/", "uploads/"]) ? asset($prod->main_image) : asset("assets/img/cat1.jpg");
            $discountPrice = $prod->discount_price ? 'IDR ' . number_format($prod->discount_price, 0, ',', '.') : 'IDR ' . number_format($prod->price * 1.25, 0, ',', '.');
          @endphp
          <article class="product-card">
            <button class="product-image add-cart" aria-label="Add {{ $prod->name }} to cart" onclick="location.href='{{ route('product', $prod->code) }}'">
              <img src="{{ $imgUrl }}" alt="{{ $prod->name }}" style="object-fit:cover;">
              <span class="rating"><svg class="ic"><use href="#i-star"/></svg> {{ number_format($prod->rating ?? 4.95, 2) }}</span>
              <span class="quick-add">View Product</span>
            </button>
            <p class="product-category">{{ $prod->category_name }}</p>
            <h3 onclick="location.href='{{ route('product', $prod->code) }}'" style="cursor:pointer;">{{ $prod->name }}</h3>
            <p class="price">IDR {{ number_format($prod->price, 0, ',', '.') }} <span>{{ $discountPrice }}</span></p>
          </article>
        @endforeach
      </div>
    </section>

    <section class="products section-pad">
      <h2>Best outfit for your happiness</h2>
      <div class="product-grid">
        @foreach($outfitProducts as $prod)
          @php
            $imgUrl = Str::startsWith($prod->main_image, ["http://", "https://", "assets/", "storage/", "uploads/"]) ? asset($prod->main_image) : asset("assets/img/cat1.jpg");
            $discountPrice = $prod->discount_price ? 'IDR ' . number_format($prod->discount_price, 0, ',', '.') : 'IDR ' . number_format($prod->price * 1.25, 0, ',', '.');
          @endphp
          <article class="product-card">
            <button class="product-image add-cart" aria-label="Add {{ $prod->name }} to cart" onclick="location.href='{{ route('product', $prod->code) }}'">
              <img src="{{ $imgUrl }}" alt="{{ $prod->name }}" style="object-fit:cover;">
              <span class="rating"><svg class="ic"><use href="#i-star"/></svg> {{ number_format($prod->rating ?? 4.95, 2) }}</span>
              <span class="quick-add">View Product</span>
            </button>
            <p class="product-category">{{ $prod->category_name }}</p>
            <h3 onclick="location.href='{{ route('product', $prod->code) }}'" style="cursor:pointer;">{{ $prod->name }}</h3>
            <p class="price">IDR {{ number_format($prod->price, 0, ',', '.') }} <span>{{ $discountPrice }}</span></p>
          </article>
        @endforeach
      </div>
    </section>
  </div>

  <!-- ================= EVENTS ================= -->
  <section class="events section-pad">
    <img class="events-bg" src="{{ asset('assets/img/bg1.jpg') }}" alt="">
    <div class="events-overlay"></div>
    <div class="events-copy">
      <h2>Up coming event</h2>
      <p>Here are some of the events that are<br>and things to come</p>
    </div>
    <div class="event-grid">
      <button class="event-card">
        <img src="{{ asset('assets/img/bg2.png') }}" alt="">
        <span class="event-shade"></span>
        <span class="event-info">
          <svg class="ic"><use href="#i-cal"/></svg>
          <strong>New Product</strong>
          <small>Wednesday, 11 November 2026</small>
          <b>See all</b>
        </span>
      </button>
      <button class="event-card">
        <img src="{{ asset('assets/img/bg3.jpg') }}" alt="">
        <span class="event-shade"></span>
        <span class="event-info">
          <svg class="ic"><use href="#i-cal"/></svg>
          <strong>WIBAWA Demo Day</strong>
          <small>Monday – Tuesday, 16 – 17 November 2026</small>
          <b>See all</b>
        </span>
      </button>
      <button class="event-card">
        <img src="{{ asset('assets/img/bg4.png') }}" alt="">
        <span class="event-shade"></span>
        <span class="event-info">
          <svg class="ic"><use href="#i-cal"/></svg>
          <strong>Blog</strong>
          <small>Coming soon</small>
          <b>See all</b>
        </span>
      </button>
    </div>
  </section>

  <!-- ================= SERVICES ================= -->
  <section class="services section-pad" aria-label="Our services">
    <article>
      <span class="service-icon"><svg class="ic"><use href="#i-thumb"/></svg></span>
      <div>
        <h3>100% Satisfaction Guaranteed</h3>
        <p>Setiap produk ZARABEL diproduksi dengan standar kualitas terjaga. Jika ada kendala pada pesananmu, tim kami siap membantu proses komplain dan retur dengan mudah.</p>
      </div>
    </article>
    <article>
      <span class="service-icon"><svg class="ic"><use href="#i-phone"/></svg></span>
      <div>
        <h3>24/7 Online Service</h3>
        <p>Punya pertanyaan seputar produk, ukuran, atau pengiriman? Hubungi kami kapan saja melalui WhatsApp dan media sosial, kami siap merespons dengan cepat.</p>
      </div>
    </article>
    <article>
      <span class="service-icon"><svg class="ic"><use href="#i-rocket"/></svg></span>
      <div>
        <h3>Fast Delivery</h3>
        <p>Pesanan diproses dan dikirim secara cepat setelah pembayaran dikonfirmasi, agar koleksi limited edition favoritmu sampai tepat waktu.</p>
      </div>
    </article>
    <article>
      <span class="service-icon"><svg class="ic"><use href="#i-card"/></svg></span>
      <div>
        <h3>Payment With Secure System</h3>
        <p>Nikmati kemudahan bertransaksi melalui berbagai metode pembayaran yang aman dan terpercaya di Shopee, TikTok Shop, dan platform resmi ZARABEL lainnya.</p>
      </div>
    </article>
  </section>

  <!-- ================= TESTIMONIALS ================= -->
  <section class="testimonials">
    <div class="testimonial-heading">
      <h2>This Is What Our Customers Say</h2>
      <p>Ratusan wanita telah mempercayakan ZARABEL sebagai pilihan fashion artistik favorit mereka, orisinal, eksklusif, &amp; berkualitas.</p>
    </div>

    <div class="testimonial-stage" id="stage">
      @if(isset($reviews) && $reviews->count() > 0)
        @foreach($reviews as $rev)
        @php
          $avatarRev = !empty($rev->user_avatar)
            ? (filter_var($rev->user_avatar, FILTER_VALIDATE_URL) ? $rev->user_avatar : asset($rev->user_avatar))
            : asset('assets/img/testi1.png');
        @endphp
        <article class="testimonial-card">
          <div class="portrait"><img src="{{ $avatarRev }}" alt="{{ $rev->user_name }}"></div>
          <div>
            <p>“{{ $rev->comment }}”</p>
            <div style="color:#C18A2D; font-size:18px; margin:8px 0; letter-spacing:2px;">
              @for($s = 1; $s <= 5; $s++)
                {{ $s <= $rev->rating ? '★' : '☆' }}
              @endfor
            </div>
            <hr>
            <h3>{{ $rev->user_name }}</h3>
            <small>{{ $rev->user_role }}</small>
          </div>
        </article>
        @endforeach
      @else
        <article class="testimonial-card">
          <div class="portrait"><img src="{{ asset('assets/img/testi1.png') }}" alt="Suzan B."></div>
          <div>
            <p>“Items That I ordered were the best investment I ever made. I can’t say enough about your quality service.”</p>
            <svg class="stars"><use href="#i-stars"/></svg>
            <hr>
            <h3>Suzan B.</h3>
            <small>UI Designer</small>
          </div>
        </article>
        <article class="testimonial-card">
          <div class="portrait"><img src="{{ asset('assets/img/testi1.png') }}" alt="James C."></div>
          <div>
            <p>“Motifnya beda dari yang lain, bener-bener kerasa eksklusif. Bahan ceruti-nya juga adem dan nyaman dipakai seharian.”</p>
            <svg class="stars"><use href="#i-stars"/></svg>
            <hr>
            <h3>James C.</h3>
            <small>Mahasiswa</small>
          </div>
        </article>
        <article class="testimonial-card">
          <div class="portrait"><img src="{{ asset('assets/img/testi1.png') }}" alt="Megen W."></div>
          <div>
            <p>“Just what I was looking for. Thank you for making it painless, pleasant and most of all hassle free!”</p>
            <svg class="stars"><use href="#i-stars"/></svg>
            <hr>
            <h3>Megen W.</h3>
            <small>UI Designer</small>
          </div>
        </article>
      @endif
    </div>

    <div class="testimonial-controls">
      <button id="prevT" aria-label="Previous testimonial"><svg class="ic"><use href="#i-arrow"/></svg></button>
      <button id="nextT" aria-label="Next testimonial"><svg class="ic"><use href="#i-arrow"/></svg></button>
    </div>
  </section>

  <!-- ================= FOOTER ================= -->
  @include('partials.footer')

  <!-- Floating Action Button: Review Modal -->
  @auth
  <div class="floating-actions" style="position:fixed; right:30px; bottom:35px; z-index:998;">
    <button class="floating-btn" onclick="openReviewModal()" style="width:56px; height:56px; background:#69481B; border:none; border-radius:50%; box-shadow:0 6px 20px rgba(105,72,27,0.4); display:flex; align-items:center; justify-content:center; cursor:pointer; transition:transform 0.2s, background 0.2s;" onmouseover="this.style.transform='scale(1.08)'" onmouseout="this.style.transform='scale(1)'" title="Beri Ulasan ZARABEL">
      <!-- Icon Chat / Bubble SVG -->
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/>
      </svg>
    </button>
  </div>

  <!-- Review Website Modal -->
  <div id="reviewModal" onclick="if(event.target===this)closeReviewModal()" style="display:none; position:fixed; inset:0; z-index:9999; background:rgba(40,28,15,0.6); backdrop-filter:blur(6px); align-items:center; justify-content:center; padding:20px;">
    <div style="width:100%; max-width:540px; max-height:90vh; overflow-y:auto; background:#FEF7EE; border-radius:24px; padding:36px 32px 30px; box-shadow:0 24px 60px rgba(0,0,0,0.25); position:relative; font-family:'Plus Jakarta Sans',sans-serif;">
      
      <button type="button" onclick="closeReviewModal()" style="position:absolute; right:20px; top:20px; width:36px; height:36px; border-radius:50%; border:none; background:#E5DDD2; color:#69481B; font-size:18px; font-weight:bold; cursor:pointer; display:flex; align-items:center; justify-content:center;">✕</button>

      <h2 style="color:#201504; font-family:'Abhaya Libre',serif; font-size:28px; font-weight:800; margin:0 0 8px;">Beri Ulasan untuk Website</h2>
      <p style="color:#6B5D4F; font-size:14px; margin:0 0 24px; line-height:1.5;">Bagikan pengalaman belanja Anda bersama Zarabel.</p>

      <form method="POST" action="{{ route('review-web.store') }}" id="webReviewFormModal">
        @csrf
        <div style="margin-bottom:20px;">
          <label style="display:block; font-size:13px; font-weight:700; color:#201504; margin-bottom:8px; text-transform:uppercase; letter-spacing:0.5px;">Rating Anda</label>
          <div id="ratingStarsModal" style="font-size:32px; color:#C18A2D; cursor:pointer; user-select:none; display:inline-flex; gap:6px;">
            <span data-val="1">★</span>
            <span data-val="2">★</span>
            <span data-val="3">★</span>
            <span data-val="4">★</span>
            <span data-val="5">★</span>
          </div>
          <input type="hidden" name="rating" id="ratingInputModal" value="5">
        </div>

        <div style="margin-bottom:24px;">
          <label style="display:block; font-size:13px; font-weight:700; color:#201504; margin-bottom:8px; text-transform:uppercase; letter-spacing:0.5px;">Ulasan Anda</label>
          <textarea name="ulasan" required placeholder="Tulis ulasanmu tentang website, produk, atau pelayanan kami di sini..." style="width:100%; box-sizing:border-box; height:120px; border-radius:14px; border:1.5px solid #D9CBB8; background:#fff; padding:14px 16px; font-family:inherit; font-size:14px; color:#201504; resize:vertical; outline:none; transition:border 0.2s;" onfocus="this.style.borderColor='#69481B'" onblur="this.style.borderColor='#D9CBB8'">{{ old('ulasan') }}</textarea>
        </div>

        <div style="display:flex; justify-content:flex-end; gap:12px;">
          <button type="button" onclick="closeReviewModal()" style="padding:12px 22px; border-radius:10px; border:1.5px solid #D9CBB8; background:transparent; font-family:inherit; font-size:14px; font-weight:700; color:#69481B; cursor:pointer;">Batal</button>
          <button type="submit" style="padding:12px 30px; border-radius:10px; border:none; background:#69481B; font-family:inherit; font-size:14px; font-weight:700; color:#fff; cursor:pointer; box-shadow:0 4px 14px rgba(105,72,27,0.35);">Kirim Ulasan</button>
        </div>
      </form>
    </div>
  </div>
  @endauth

</main>

<script>
  // Modal Review
  function openReviewModal() {
    var m = document.getElementById('reviewModal');
    if (m) { m.style.display = 'flex'; document.body.style.overflow = 'hidden'; }
  }

  function closeReviewModal() {
    var m = document.getElementById('reviewModal');
    if (m) { m.style.display = 'none'; document.body.style.overflow = ''; }
  }

  (function () {
    var wrap = document.getElementById('ratingStarsModal');
    var input = document.getElementById('ratingInputModal');
    if (!wrap || !input) return;
    var stars = wrap.querySelectorAll('span');
    var paint = function(val){
      stars.forEach(function(s){
        s.textContent = (Number(s.dataset.val) <= val) ? '★' : '☆';
      });
    };
    stars.forEach(function(s){
      s.addEventListener('click', function(){
        input.value = s.dataset.val;
        paint(Number(s.dataset.val));
      });
      s.addEventListener('mouseenter', function(){
        paint(Number(s.dataset.val));
      });
    });
    wrap.addEventListener('mouseleave', function(){
      paint(Number(input.value));
    });
  })();

  // Scroll halus ke section (semua tombol ber-atribut data-scroll)
  document.querySelectorAll('[data-scroll]').forEach(function(btn){
    btn.addEventListener('click', function(){
      var el = document.getElementById(btn.dataset.scroll);
      if (el) el.scrollIntoView({ behavior: 'smooth' });
      var navEl = document.getElementById('mainNav');
      if (navEl) navEl.classList.remove('open');
      var menuEl = document.getElementById('catalogMenu');
      if (menuEl) menuEl.classList.remove('open');
    });
  });

  // Menu HP
  var nav = document.getElementById('mainNav');
  var toggle = document.getElementById('menuToggle');
  if (nav && toggle) {
    toggle.addEventListener('click', function(){
      var open = nav.classList.toggle('open');
      toggle.setAttribute('aria-expanded', open);
    });
  }

  // Dropdown Catalog (hanya jika ada di header)
  var catalogMenu = document.getElementById('catalogMenu');
  var catalogBtn = document.getElementById('catalogBtn');
  if (catalogMenu && catalogBtn) {
    catalogBtn.addEventListener('click', function(){
      var open = catalogMenu.classList.toggle('open');
      catalogBtn.setAttribute('aria-expanded', open);
    });
  }

  // Video Player Control
  var videoFrame = document.getElementById('videoFrame');
  var videoEl = document.getElementById('zarabelVideo');
  var playBtn = document.getElementById('playBtn');
  var closeBtn = document.getElementById('closeVideo');

  if (playBtn && videoEl) {
    playBtn.addEventListener('click', function(){
      videoFrame.classList.add('playing');
      videoEl.style.display = 'block';
      if (closeBtn) closeBtn.style.display = 'block';
      playBtn.style.display = 'none';
      videoEl.play();
    });
  }

  if (closeBtn && videoEl) {
    closeBtn.addEventListener('click', function(){
      videoEl.pause();
      videoEl.currentTime = 0;
      videoEl.style.display = 'none';
      closeBtn.style.display = 'none';
      if (playBtn) playBtn.style.display = 'flex';
      videoFrame.classList.remove('playing');
    });
  }

  // Jika video selesai diputar otomatis munculkan kembali tombol play
  if (videoEl) {
    videoEl.addEventListener('ended', function(){
      videoEl.style.display = 'none';
      if (closeBtn) closeBtn.style.display = 'none';
      if (playBtn) playBtn.style.display = 'flex';
      videoFrame.classList.remove('playing');
    });
  }

  // Testimonial carousel
  var cards = Array.prototype.slice.call(document.querySelectorAll('.testimonial-card'));
  var current = 1;
  function renderTestimonials(){
    cards.forEach(function(card, i){
      var offset = (i - current + cards.length) % cards.length;
      card.classList.remove('active', 'left', 'right');
      card.classList.add(offset === 0 ? 'active' : offset === 1 ? 'right' : 'left');
    });
  }
  document.getElementById('prevT').addEventListener('click', function(){
    current = (current - 1 + cards.length) % cards.length; renderTestimonials();
  });
  document.getElementById('nextT').addEventListener('click', function(){
    current = (current + 1) % cards.length; renderTestimonials();
  });
  renderTestimonials();
</script>

<script src="{{ asset('js/minicart.js') }}"></script>

</body>
</html>
