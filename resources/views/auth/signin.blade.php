{{-- Tempel kode halaman sign-in di file ini. --}}
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Zarabel — Sign In</title>

<!-- Favicon (ikon di tab browser) -->
<link rel="icon" type="image/png" href="assets/img/zarabelbg.png">
<link rel="apple-touch-icon" href="assets/img/zarabelbg.png">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600&family=Poppins:wght@400;700;800&family=Lato:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="login">

  <!-- LEFT: photo panel -->
  <div class="photo-panel">
    <div class="brand">
      <div class="brand-mark"><img src="assets/img/zarabelbg.png" alt="ZARABEL"></div>
      <h1 class="brand-name">ARABEL</h1>
    </div>
  </div>

  <!-- RIGHT: form panel -->
  <div class="form-panel">
    <h2 class="title-signin">Sign In</h2>

    <button type="button" class="google-btn">
      <svg width="20" height="20" viewBox="0 0 48 48" aria-hidden="true">
        <path fill="#FFC107" d="M43.6 20.5H42V20H24v8h11.3c-1.6 4.7-6.1 8-11.3 8-6.6 0-12-5.4-12-12s5.4-12 12-12c3.1 0 5.9 1.2 8 3.1l5.7-5.7C34.6 6.1 29.6 4 24 4 12.9 4 4 12.9 4 24s8.9 20 20 20 20-8.9 20-20c0-1.3-.1-2.7-.4-3.5z"/>
        <path fill="#FF3D00" d="M6.3 14.7l6.6 4.8C14.6 15.9 18.9 13 24 13c3.1 0 5.9 1.2 8 3.1l5.7-5.7C34.6 6.1 29.6 4 24 4 16.3 4 9.6 8.3 6.3 14.7z"/>
        <path fill="#4CAF50" d="M24 44c5.5 0 10.4-1.9 14.1-5.1l-6.5-5.5C29.6 35.4 27 36 24 36c-5.2 0-9.6-3.3-11.2-8l-6.6 5.1C9.5 39.6 16.2 44 24 44z"/>
        <path fill="#1976D2" d="M43.6 20.5H42V20H24v8h11.3c-.8 2.3-2.2 4.3-4.1 5.7l6.5 5.5C41.9 36.4 44 30.6 44 24c0-1.3-.1-2.7-.4-3.5z"/>
      </svg>
      <span>Sign In with Google</span>
    </button>

    <div class="divider">
      <span class="line"></span>
      <span>OR</span>
      <span class="line"></span>
    </div>

    <div class="fields">
      <div class="field">
        <label for="email">Email</label>
        <div class="input-wrap">
          <input id="email" type="email" placeholder="example@mail.com">
        </div>
      </div>

      <div class="field">
        <label for="password">Password</label>
        <div class="input-wrap">
          <input id="password" type="password" placeholder="********">
          <button type="button" class="toggle-eye" aria-label="Show password">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
              <path d="M3 3l18 18"/>
              <path d="M10.6 5.1a10.9 10.9 0 0 1 1.4-.1c6 0 9.3 5.1 10.4 7-.4.7-1.4 2.2-2.9 3.6M6.1 6.1C3.6 7.8 2 10.2 1.2 11c1.1 1.9 4.4 7 10.8 7 1.5 0 2.8-.3 4-.7"/>
              <path d="M9.9 10a3 3 0 0 0 4.1 4.1"/>
            </svg>
          </button>
        </div>

        <div class="rules">
          <div class="rule">
            <svg viewBox="0 0 16 16"><circle cx="8" cy="8" r="7"/><path d="M5 8l2 2 4-4" stroke="#fff" stroke-width="1.3" fill="none"/></svg>
            <span>Minimum 8 characters</span>
          </div>
          <div class="rule">
            <svg viewBox="0 0 16 16"><circle cx="8" cy="8" r="7"/><path d="M5 8l2 2 4-4" stroke="#fff" stroke-width="1.3" fill="none"/></svg>
            <span>Must contain at least 1 number</span>
          </div>
          <div class="rule">
            <svg viewBox="0 0 16 16"><circle cx="8" cy="8" r="7"/><path d="M5 8l2 2 4-4" stroke="#fff" stroke-width="1.3" fill="none"/></svg>
            <span>Must contain at least 1 capital case and 1 small case</span>
          </div>
          <div class="rule invalid">
            <svg viewBox="0 0 16 16" stroke-width="1.3"><circle cx="8" cy="8" r="7"/><path d="M6 6l4 4M10 6l-4 4"/></svg>
            <span>Must contain at least 1 symbol</span>
          </div>
        </div>
      </div>
    </div>

    <button type="button" class="submit-btn">
      <span>Sign In</span>
      <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M5 12h14M13 6l6 6-6 6"/>
      </svg>
    </button>

    <div class="bottom-row">
      <a href="#" class="forget-link">Forgot Password?</a>
      <p class="register-text">Don't have account? <a href="#">Register here</a></p>
    </div>
  </div>

</div>

</body>
</html>