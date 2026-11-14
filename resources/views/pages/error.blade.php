<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Zarabel — Page Not Found</title>

<link rel="icon" type="image/png" href="{{ asset('images/zarabelbg.png') }}">
<link rel="apple-touch-icon" href="{{ asset('images/zarabelbg.png') }}">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Jomolhari&family=Lato:wght@400;500;700&family=Playfair+Display:wght@400;500&family=Poppins:wght@300;400;500;600;700&family=Ponomar&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<link rel="stylesheet" href="{{ asset('css/catalog.css') }}">
<link rel="stylesheet" href="{{ asset('css/error.css') }}">
</head>
<body>

<svg width="0" height="0" style="position:absolute" aria-hidden="true">
  <symbol id="i-search" viewBox="0 0 30 30"><path d="M26.25 26.25L20.8125 20.8125M23.75 13.75C23.75 19.2728 19.2728 23.75 13.75 23.75C8.22715 23.75 3.75 19.2728 3.75 13.75C3.75 8.22715 8.22715 3.75 13.75 3.75C19.2728 3.75 23.75 8.22715 23.75 13.75Z" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></symbol>
  <symbol id="i-cart" viewBox="0 0 35 35"><path d="M3.28125 4.375H5.30204C6.04533 4.375 6.69576 4.8747 6.88727 5.59289L7.4461 7.68847M10.9375 20.7812C8.52125 20.7812 6.5625 22.74 6.5625 25.1562H29.5312M10.9375 20.7812H27.2975C28.9324 17.4262 30.3592 13.9509 31.5609 10.3724C24.6167 8.599 17.3403 7.65625 9.84375 7.65625C9.04197 7.65625 8.24271 7.66704 7.4461 7.68847M10.9375 20.7812L7.4461 7.68847M8.75 29.5312C8.75 30.1353 8.26031 30.625 7.65625 30.625C7.05219 30.625 6.5625 30.1353 6.5625 29.5312C6.5625 28.9272 7.05219 28.4375 7.65625 28.4375C8.26031 28.4375 8.75 28.9272 8.75 29.5312ZM27.3438 29.5312C27.3438 30.1353 26.8541 30.625 26.25 30.625C25.6459 30.625 25.1562 30.1353 25.1562 29.5312C25.1562 28.9272 25.6459 28.4375 26.25 28.4375C26.8541 28.4375 27.3438 28.9272 27.3438 29.5312Z" fill="none" stroke="currentColor" stroke-width="2.33" stroke-linecap="round" stroke-linejoin="round"/></symbol>
  <symbol id="i-user" viewBox="0 0 35 35"><path d="M22.9687 8.75C22.9687 11.7703 20.5203 14.2188 17.5 14.2188C14.4797 14.2188 12.0312 11.7703 12.0312 8.75C12.0312 5.72969 14.4797 3.28125 17.5 3.28125C20.5203 3.28125 22.9687 5.72969 22.9687 8.75ZM6.56415 29.3391C6.66668 23.3871 11.5236 18.5938 17.5 18.5938C23.4766 18.5938 28.3335 23.3874 28.4358 29.3395C25.1068 30.8671 21.4031 31.7188 17.5005 31.7188C13.5975 31.7188 9.89346 30.867 6.56415 29.3391Z" fill="none" stroke="currentColor" stroke-width="2.33" stroke-linecap="round" stroke-linejoin="round"/></symbol>
  <symbol id="i-chev" viewBox="0 0 20 20"><path d="M16.25 6.875L10 13.125L3.75 6.875" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></symbol>
  <symbol id="i-ig" viewBox="0 0 48 48"><path fill="currentColor" d="M23.9999 15.6666C26.264 15.6666 26.5465 15.6749 27.4349 15.7166C28.3224 15.7583 28.9265 15.8974 29.4582 16.1041C30.0082 16.3158 30.4715 16.6024 30.9349 17.0649C31.3586 17.4815 31.6865 17.9854 31.8957 18.5416C32.1015 19.0724 32.2415 19.6774 32.2832 20.5649C32.3224 21.4533 32.3332 21.7358 32.3332 23.9999C32.3332 26.2641 32.3249 26.5466 32.2832 27.4349C32.2415 28.3224 32.1015 28.9266 31.8957 29.4583C31.6871 30.0147 31.3591 30.5188 30.9349 30.9349C30.5182 31.3585 30.0143 31.6864 29.4582 31.8958C28.9274 32.1016 28.3224 32.2416 27.4349 32.2833C26.5465 32.3224 26.264 32.3333 23.9999 32.3333C21.7357 32.3333 21.4532 32.3249 20.5649 32.2833C19.6774 32.2416 19.0732 32.1016 18.5415 31.8958C17.9851 31.687 17.4811 31.359 17.0649 30.9349C16.641 30.5184 16.3131 30.0145 16.104 29.4583C15.8974 28.9274 15.7582 28.3224 15.7165 27.4349C15.6774 26.5466 15.6665 26.2641 15.6665 23.9999C15.6665 21.7358 15.6749 21.4533 15.7165 20.5649C15.7582 19.6766 15.8974 19.0733 16.104 18.5416C16.3126 17.9851 16.6405 17.481 17.0649 17.0649C17.4813 16.6409 17.9852 16.313 18.5415 16.1041C19.0732 15.8974 19.6765 15.7583 20.5649 15.7166C21.4532 15.6774 21.7357 15.6666 23.9999 15.6666ZM23.9999 19.8333C22.8948 19.8333 21.835 20.2722 21.0536 21.0536C20.2722 21.835 19.8332 22.8949 19.8332 23.9999C19.8332 25.105 20.2722 26.1648 21.0536 26.9462C21.835 27.7276 22.8948 28.1666 23.9999 28.1666C25.1049 28.1666 26.1647 27.7276 26.9461 26.9462C27.7276 26.1648 28.1665 25.105 28.1665 23.9999C28.1665 22.8949 27.7276 21.835 26.9461 21.0536C26.1647 20.2722 25.1049 19.8333 23.9999 19.8333ZM29.4165 19.6249C29.4165 19.3487 29.3068 19.0837 29.1114 18.8884C28.9161 18.693 28.6511 18.5833 28.3749 18.5833C28.0986 18.5833 27.8337 18.693 27.6383 18.8884C27.443 19.0837 27.3332 19.3487 27.3332 19.6249C27.3332 19.9012 27.443 20.1661 27.6383 20.3615C27.8337 20.5568 28.0986 20.6666 28.3749 20.6666C28.6511 20.6666 28.9161 20.5568 29.1114 20.3615C29.3068 20.1661 29.4165 19.9012 29.4165 19.6249ZM23.9999 21.4999C24.6629 21.4999 25.2988 21.7633 25.7676 22.2322C26.2365 22.701 26.4999 23.3369 26.4999 23.9999C26.4999 24.663 26.2365 25.2988 25.7676 25.7677C25.2988 26.2365 24.6629 26.4999 23.9999 26.4999C23.3368 26.4999 22.7009 26.2365 22.2321 25.7677C21.7633 25.2988 21.4999 24.663 21.4999 23.9999C21.4999 23.3369 21.7633 22.701 22.2321 22.2322C22.7009 21.7633 23.3368 21.4999 23.9999 21.4999Z"/></symbol>
  <symbol id="i-call" viewBox="0 0 48 48"><path d="M26.5417 18.1667C27.3556 18.3255 28.1037 18.7235 28.6901 19.3099C29.2765 19.8963 29.6745 20.6444 29.8333 21.4583M26.5417 14.8333C28.2327 15.0212 29.8097 15.7785 31.0135 16.9808C32.2174 18.1832 32.9767 19.7592 33.1667 21.45M32.3333 28.1V30.6C32.3343 30.8321 32.2867 31.0618 32.1938 31.2745C32.1008 31.4871 31.9644 31.678 31.7934 31.8349C31.6224 31.9918 31.4205 32.1112 31.2006 32.1856C30.9808 32.2599 30.7478 32.2876 30.5167 32.2667C27.9524 31.988 25.4892 31.1118 23.325 29.7083C21.3115 28.4289 19.6044 26.7218 18.325 24.7083C16.9166 22.5343 16.0402 20.0592 15.7667 17.4833C15.7458 17.2529 15.7732 17.0206 15.8471 16.8014C15.9209 16.5821 16.0396 16.3806 16.1956 16.2097C16.3516 16.0388 16.5415 15.9023 16.7532 15.8088C16.9648 15.7153 17.1936 15.6669 17.425 15.6667H19.925C20.3294 15.6627 20.7215 15.8059 21.0281 16.0696C21.3348 16.3333 21.5351 16.6995 21.5917 17.1C21.6972 17.9001 21.8929 18.6856 22.175 19.4417C22.2871 19.7399 22.3114 20.0641 22.2449 20.3757C22.1785 20.6874 22.0241 20.9734 21.8 21.2L20.7417 22.2583C21.928 24.3446 23.6554 26.072 25.7417 27.2583L26.8 26.2C27.0266 25.9759 27.3126 25.8215 27.6243 25.7551C27.9359 25.6886 28.2601 25.7129 28.5583 25.825C29.3144 26.1071 30.0999 26.3028 30.9 26.4083C31.3048 26.4654 31.6745 26.6693 31.9388 26.9812C32.2031 27.2932 32.3435 27.6913 32.3333 28.1Z" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></symbol>
  <symbol id="i-mail" viewBox="0 0 48 48"><path fill="currentColor" d="M16 32C15.45 32 14.9792 31.8042 14.5875 31.4125C14.1958 31.0208 14 30.55 14 30V18C14 17.45 14.1958 16.9792 14.5875 16.5875C14.9792 16.1958 15.45 16 16 16H32C32.55 16 33.0208 16.1958 33.4125 16.5875C33.8042 16.9792 34 17.45 34 18V30C34 30.55 33.8042 31.0208 33.4125 31.4125C33.0208 31.8042 32.55 32 32 32H16ZM24 25L16 20V30H32V20L24 25ZM24 23L32 18H16L24 23Z"/></symbol>
  <symbol id="i-bag" viewBox="0 0 48 48"><path d="M33 18V32C33 32.5304 32.7893 33.0391 32.4142 33.4142C32.0391 33.7893 31.5304 34 31 34H17C16.4696 34 15.9609 33.7893 15.5858 33.4142C15.2107 33.0391 15 32.5304 15 32V18L18 14H30L33 18ZM15 18H33M28 22C28 23.0609 27.5786 24.0783 26.8284 24.8284C26.0783 25.5786 25.0609 26 24 26C22.9391 26 21.9217 25.5786 21.1716 24.8284C20.4214 24.0783 20 23.0609 20 22" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></symbol>
  <symbol id="i-globe" viewBox="0 0 48 48"><path fill="currentColor" d="M24 34C22.6333 34 21.3417 33.7375 20.125 33.2125C18.9083 32.6875 17.8458 31.9708 16.9375 31.0625C16.0292 30.1542 15.3125 29.0917 14.7875 27.875C14.2625 26.6583 14 25.3667 14 24C14 22.6167 14.2625 21.3208 14.7875 20.1125C15.3125 18.9042 16.0292 17.8458 16.9375 16.9375C17.8458 16.0292 18.9083 15.3125 20.125 14.7875C21.3417 14.2625 22.6333 14 24 14C25.3833 14 26.6792 14.2625 27.8875 14.7875C29.0958 15.3125 30.1542 16.0292 31.0625 16.9375C31.9708 17.8458 32.6875 18.9042 33.2125 20.1125C33.7375 21.3208 34 22.6167 34 24C34 25.3667 33.7375 26.6583 33.2125 27.875C32.6875 29.0917 31.9708 30.1542 31.0625 31.0625C30.1542 31.9708 29.0958 32.6875 27.8875 33.2125C26.6792 33.7375 25.3833 34 24 34ZM24 31.95C24.4333 31.35 24.8083 30.725 25.125 30.075C25.4417 29.425 25.7 28.7333 25.9 28H22.1C22.3 28.7333 22.5583 29.425 22.875 30.075C23.1917 30.725 23.5667 31.35 24 31.95ZM21.4 31.55C21.1 31 20.8375 30.4292 20.6125 29.8375C20.3875 29.2458 20.2 28.6333 20.05 28H17.1C17.5833 28.8333 18.1875 29.5583 18.9125 30.175C19.6375 30.7917 20.4667 31.25 21.4 31.55ZM26.6 31.55C27.5333 31.25 28.3625 30.7917 29.0875 30.175C29.8125 29.5583 30.4167 28.8333 30.9 28H27.95C27.8 28.6333 27.6125 29.2458 27.3875 29.8375C27.1625 30.4292 26.9 31 26.6 31.55ZM16.25 26H19.65C19.6 25.6667 19.5625 25.3375 19.5375 25.0125C19.5125 24.6875 19.5 24.35 19.5 24C19.5 23.65 19.5125 23.3125 19.5375 22.9875C19.5625 22.6625 19.6 22.3333 19.65 22H16.25C16.1667 22.3333 16.1042 22.6625 16.0625 22.9875C16.0208 23.3125 16 23.65 16 24C16 24.35 16.0208 24.6875 16.0625 25.0125C16.1042 25.3375 16.1667 25.6667 16.25 26ZM21.65 26H26.35C26.4 25.6667 26.4375 25.3375 26.4625 25.0125C26.4875 24.6875 26.5 24.35 26.5 24C26.5 23.65 26.4875 23.3125 26.4625 22.9875C26.4375 22.6625 26.4 22.3333 26.35 22H21.65C21.6 22.3333 21.5625 22.6625 21.5375 22.9875C21.5125 23.3125 21.5 23.65 21.5 24C21.5 24.35 21.5125 24.6875 21.5375 25.0125C21.5625 25.3375 21.6 25.6667 21.65 26ZM28.35 26H31.75C31.8333 25.6667 31.8958 25.3375 31.9375 25.0125C31.9792 24.6875 32 24.35 32 24C32 23.65 31.9792 23.3125 31.9375 22.9875C31.8958 22.6625 31.8333 22.3333 31.75 22H28.35C28.4 22.3333 28.4375 22.6625 28.4625 22.9875C28.4875 23.3125 28.5 23.65 28.5 24C28.5 24.35 28.4875 24.6875 28.4625 25.0125C28.4375 25.3375 28.4 25.6667 28.35 26ZM27.95 20H30.9C30.4167 19.1667 29.8125 18.4417 29.0875 17.825C28.3625 17.2083 27.5333 16.75 26.6 16.45C26.9 17 27.1625 17.5708 27.3875 18.1625C27.6125 18.7542 27.8 19.3667 27.95 20ZM22.1 20H25.9C25.7 19.2667 25.4417 18.575 25.125 17.925C24.8083 17.275 24.4333 16.65 24 16.05C23.5667 16.65 23.1917 17.275 22.875 17.925C22.5583 18.575 22.3 19.2667 22.1 20ZM17.1 20H20.05C20.2 19.3667 20.3875 18.7542 20.6125 18.1625C20.8375 17.5708 21.1 17 21.4 16.45C20.4667 16.75 19.6375 17.2083 18.9125 17.825C18.1875 18.4417 17.5833 19.1667 17.1 20Z"/></symbol>
</svg>

<main>

  <!-- ================= HEADER ================= -->
  <header class="site-header logged co-header">
    <a class="brand" href="{{ route('homepage2') }}" aria-label="Zarabel home">
      <img src="{{ asset('images/zarabelbg.png') }}" alt="ZARABEL">
      <span>arabel</span>
    </a>

    <button class="menu-toggle" id="menuToggle" aria-label="Toggle navigation" aria-expanded="false">
      <span></span><span></span>
    </button>

    <nav id="mainNav" aria-label="Main navigation">
      <button onclick="location.href='{{ route('homepage2') }}'">Home</button>
      <div class="catalog-control">
        <button class="active" onclick="location.href='{{ route('catalog') }}'">
          Catalog <svg class="ic"><use href="#i-chev"/></svg>
        </button>
      </div>
      <button>New Arrival</button>
      <button data-scroll="about">About Us</button>
    </nav>

    <div class="header-actions">
      <button aria-label="Search"><svg class="ic"><use href="#i-search"/></svg></button>
      <button aria-label="Account" onclick="location.href='{{ route('profile') }}'"><svg class="ic"><use href="#i-user"/></svg></button>
      <button class="cart-button" aria-label="Cart" onclick="location.href='{{ route('cart') }}'"><svg class="ic"><use href="#i-cart"/></svg></button>
    </div>
  </header>

  <!-- ================= ISI 404 ================= -->
  <section class="err-main">
    <div class="err-wrap">
      <img class="err-img" src="{{ asset('assets/img/error.png') }}" alt="404 — orang bekerja di depan komputer">
      <h1 class="err-title">Page Not Found</h1>
      <p class="err-desc">Oops! Looks like you followed a bad link. If you think this is a problem with us, please tell us.</p>
      <a class="btn-home" href="{{ route('homepage2') }}">Back to ZARABEL Home</a>
    </div>
  </section>

  <!-- ================= FOOTER ================= -->
  <footer id="about">
    <div class="footer-brand">
      <div class="brand footer-logo">
        <img src="{{ asset('images/zarabelbg.png') }}" alt="">
        <span>arabel</span>
      </div>
      <p>Artistic Printed Wonderful Indonesian Textile Design</p>
      <div class="socials">
        <button aria-label="Instagram"><svg class="ic"><use href="#i-ig"/></svg></button>
        <button aria-label="Phone"><svg class="ic"><use href="#i-call"/></svg></button>
        <button aria-label="Email"><svg class="ic"><use href="#i-mail"/></svg></button>
        <button aria-label="Shop"><svg class="ic"><use href="#i-bag"/></svg></button>
        <button aria-label="Website"><svg class="ic"><use href="#i-globe"/></svg></button>
      </div>
    </div>

    <div class="footer-links">
      <div><strong>Information</strong><button>About Us</button><button>Contact</button><button>Blog</button></div>
      <div><strong>Company</strong><button>Community</button><button>Career</button><button>Our story</button></div>
      <div><strong>Contact</strong><button>Getting Started</button><button>Pricing</button><button>Resources</button></div>
    </div>

    <p class="copyright">Copyright &copy; 2026 Xpro. All Rights Reserved · Terms of use ZARABEL</p>
  </footer>

</main>

<script>
  // Menu HP + scroll halus
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
</script>

</body>
</html>
