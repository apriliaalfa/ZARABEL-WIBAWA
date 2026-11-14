<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Zarabel — Home</title>

<link rel="icon" type="image/png" href="{{ asset('assets/img/zarabelbg.png') }}">
<link rel="apple-touch-icon" href="{{ asset('assets/img/zarabelbg.png') }}">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Montserrat:wght@400;700&family=Playfair+Display:wght@400;500&family=Poppins:wght@400;500;600;700&family=Volkhov&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>
<body>

<!-- ===== Ikon SVG (dipakai berulang lewat <use>) ===== -->
@include('partials.svg-icons')

<main>

  <!-- ================= HEADER ================= -->
  <header class="site-header">
    <a class="brand" href="{{ route('homepage1') }}" aria-label="Zarabel home">
      <img src="{{ asset('assets/img/zarabelbg.png') }}" alt="">
      <span>arabel</span>
    </a>

    <button class="menu-toggle" id="menuToggle" aria-label="Toggle navigation" aria-expanded="false">
      <span></span><span></span>
    </button>

    <nav id="mainNav" aria-label="Main navigation">
      <button class="active" onclick="location.href='{{ route('homepage1') }}'">Home</button>
      <button onclick="location.href='{{ route('catalog') }}'">Catalog</button>
      <button onclick="location.href='{{ route('catalog') }}'">New Arrival</button>
      <button onclick="location.href='{{ route('about') }}'">About Us</button>
    </nav>

    <div class="header-actions">
      <button class="icon-btn" aria-label="Search"><svg class="ic"><use href="#i-search"/></svg></button>
      <a href="{{ route('cart') }}" class="icon-btn" aria-label="Cart"><svg class="ic"><use href="#i-cart"/></svg></a>
      @auth
        @if(Auth::user()->role === 'admin')
          <a class="sign-up" href="{{ route('admin.dashboard') }}">Admin Panel</a>
        @else
          <a class="sign-up" href="{{ route('homepage2') }}">My Account</a>
        @endif
      @else
        <a class="sign-in" href="{{ route('login') }}">Sign in</a>
        <a class="sign-up" href="{{ route('register') }}">Sign Up</a>
      @endauth
    </div>
  </header>

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

</main>

<script>
  // Scroll halus ke section (semua tombol ber-atribut data-scroll)
  document.querySelectorAll('[data-scroll]').forEach(function(btn){
    btn.addEventListener('click', function(){
      var el = document.getElementById(btn.dataset.scroll);
      if (el) el.scrollIntoView({ behavior: 'smooth' });
      document.getElementById('mainNav').classList.remove('open');
    });
  });

  // Menu HP
  var nav = document.getElementById('mainNav');
  var toggle = document.getElementById('menuToggle');
  toggle.addEventListener('click', function(){
    var open = nav.classList.toggle('open');
    toggle.setAttribute('aria-expanded', open);
  });

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

</body>
</html>
