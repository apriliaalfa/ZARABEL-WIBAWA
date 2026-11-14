<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Zarabel — Sign In</title>

<!-- Favicon -->
<link rel="icon" type="image/png" href="{{ asset('images/zarabelbg.png') }}">
<link rel="apple-touch-icon" href="{{ asset('images/zarabelbg.png') }}">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600&family=Poppins:wght@400;700;800&family=Lato:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
<style>
  /* Alert messages */
  .alert {
    padding: 12px 16px;
    border-radius: 8px;
    font-size: 14px;
    margin-bottom: 12px;
    width: 100%;
    max-width: 592px;
    display: flex;
    align-items: center;
    gap: 8px;
  }
  .alert-error {
    background-color: #fee2e2;
    color: #991b1b;
    border: 1px solid #fecaca;
  }
  .alert-success {
    background-color: #dcfce7;
    color: #166534;
    border: 1px solid #bbf7d0;
  }
  .field-error {
    color: #dc2626;
    font-size: 13px;
    margin-top: 4px;
  }
  .google-btn {
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
  }
.photo-panel {
  background: url('{{ asset('images/hero2.jpeg') }}') 85% center / cover no-repeat;
}
  .brand-link {
    display: flex;
    align-items: center;
    text-decoration: none;
    color: inherit;
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
  <div class="form-panel">
    <h2 class="title-signin">Sign In</h2>

    @if (session('success'))
      <div class="alert alert-success">
        <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
        <span>{{ session('success') }}</span>
      </div>
    @endif

    @if (session('info'))
      <div class="alert alert-success">
        <span>{{ session('info') }}</span>
      </div>
    @endif

    @if (isset($errors) && $errors->has('google'))
      <div class="alert alert-error">
        <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
        <span>{{ $errors->first('google') }}</span>
      </div>
    @endif

    @if (isset($errors) && $errors->has('email') && !$errors->has('google'))
      <div class="alert alert-error">
        <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
        <span>{{ $errors->first('email') }}</span>
      </div>
    @endif

    <!-- Google Sign In Button -->
    <a href="{{ route('google.redirect') }}" class="google-btn">
      <svg width="20" height="20" viewBox="0 0 48 48" aria-hidden="true">
        <path fill="#FFC107" d="M43.6 20.5H42V20H24v8h11.3c-1.6 4.7-6.1 8-11.3 8-6.6 0-12-5.4-12-12s5.4-12 12-12c3.1 0 5.9 1.2 8 3.1l5.7-5.7C34.6 6.1 29.6 4 24 4 12.9 4 4 12.9 4 24s8.9 20 20 20 20-8.9 20-20c0-1.3-.1-2.7-.4-3.5z"/>
        <path fill="#FF3D00" d="M6.3 14.7l6.6 4.8C14.6 15.9 18.9 13 24 13c3.1 0 5.9 1.2 8 3.1l5.7-5.7C34.6 6.1 29.6 4 24 4 16.3 4 9.6 8.3 6.3 14.7z"/>
        <path fill="#4CAF50" d="M24 44c5.5 0 10.4-1.9 14.1-5.1l-6.5-5.5C29.6 35.4 27 36 24 36c-5.2 0-9.6-3.3-11.2-8l-6.6 5.1C9.5 39.6 16.2 44 24 44z"/>
        <path fill="#1976D2" d="M43.6 20.5H42V20H24v8h11.3c-.8 2.3-2.2 4.3-4.1 5.7l6.5 5.5C41.9 36.4 44 30.6 44 24c0-1.3-.1-2.7-.4-3.5z"/>
      </svg>
      <span>Sign In with Google</span>
    </a>

    <div class="divider">
      <span class="line"></span>
      <span>OR</span>
      <span class="line"></span>
    </div>

    <!-- Manual Form -->
    <form method="POST" action="{{ route('login') }}" style="width: 100%; display: flex; flex-direction: column; align-items: center; gap: clamp(24px, 2.8vw, 40px);">
      @csrf

      <div class="fields">
        <div class="field">
          <label for="email">Email</label>
          <div class="input-wrap">
            <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="example@mail.com" required autofocus>
          </div>
          @error('email')
            <span class="field-error">{{ $message }}</span>
          @enderror
        </div>

        <div class="field">
          <label for="password">Password</label>
          <div class="input-wrap">
            <input id="password" type="password" name="password" placeholder="********" required>
            <button type="button" class="toggle-eye" aria-label="Show password" data-target="password">
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
      </div>

      <button type="submit" class="submit-btn">
        <span>Sign In</span>
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M5 12h14M13 6l6 6-6 6"/>
        </svg>
      </button>

      <div class="bottom-row">
        <a href="{{ route('password.request') }}" class="forget-link">Forgot Password?</a>
        <p class="register-text">Don't have account? <a href="{{ route('register') }}">Register here</a></p>
      </div>
    </form>
  </div>

</div>

<script>
  // Toggle password visibility
  document.querySelectorAll('.toggle-eye').forEach(function(btn){
    btn.addEventListener('click', function(){
      var targetId = btn.dataset.target || 'password';
      var input = document.getElementById(targetId);
      if (input) {
        input.type = input.type === 'password' ? 'text' : 'password';
      }
    });
  });
</script>

</body>
</html>
