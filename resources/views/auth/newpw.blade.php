<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Zarabel — Enter New Password</title>

<!-- Favicon -->
<link rel="icon" type="image/png" href="{{ asset('images/zarabelbg.png') }}">
<link rel="apple-touch-icon" href="{{ asset('images/zarabelbg.png') }}">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;500;700&family=Montserrat:wght@400;600;700&family=Playfair+Display:ital,wght@0,400;0,500;0,600;1,400&family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700;800&family=Tenor+Sans&family=Volkhov:ital,wght@0,400;1,400&display=swap" rel="stylesheet">
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
  .field-error {
    color: #dc2626;
    font-size: 13px;
    margin-top: 4px;
  }
  .rule.valid {
    color: #166534;
  }
  .rule.valid svg circle {
    fill: #22c55e;
  }
  .rule.invalid svg circle {
    fill: #ef4444;
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
  <div class="form-panel newpass">
    <h2 class="title-signin">Enter your<br>new password</h2>

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

    <form method="POST" action="{{ route('password.update') }}" style="width: 100%; display: flex; flex-direction: column; align-items: center; gap: clamp(24px, 2.8vw, 40px);">
      @csrf

      <div class="fields">
        <div class="field">
          <label for="newpassword">New Password</label>
          <div class="input-wrap">
            <input id="newpassword" type="password" name="password" placeholder="********" required autofocus>
            <button type="button" class="toggle-eye" aria-label="Show password" data-target="newpassword">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                <circle cx="12" cy="12" r="3"></circle>
              </svg>
            </button>
          </div>
          @error('password')
            <span class="field-error">{{ $message }}</span>
          @enderror
        </div>

        <div class="field">
          <label for="confirmpassword">Confirm Password</label>
          <div class="input-wrap">
            <input id="confirmpassword" type="password" name="password_confirmation" placeholder="********" required>
            <button type="button" class="toggle-eye" aria-label="Show password" data-target="confirmpassword">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                <circle cx="12" cy="12" r="3"></circle>
              </svg>
            </button>
          </div>

          <div class="rules" style="margin-top: 10px;">
            <div class="rule" id="rule-len">
              <svg viewBox="0 0 16 16"><circle cx="8" cy="8" r="7"/><path d="M5 8l2 2 4-4" stroke="#fff" stroke-width="1.3" fill="none"/></svg>
              <span>Minimum 8 characters</span>
            </div>
            <div class="rule" id="rule-num">
              <svg viewBox="0 0 16 16"><circle cx="8" cy="8" r="7"/><path d="M5 8l2 2 4-4" stroke="#fff" stroke-width="1.3" fill="none"/></svg>
              <span>Must contain at least 1 number</span>
            </div>
            <div class="rule" id="rule-case">
              <svg viewBox="0 0 16 16"><circle cx="8" cy="8" r="7"/><path d="M5 8l2 2 4-4" stroke="#fff" stroke-width="1.3" fill="none"/></svg>
              <span>Must contain at least 1 capital case and 1 small case</span>
            </div>
            <div class="rule" id="rule-sym">
              <svg viewBox="0 0 16 16"><circle cx="8" cy="8" r="7"/><path d="M5 8l2 2 4-4" stroke="#fff" stroke-width="1.3" fill="none"/></svg>
              <span>Must contain at least 1 symbol</span>
            </div>
          </div>
        </div>
      </div>

      <button type="submit" class="submit-btn">
        <span>Reset Password</span>
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M5 12h14M13 6l6 6-6 6"/>
        </svg>
      </button>

      <div class="bottom-row">
        <a href="{{ route('login') }}" class="forget-link">Back to Sign In</a>
      </div>
    </form>
  </div>

</div>

<script>
  // Toggle password visibility
  document.querySelectorAll('.toggle-eye').forEach(function(btn){
    btn.addEventListener('click', function(){
      var input = document.getElementById(btn.dataset.target);
      if (input) {
        input.type = input.type === 'password' ? 'text' : 'password';
      }
    });
  });

  // Dynamic password validation rules
  var pwInput = document.getElementById('newpassword');
  var ruleLen = document.getElementById('rule-len');
  var ruleNum = document.getElementById('rule-num');
  var ruleCase = document.getElementById('rule-case');
  var ruleSym = document.getElementById('rule-sym');

  function updateRule(element, isValid) {
    if (isValid) {
      element.classList.remove('invalid');
      element.classList.add('valid');
    } else {
      element.classList.remove('valid');
      element.classList.add('invalid');
    }
  }

  pwInput.addEventListener('input', function(){
    var val = pwInput.value;
    updateRule(ruleLen, val.length >= 8);
    updateRule(ruleNum, /\d/.test(val));
    updateRule(ruleCase, /[a-z]/.test(val) && /[A-Z]/.test(val));
    updateRule(ruleSym, /[^A-Za-z0-9]/.test(val));
  });
</script>

</body>
</html>
