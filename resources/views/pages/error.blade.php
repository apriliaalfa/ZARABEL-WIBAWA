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
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;500;700&family=Montserrat:wght@400;600;700&family=Playfair+Display:ital,wght@0,400;0,500;0,600;1,400&family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Poppins:wght@400;500;600;700&family=Tenor+Sans&family=Volkhov:ital,wght@0,400;1,400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<link rel="stylesheet" href="{{ asset('css/catalog.css') }}">
<link rel="stylesheet" href="{{ asset('css/error.css') }}">
</head>
<body>

@include('partials.svg-icons')

<main>

  <!-- ================= HEADER ================= -->
  @include('partials.header-user', ['headerClass' => 'co-header'])

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
  @include('partials.footer')

</main>

<script>
  // Menu HP + scroll halus
  document.querySelectorAll('[data-scroll]').forEach(function(btn){
    btn.addEventListener('click', function(){
      var el = document.getElementById(btn.dataset.scroll);
      if (el) el.scrollIntoView({ behavior:'smooth' });
    });
  });
</script>

</body>
</html>
