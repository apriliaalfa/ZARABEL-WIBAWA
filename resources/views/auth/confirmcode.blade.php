{{-- Tempel kode halaman konfirmasi kode di file ini. --}}
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Zarabel — Confirmation Code</title>

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
  <form class="form-panel confirm" id="confirmForm" novalidate>
    <h2 class="title-signin">Enter confirmation code</h2>

    <div class="email-intro">
      <!-- Ikon: lingkaran coklat + amplop -->
      <svg class="email-icon" viewBox="0 0 89 81" fill="none" aria-hidden="true">
        <ellipse cx="44.5" cy="40.5" rx="44.5" ry="40.5" fill="#69481B"/>
        <path transform="translate(-18 15)" fill="#FEF7EE"
          d="M41.3 46H83.7C86.615 46 89 43.6937 89 40.875V10.125C89 7.30625 86.615 5 83.7 5H41.3C38.385 5 36 7.30625 36 10.125V40.875C36 43.6937 38.385 46 41.3 46ZM83.7 10.125L62.5 22.9119L41.3 10.125H83.7ZM41.3 15.25L62.5 28.0625L83.7 15.25V40.875H41.3V15.25Z"/>
      </svg>
      <p>Enter the 4-digit code sent to</p>
      <strong>zarabel@gmail.com</strong>
    </div>

    <fieldset class="code-fields">
      <legend style="position:absolute;width:1px;height:1px;overflow:hidden;clip:rect(0,0,0,0)">Four-digit confirmation code</legend>
      <input class="code-input" type="text" inputmode="numeric" maxlength="1" pattern="[0-9]*" autocomplete="one-time-code" aria-label="Digit 1">
      <input class="code-input" type="text" inputmode="numeric" maxlength="1" pattern="[0-9]*" autocomplete="off" aria-label="Digit 2">
      <input class="code-input" type="text" inputmode="numeric" maxlength="1" pattern="[0-9]*" autocomplete="off" aria-label="Digit 3">
      <input class="code-input" type="text" inputmode="numeric" maxlength="1" pattern="[0-9]*" autocomplete="off" aria-label="Digit 4">
    </fieldset>

    <button type="submit" class="submit-btn">
      <span>Send confirmation code</span>
      <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M5 12h14M13 6l6 6-6 6"/>
      </svg>
    </button>

    <div class="resend-row">
      <span>Didn't receive a code? </span>
      <button type="button" id="resendBtn">Resend Now</button>
    </div>

    <p class="form-message" id="msg" aria-live="polite"></p>
  </form>

</div>

<script>
  var inputs = Array.prototype.slice.call(document.querySelectorAll('.code-input'));
  var msg = document.getElementById('msg');
  var resendBtn = document.getElementById('resendBtn');
  var timer = null;

  inputs.forEach(function(input, i){
    // ketik angka -> pindah ke kotak berikutnya
    input.addEventListener('input', function(){
      input.value = input.value.replace(/\D/g, '').slice(-1);
      msg.textContent = '';
      if (input.value && i < inputs.length - 1) inputs[i + 1].focus();
    });

    // backspace & panah
    input.addEventListener('keydown', function(e){
      if (e.key === 'Backspace' && !input.value && i > 0) inputs[i - 1].focus();
      if (e.key === 'ArrowLeft' && i > 0) inputs[i - 1].focus();
      if (e.key === 'ArrowRight' && i < inputs.length - 1) inputs[i + 1].focus();
    });

    // paste 4 digit sekaligus
    input.addEventListener('paste', function(e){
      var digits = (e.clipboardData.getData('text') || '').replace(/\D/g, '').slice(0, inputs.length);
      if (!digits) return;
      e.preventDefault();
      inputs.forEach(function(el, idx){ el.value = digits[idx] || ''; });
      inputs[Math.min(digits.length, inputs.length) - 1].focus();
    });
  });

  // submit
  document.getElementById('confirmForm').addEventListener('submit', function(e){
    e.preventDefault();
    var empty = inputs.findIndex(function(el){ return !el.value; });
    if (empty !== -1) {
      msg.textContent = 'Please enter the complete 4-digit code.';
      inputs[empty].focus();
      return;
    }
    msg.textContent = 'Code confirmed successfully.';
  });

  // resend dengan hitung mundur 30 detik
  resendBtn.addEventListener('click', function(){
    var seconds = 30;
    inputs.forEach(function(el){ el.value = ''; });
    inputs[0].focus();
    msg.textContent = 'A new confirmation code has been sent.';
    resendBtn.disabled = true;
    resendBtn.textContent = 'Resend in ' + seconds + 's';
    timer = setInterval(function(){
      seconds--;
      if (seconds <= 0) {
        clearInterval(timer);
        resendBtn.disabled = false;
        resendBtn.textContent = 'Resend Now';
      } else {
        resendBtn.textContent = 'Resend in ' + seconds + 's';
      }
    }, 1000);
  });
</script>

</body>
</html>