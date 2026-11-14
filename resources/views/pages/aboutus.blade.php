<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Zarabel — About Us</title>

<link rel="icon" type="image/png" href="{{ asset('assets/img/zarabelbg.png') }}">
<link rel="apple-touch-icon" href="{{ asset('assets/img/zarabelbg.png') }}">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400&family=Lato:wght@400;500;700&family=Montserrat:wght@400;500;600;700&family=Playfair+Display:wght@400;500&family=Poppins:wght@300;400;500;600;700&family=Volkhov&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/css/home.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/catalog.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/about.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/minicart.css') }}">
</head>
<body>

@include('partials.svg-icons')

<main>

  <!-- ================= HEADER ================= -->
  @include('partials.header-user', ['active' => 'about'])

  <!-- ================= ABOUT ================= -->
  <section class="ab-intro ab-wrap" id="aboutSection">
    <div class="ab-title">
      <h1>About ZARABEL</h1>
      <p>Artistic printed fashion with original Indonesian textile designs, made in limited editions.</p>
    </div>

    <div class="ab-story">
      <div>
        <h2>We Are</h2>
        <p><strong>An artistic printed fashion brand that turns the beauty of Indonesian nature and culture into original textile designs.</strong></p>
        <p>Every ZARABEL motif is illustrated in-house, inspired by places like Raja Ampat and Labuan Bajo, and printed with digital textile printing. Each collection is produced in limited quantities, so what you wear stays exclusive. From printed pashminas to tops, outer, and dresses, we design for women who want to look elegant and feel comfortable.</p>
      </div>
      <!-- GANTI GAMBAR: file assets/img/about-showroom.png -->
      <div class="ab-story-img"><img src="{{ asset('assets/img/hero2.jpeg') }}" alt="ZARABEL printed collection"></div>
    </div>

    <div class="ab-stats">
      <div class="ab-stat"><span class="ab-stat-no">1</span><span class="ab-stat-lbl">Pieces Sold</span><strong>147+</strong></div>
      <div class="ab-stat"><span class="ab-stat-no">2</span><span class="ab-stat-lbl">Instagram Followers</span><strong>1.6K+</strong></div>
      <div class="ab-stat"><span class="ab-stat-no">3</span><span class="ab-stat-lbl">Marketplaces</span><strong>2</strong></div>
    </div>
  </section>

  <!-- ================= GALLERY ================= -->
  <!-- GANTI GAMBAR: tiap tombol punya DUA path (data-full + src), ubah keduanya -->
  <section class="ab-gallery" id="gallery">
    <div class="ab-wrap">
      <h2 class="ab-display">Our Gallery</h2>
      <div class="ab-grid">
        <button class="g1" type="button" data-full="{{ asset('assets/img/ourgal1.jpeg') }}" data-alt="Zarabel model wearing a brown hijab" aria-label="Enlarge: Zarabel model wearing a brown hijab"><img src="{{ asset('assets/img/ourgal1.jpeg') }}" alt="Zarabel model wearing a brown hijab"><span>View image</span></button>
        <button class="g2" type="button" data-full="{{ asset('assets/img/ourgal2.jpeg') }}" data-alt="Detail of a Zarabel garment" aria-label="Enlarge: Detail of a Zarabel garment"><img src="{{ asset('assets/img/ourgal2.jpeg') }}" alt="Detail of a Zarabel garment"><span>View image</span></button>
        <button class="g3" type="button" data-full="{{ asset('assets/img/ourgal3.jpeg') }}" data-alt="Zarabel model wearing a rose hijab" aria-label="Enlarge: Zarabel model wearing a rose hijab"><img src="{{ asset('assets/img/ourgal3.jpeg') }}" alt="Zarabel model wearing a rose hijab"><span>View image</span></button>
        <button class="g4" type="button" data-full="{{ asset('assets/img/ourgal4.jpeg') }}" data-alt="Zarabel model in the woods" aria-label="Enlarge: Zarabel model in the woods"><img src="{{ asset('assets/img/ourgal4.jpeg') }}" alt="Zarabel model in the woods"><span>View image</span></button>
        <button class="g5" type="button" data-full="{{ asset('assets/img/ourgal5.jpeg') }}" data-alt="Zarabel model in a taupe hijab" aria-label="Enlarge: Zarabel model in a taupe hijab"><img src="{{ asset('assets/img/ourgal5.jpeg') }}" alt="Zarabel model in a taupe hijab"><span>View image</span></button>
        <button class="g6" type="button" data-full="{{ asset('assets/img/ourgal6.jpeg') }}" data-alt="Portrait of a Zarabel model" aria-label="Enlarge: Portrait of a Zarabel model"><img src="{{ asset('assets/img/ourgal6.jpeg') }}" alt="Portrait of a Zarabel model"><span>View image</span></button>
      </div>
    </div>
  </section>

  <!-- ================= EVENTS ================= -->
  <!-- GANTI GAMBAR: bg1.jpg (background), bg2.png / bg3.jpg / bg4.png (3 kartu) -->
  <section class="events section-pad" id="events">
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
  <section class="ab-services ab-wrap" aria-label="Our services">
      <article class="ab-service">
        <span class="ab-service-icon"><svg><use href="#i-thumb"/></svg></span>
        <div><h3>100% Satisfaction Guaranteed</h3><p>Setiap produk ZARABEL diproduksi dengan standar kualitas terjaga. Jika ada kendala pada pesananmu, tim kami siap membantu proses komplain dan retur dengan mudah.</p></div>
      </article>
      <article class="ab-service">
        <span class="ab-service-icon"><svg><use href="#i-phone-w"/></svg></span>
        <div><h3>24/7 Online Service</h3><p>Punya pertanyaan seputar produk, ukuran, atau pengiriman? Hubungi kami kapan saja melalui WhatsApp dan media sosial, kami siap merespons dengan cepat.</p></div>
      </article>
      <article class="ab-service">
        <span class="ab-service-icon"><svg><use href="#i-rocket"/></svg></span>
        <div><h3>Fast Delivery</h3><p>Pesanan diproses dan dikirim secara cepat setelah pembayaran dikonfirmasi, agar koleksi limited edition favoritmu sampai tepat waktu.</p></div>
      </article>
      <article class="ab-service">
        <span class="ab-service-icon"><svg><use href="#i-card-w"/></svg></span>
        <div><h3>Payment With Secure System</h3><p>Nikmati kemudahan bertransaksi melalui berbagai metode pembayaran yang aman dan terpercaya di Shopee, TikTok Shop, dan platform resmi ZARABEL lainnya.</p></div>
      </article>
  </section>

  <!-- ================= TEAM ================= -->
  <!-- GANTI GAMBAR: assets/img/team-1.jpg ... team-6.jpg (urutan sama dengan kartu) -->
  <section class="ab-team" id="team">
    <div class="ab-wrap">
      <h2 class="ab-display">Meet Our Team</h2>
      <div class="ab-team-grid">

        <article class="ab-member">
          <div class="ab-member-photo"><img src="{{ asset('assets/img/abtzahra.jpeg') }}" alt="Sukriya Azzahra Fatimah" onerror="this.src='{{ asset('assets/img/model1.png') }}'"></div>
          <h3>Sukriya Azzahra Fatimah</h3>
          <p>Head of Product Development</p>
        </article>

        <article class="ab-member">
          <div class="ab-member-photo"><img src="{{ asset('assets/img/abthamid.jpeg') }}" alt="Hamid Abdur Rohim" onerror="this.src='{{ asset('assets/img/model2.png') }}'"></div>
          <h3>Hamid Abdur Rohim</h3>
          <p>Finance &amp; Administration</p>
        </article>

        <article class="ab-member">
          <div class="ab-member-photo"><img src="{{ asset('assets/img/abtanisa.jpeg') }}" alt="Anisa Devina Maharani" onerror="this.src='{{ asset('assets/img/model3.png') }}'"></div>
          <h3>Anisa Devina Maharani</h3>
          <p>Marketplace &amp; Digital System Manager</p>
        </article>

        <article class="ab-member">
          <div class="ab-member-photo"><img src="{{ asset('assets/img/abttsania.jpeg') }}" alt="Zuhaida Tsania Nabilazka" onerror="this.src='{{ asset('assets/img/model1.png') }}'"></div>
          <h3>Zuhaida Tsania Nabilazka</h3>
          <p>Marketing &amp; Business Strategist</p>
        </article>

        <article class="ab-member">
          <div class="ab-member-photo"><img src="{{ asset('assets/img/abtapril.jpg') }}" alt="Aprilia Alfa Gusasti Ciptaningtyas" style="object-position:60% top" onerror="this.src='{{ asset('assets/img/model2.png') }}'"></div>
          <h3>Aprilia Alfa Gusasti C.</h3>
          <p>Web Developer &amp; Technology Support</p>
        </article>

        <article class="ab-member">
          <div class="ab-member-photo"><img src="{{ asset('assets/img/abtfian.jpeg') }}" alt="Arfian Syafa Hidayat" onerror="this.src='{{ asset('assets/img/model3.png') }}'"></div>
          <h3>Arfian Syafa Hidayat</h3>
          <p>Creative &amp; Content Manager</p>
        </article>

      </div>
    </div>
  </section>

  <!-- ================= CONTACT ================= -->
  <section class="ab-contact ab-wrap" id="contact">
    <h2>Our<br>contact &amp; social media</h2>
    <svg class="ab-ornament" viewBox="0 0 466 50" aria-hidden="true"><use href="#i-ornament"/></svg>
    <div class="ab-links">
      <a href="https://shopee.co.id/zarabel.co" target="_blank" rel="noreferrer"><svg width="55" height="55" aria-hidden="true"><use href="#i-shopee"/></svg><span>zarabel.co</span></a>
      <a href="https://www.tiktok.com/@zarabel.co" target="_blank" rel="noreferrer"><svg width="44" height="44" aria-hidden="true"><use href="#i-tiktok-lg"/></svg><span>@zarabel.co</span></a>
      <a href="https://instagram.com/zarabel.co" target="_blank" rel="noreferrer"><svg width="50" height="50" aria-hidden="true"><use href="#i-ig-alt"/></svg><span>@zarabel.co</span></a>
      <a href="https://wa.me/628994129626" target="_blank" rel="noreferrer"><svg width="50" height="50" aria-hidden="true"><use href="#i-wa"/></svg><span>0899-4129-626</span></a>
    </div>
  </section>

  <!-- ================= FOOTER ================= -->
  @include('partials.footer')

</main>

<!-- lightbox galeri -->
<div class="ab-lightbox" id="lightbox" role="dialog" aria-modal="true" aria-label="Gallery image">
  <button type="button" id="lbClose" aria-label="Close image">×</button>
  <img id="lbImg" src="" alt="">
</div>

<script>
  // Menu HP
  var nav = document.getElementById('mainNav');
  var toggle = document.getElementById('menuToggle');
  toggle.addEventListener('click', function(){
    toggle.setAttribute('aria-expanded', nav.classList.toggle('open'));
  });

  // Lightbox galeri
  var lb = document.getElementById('lightbox'), lbImg = document.getElementById('lbImg');
  document.querySelectorAll('.ab-grid button').forEach(function(b){
    b.addEventListener('click', function(){
      lbImg.src = b.dataset.full; lbImg.alt = b.dataset.alt;
      lb.classList.add('open');
    });
  });
  function closeLb(){ lb.classList.remove('open'); }
  document.getElementById('lbClose').addEventListener('click', closeLb);
  lb.addEventListener('mousedown', function(e){ if (e.target === lb) closeLb(); });
  document.addEventListener('keydown', function(e){ if (e.key === 'Escape') closeLb(); });
</script>

</body>
</html>
