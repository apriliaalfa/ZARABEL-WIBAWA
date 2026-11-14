{{--
  PARTIAL: partials/footer.blade.php
  Footer utama Zarabel — sama persis dengan homepage1.
  Cara pakai: @include('partials.footer')
--}}
<footer id="about">
  <div class="footer-brand">
    <div class="brand footer-logo">
      <img src="{{ asset('assets/img/zarabelbg.png') }}" alt="">
      <span>arabel</span>
    </div>
    <p>Artistic Printed Wonderful Indonesian Textile Design</p>
    <div class="socials">
      <a href="https://instagram.com/zarabel.co" target="_blank" rel="noreferrer" aria-label="Instagram"><svg class="ic"><use href="#i-ig"/></svg></a>
      <a href="https://wa.me/628994129626" target="_blank" rel="noreferrer" aria-label="WhatsApp"><svg class="ic"><use href="#i-call"/></svg></a>
      <a href="mailto:zarabelco@gmail.com" aria-label="Email"><svg class="ic"><use href="#i-mail"/></svg></a>
      <a href="https://shopee.co.id/zarabel.co" target="_blank" rel="noreferrer" aria-label="Shopee"><svg class="ic"><use href="#i-bag"/></svg></a>
      <a href="https://www.tiktok.com/@zarabel.co" target="_blank" rel="noreferrer" aria-label="TikTok"><svg class="ic"><use href="#i-tiktok"/></svg></a>
      <a href="{{ Auth::check() ? route('homepage2') : route('homepage1') }}" aria-label="Website"><svg class="ic"><use href="#i-globe"/></svg></a>
    </div>
  </div>

  <div class="footer-links">
    <div>
      <strong>Information</strong>
      <button onclick="location.href='{{ route('about') }}'">About Us</button>
      <button onclick="location.href='{{ route('about') }}#contact'">Contact</button>
      <button>Blog</button>
    </div>
    <div>
      <strong>Company</strong>
      <button>Community</button>
      <button>Career</button>
      <button>Our story</button>
    </div>
    <div>
      <strong>Contact</strong>
      <button>Getting Started</button>
      <button>Pricing</button>
      <button>Resources</button>
    </div>
  </div>

  <p class="copyright">Copyright &copy; 2026 Xpro. All Rights Reserved &middot; Terms of use ZARABEL</p>
</footer>
