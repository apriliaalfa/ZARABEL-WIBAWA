{{-- Tempel kode halaman password baru di file ini. --}}
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Zarabel — Enter New Password</title>

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
  <div class="form-panel newpass">
    <h2 class="title-signin">Enter your<br>new password</h2>

    <div class="fields">
      <div class="field">
        <label for="newpassword">New Password</label>
        <div class="input-wrap">
          <input id="newpassword" type="password" placeholder="********">
          <button type="button" class="toggle-eye" aria-label="Show password" data-target="newpassword">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
              <path d="M3 3l18 18"/>
              <path d="M10.6 5.1a10.9 10.9 0 0 1 1.4-.1c6 0 9.3 5.1 10.4 7-.4.7-1.4 2.2-2.9 3.6M6.1 6.1C3.6 7.8 2 10.2 1.2 11c1.1 1.9 4.4 7 10.8 7 1.5 0 2.8-.3 4-.7"/>
              <path d="M9.9 10a3 3 0 0 0 4.1 4.1"/>
            </svg>
          </button>
        </div>
      </div>

      <div class="field">
        <label for="confirmpassword">Confirm Password</label>
        <div class="input-wrap">
          <input id="confirmpassword" type="password" placeholder="********">
          <button type="button" class="toggle-eye" aria-label="Show password" data-target="confirmpassword">
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
          <div class="rule">
            <svg viewBox="0 0 16 16"><circle cx="8" cy="8" r="7"/><path d="M5 8l2 2 4-4" stroke="#fff" stroke-width="1.3" fill="none"/></svg>
            <span>Must contain at least 1 symbol</span>
          </div>
        </div>
      </div>
    </div>

    <button type="button" class="submit-btn">
      <span>Reset Password</span>
      <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M5 12h14M13 6l6 6-6 6"/>
      </svg>
    </button>
  </div>

</div>

<script>
  // Tombol mata: tampilkan / sembunyikan password
  document.querySelectorAll('.toggle-eye').forEach(function(btn){
    btn.addEventListener('click', function(){
      var input = document.getElementById(btn.dataset.target);
      input.type = input.type === 'password' ? 'text' : 'password';
    });
  });
</script>

</body>
</html>