<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Zarabel — Forget Password</title>

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
  <div class="form-panel forget">
    <h2 class="title-signin">Forget<br>Password</h2>

    @if (isset($errors) && $errors->any())
      <div class="alert alert-error">
        <span>{{ $errors->first() }}</span>
      </div>
    @endif

    <form method="POST" action="{{ route('password.send_code') }}" style="width: 100%; display: flex; flex-direction: column; align-items: center; gap: clamp(24px, 2.8vw, 40px);">
      @csrf

      <div class="fields">
        <div class="field">
          <label for="firstname">First Name</label>
          <div class="input-wrap">
            <input id="firstname" name="firstname" type="text" placeholder="Sarah" value="{{ old('firstname') }}">
          </div>
        </div>

        <div class="field">
          <label for="lastname">Last Name</label>
          <div class="input-wrap">
            <input id="lastname" name="lastname" type="text" placeholder="Amberi" value="{{ old('lastname') }}">
          </div>
        </div>

        <div class="field">
          <label for="email">Email</label>
          <div class="input-wrap">
            <input id="email" name="email" type="email" placeholder="example@mail.com" value="{{ old('email') }}" required>
          </div>
          @error('email')
            <span class="field-error">{{ $message }}</span>
          @enderror
        </div>

        <div class="field">
          <label for="phone">Phone Number</label>
          <div class="input-wrap">
            <input id="phone" name="phone" type="text" placeholder="+62 812-3456-7890" value="{{ old('phone') }}">
          </div>
        </div>
      </div>

      <button type="submit" class="submit-btn">
        <span>Send Confirmation Code</span>
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

</body>
</html>
