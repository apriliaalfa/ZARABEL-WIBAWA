<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Zarabel — Confirmation Code</title>

<!-- Favicon -->
<link rel="icon" type="image/png" href="{{ asset('images/zarabelbg.png') }}">
<link rel="apple-touch-icon" href="{{ asset('images/zarabelbg.png') }}">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600&family=Poppins:wght@400;700;800&family=Lato:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
<style>
.photo-panel {
  background: url('{{ asset('images/hero2.jpeg') }}') 85% center / cover no-repeat;
}
  .brand-link {
    display: flex;
    align-items: center;
    text-decoration: none;
    color: inherit;
  }
  .alert {
    padding: 12px 16px;
    border-radius: 8px;
    font-size: 14px;
    margin-bottom: 12px;
    width: 100%;
    max-width: 592px;
  }
  .alert-info {
    background-color: #e0f2fe;
    color: #0369a1;
    border: 1px solid #bae6fd;
  }
  .alert-error {
    background-color: #fee2e2;
    color: #991b1b;
    border: 1px solid #fecaca;
  }
</style>
</head>
<body>

<div class="login">

  <!-- LEFT: photo panel -->
  <div class="photo-panel">
    <div class="brand">
      <a href="{{ route('homepage1') }}" class="brand-link">
        <div class="brand-mark"><img src="{{ asset('images/zarabelbg.png') }}" alt="ZARABEL"></div>
        <h1 class="brand-name">ARABEL</h1>
      </a>
    </div>
  </div>

  <!-- RIGHT: form panel -->
  <form class="form-panel confirm" id="confirmForm" method="POST" action="{{ route('password.verify_code') }}">
    @csrf
    <h2 class="title-signin">Enter confirmation code</h2>

    @if (session('status'))
      <div class="alert alert-info">
        <span>{{ session('status') }}</span>
      </div>
    @endif

    @if (isset($errors) && $errors->any())
      <div class="alert alert-error">
        <span>{{ $errors->first() }}</span>
      </div>
    @endif

    <div class="email-intro">
      <svg class="email-icon" viewBox="0 0 89 81" fill="none" aria-hidden="true">
        <ellipse cx="44.5" cy="40.5" rx="44.5" ry="40.5" fill="#69481B"/>
        <path transform="translate(-18 15)" fill="#FEF7EE"
          d="M41.3 46H83.7C86.615 46 89 43.6937 89 40.875V10.125C89 7.30625 86.615 5 83.7 5H41.3C38.385 5 36 7.30625 36 10.125V40.875C36 43.6937 38.385 46 41.3 46ZM83.7 10.125L62.5 22.9119L41.3 10.125H83.7ZM41.3 15.25L62.5 28.0625L83.7 15.25V40.875H41.3V15.25Z"/>
      </svg>
      <p>Enter the 4-digit code sent to</p>
      <strong>{{ $email ?? 'zarabel@gmail.com' }}</strong>
    </div>

    <input type="hidden" name="code" id="hiddenCode">

    <fieldset class="code-fields">
      <legend style="position:absolute;width:1px;height:1px;overflow:hidden;clip:rect(0,0,0,0)">Four-digit confirmation code</legend>
      <input class="code-input" type="text" name="digits[]" inputmode="numeric" maxlength="1" pattern="[0-9]*" autocomplete="one-time-code" aria-label="Digit 1" autofocus>
      <input class="code-input" type="text" name="digits[]" inputmode="numeric" maxlength="1" pattern="[0-9]*" autocomplete="off" aria-label="Digit 2">
      <input class="code-input" type="text" name="digits[]" inputmode="numeric" maxlength="1" pattern="[0-9]*" autocomplete="off" aria-label="Digit 3">
      <input class="code-input" type="text" name="digits[]" inputmode="numeric" maxlength="1" pattern="[0-9]*" autocomplete="off" aria-label="Digit 4">
    </fieldset>

    <button type="submit" class="submit-btn">
      <span>Confirm code</span>
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M5 12h14M13 6l6 6-6 6"/>
      </svg>
    </button>

    <div class="resend-row">
      <span>Didn't receive a code? </span>
      <button type="button" id="resendBtn">Resend Now</button>
    </div>

    <p class="form-message" id="msg" aria-live="polite"></p>

    <div class="bottom-row" style="margin-top: 15px;">
      <a href="{{ route('login') }}" class="forget-link">Back to Sign In</a>
    </div>
  </form>

</div>

<script>
  var inputs = Array.prototype.slice.call(document.querySelectorAll('.code-input'));
  var msg = document.getElementById('msg');
  var resendBtn = document.getElementById('resendBtn');
  var hiddenCode = document.getElementById('hiddenCode');

  inputs.forEach(function(input, i){
    input.addEventListener('input', function(){
      input.value = input.value.replace(/\D/g, '').slice(-1);
      msg.textContent = '';
      if (input.value && i < inputs.length - 1) inputs[i + 1].focus();
      updateHiddenCode();
    });

    input.addEventListener('keydown', function(e){
      if (e.key === 'Backspace' && !input.value && i > 0) inputs[i - 1].focus();
      if (e.key === 'ArrowLeft' && i > 0) inputs[i - 1].focus();
      if (e.key === 'ArrowRight' && i < inputs.length - 1) inputs[i + 1].focus();
    });

    input.addEventListener('paste', function(e){
      var digits = (e.clipboardData.getData('text') || '').replace(/\D/g, '').slice(0, inputs.length);
      if (!digits) return;
      e.preventDefault();
      inputs.forEach(function(el, idx){ el.value = digits[idx] || ''; });
      inputs[Math.min(digits.length, inputs.length) - 1].focus();
      updateHiddenCode();
    });
  });

  function updateHiddenCode() {
    var full = inputs.map(function(el){ return el.value; }).join('');
    hiddenCode.value = full;
  }

  document.getElementById('confirmForm').addEventListener('submit', function(e){
    updateHiddenCode();
    var empty = inputs.findIndex(function(el){ return !el.value; });
    if (empty !== -1) {
      e.preventDefault();
      msg.textContent = 'Please enter the complete 4-digit code.';
      inputs[empty].focus();
    }
  });

  resendBtn.addEventListener('click', function(){
    var seconds = 30;
    inputs.forEach(function(el){ el.value = ''; });
    inputs[0].focus();
    msg.textContent = 'A new confirmation code has been sent (Use: 1234).';
    resendBtn.disabled = true;
    resendBtn.textContent = 'Resend in ' + seconds + 's';
    var timer = setInterval(function(){
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
