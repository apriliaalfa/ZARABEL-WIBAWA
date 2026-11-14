<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Zarabel — Profile</title>

<link rel="icon" type="image/png" href="{{ asset('images/zarabelbg.png') }}">
<link rel="apple-touch-icon" href="{{ asset('images/zarabelbg.png') }}">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Abhaya+Libre:wght@400;700&family=Jost:wght@400&family=Lateef:wght@300&family=Lato:wght@400;500;700&family=Nunito+Sans:wght@600;700;800&family=Playfair+Display:wght@400;500&family=Poppins:wght@300;400;500;600;700&family=Volkhov&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<link rel="stylesheet" href="{{ asset('css/catalog.css') }}">
<link rel="stylesheet" href="{{ asset('css/myorder.css') }}">
</head>
<body>

@include('partials.svg-icons')

<main>

  <!-- ================= HEADER (sudah login) ================= -->
  @include('partials.header-user')

  <!-- ================= SETTINGS HERO ================= -->
  <section class="settings-hero" aria-labelledby="settings-title">
    <div class="settings-copy">
      <h1 id="settings-title">Settings</h1>
      <div class="setting-tabs" aria-label="Settings sections">
        <a href="{{ route('profile') }}" class="selected">Profile</a>
        <button type="button">Notification</button>
        <a href="{{ route('myorder') }}">My Orders</a>
      </div>
    </div>
    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
      @csrf
      <button class="logout" type="submit">
        <span class="avatar">
          @auth
            @if(auth()->user()->avatar)
              <img id="logoutAvatar" src="{{ auth()->user()->avatar }}" alt="" style="width:100%; height:100%; object-fit:cover; border-radius:50%;">
            @else
              <img id="logoutAvatar" src="{{ asset('images/zarabelbg.png') }}" alt="" style="width:100%; height:100%; object-fit:cover; border-radius:50%;">
            @endif
          @endauth
        </span>
        <span>Log Out</span>
        <svg class="ic"><use href="#i-logout"/></svg>
      </button>
    </form>
  </section>

  <!-- ================= PROFILE ================= -->
  <section class="profile-section" id="profilePanel">

    <div class="profile-side">
      <div class="profile-avatar">
        @auth
          @if(auth()->user()->avatar)
            <img id="avatarImg" src="{{ auth()->user()->avatar }}" alt="Foto profil">
          @else
            <img id="avatarImg" src="{{ asset('images/zarabelbg.png') }}" alt="Foto profil">
          @endif
        @endauth
      </div>
      <h2 class="profile-name" id="profileName">{{ auth()->user()->name ?? 'User' }}</h2>
      <p class="profile-role" id="profileRole">Member</p>
      <p class="profile-loc"><svg class="ic"><use href="#i-pin"/></svg><span id="profileLoc">Indonesia</span></p>
      <input type="file" id="avatarFile" accept="image/*" hidden>
      <button class="upload-btn" type="button" id="uploadBtn">Upload new Profile</button>
    </div>

    <form class="profile-form" id="profileForm" autocomplete="off">
      @csrf
      <div class="pf-head">
        <h2>Personal Information</h2>
        <div class="pf-actions">
          <button class="pf-cancel" type="button" id="pfCancel">CANCEL</button>
          <button class="pf-save" type="submit" id="pfSave">SAVE</button>
        </div>
      </div>

      <div class="pf-row">
        <label class="pf-field"><span>First Name</span><input type="text" id="pfFirst" value="{{ explode(' ', auth()->user()->name ?? '')[0] }}"></label>
        <label class="pf-field"><span>Last Name</span><input type="text" id="pfLast" value="{{ implode(' ', array_slice(explode(' ', auth()->user()->name ?? ''), 1)) }}"></label>
      </div>
      <label class="pf-field"><span>Email</span><input type="email" id="pfEmail" value="{{ auth()->user()->email ?? '' }}"></label>
      <label class="pf-field"><span>Phone Number</span><input type="tel" id="pfPhone"></label>
      <label class="pf-field"><span>Date Of Birth</span><input type="date" id="pfDob"></label>
      <label class="pf-field"><span>Occupation</span><input type="text" id="pfJob"></label>
      <label class="pf-field"><span>Address</span><textarea id="pfAddress" rows="3"></textarea></label>
    </form>
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
  var nav = document.getElementById('mainNav');
  var toggle = document.getElementById('menuToggle');
  toggle.addEventListener('click', function(){
    toggle.setAttribute('aria-expanded', nav.classList.toggle('open'));
  });

  // Profil: simpan / batal / upload foto
  var F = { first:'pfFirst', last:'pfLast', email:'pfEmail', phone:'pfPhone', dob:'pfDob', job:'pfJob', address:'pfAddress' };
  function loadProfile(){
    var d = {};
    try { d = JSON.parse(localStorage.getItem('profile') || '{}'); } catch(e) {}
    Object.keys(F).forEach(function(k){
      var el = document.getElementById(F[k]);
      if (el && !el.value) el.value = d[k] || '';
    });
    if (d.job) document.getElementById('profileRole').textContent = d.job;
    if (d.address) document.getElementById('profileLoc').textContent = d.address.split(',')[0] || d.address;
    if (d.avatar) {
      var avMain = document.getElementById('avatarImg');
      var avLogout = document.getElementById('logoutAvatar');
      if (avMain) avMain.src = d.avatar;
      if (avLogout) avLogout.src = d.avatar;
    }
  }
  loadProfile();

  // Variable file avatar yang dipilih
  var selectedAvatarFile = null;

  document.getElementById('profileForm').addEventListener('submit', function(e){
    e.preventDefault();
    var b = document.getElementById('pfSave');
    b.textContent = 'SAVING...';

    var d = {};
    try { d = JSON.parse(localStorage.getItem('profile') || '{}'); } catch(err) {}
    Object.keys(F).forEach(function(k){ d[k] = document.getElementById(F[k]).value.trim(); });
    try { localStorage.setItem('profile', JSON.stringify(d)); } catch(err) {}
    var full = (d.first + ' ' + d.last).trim();
    if (full) localStorage.setItem('customerName', full);
    if (d.address) localStorage.setItem('customerAddress', d.address);

    // Kirim formData ke backend agar tersimpan di database MySQL
    var formData = new FormData();
    formData.append('_token', '{{ csrf_token() }}');
    formData.append('first', d.first || '');
    formData.append('last', d.last || '');
    formData.append('phone', d.phone || '');
    formData.append('address', d.address || '');
    if (selectedAvatarFile) {
      formData.append('avatar', selectedAvatarFile);
    }

    fetch('{{ route("profile.update") }}', {
      method: 'POST',
      body: formData
    })
    .then(function(res){ return res.json(); })
    .then(function(resData){
      b.textContent = 'SAVED';
      setTimeout(function(){ b.textContent = 'SAVE'; }, 1500);
      if (resData.user && resData.user.avatar) {
        var avMain = document.getElementById('avatarImg');
        var avLogout = document.getElementById('logoutAvatar');
        if (avMain) avMain.src = resData.user.avatar;
        if (avLogout) avLogout.src = resData.user.avatar;
        try {
          d.avatar = resData.user.avatar;
          localStorage.setItem('profile', JSON.stringify(d));
        } catch(e) {}
      }
    })
    .catch(function(err){
      b.textContent = 'SAVED';
      setTimeout(function(){ b.textContent = 'SAVE'; }, 1500);
    });
  });
  document.getElementById('pfCancel').addEventListener('click', loadProfile);

  document.getElementById('uploadBtn').addEventListener('click', function(){
    document.getElementById('avatarFile').click();
  });
  document.getElementById('avatarFile').addEventListener('change', function(){
    var f = this.files[0];
    if (!f) return;
    selectedAvatarFile = f;

    // Pratinjau langsung
    var r = new FileReader();
    r.onload = function(){
      var avMain = document.getElementById('avatarImg');
      var avLogout = document.getElementById('logoutAvatar');
      if (avMain) avMain.src = r.result;
      if (avLogout) avLogout.src = r.result;
      try {
        var d = JSON.parse(localStorage.getItem('profile') || '{}');
        d.avatar = r.result;
        localStorage.setItem('profile', JSON.stringify(d));
      } catch(err) {}
    };
    r.readAsDataURL(f);

    // Otomatis simpan avatar ke server
    var formData = new FormData();
    formData.append('_token', '{{ csrf_token() }}');
    formData.append('avatar', f);
    fetch('{{ route("profile.update") }}', {
      method: 'POST',
      body: formData
    })
    .then(function(res){ return res.json(); })
    .then(function(resData){
      if (resData.user && resData.user.avatar) {
        var avMain = document.getElementById('avatarImg');
        var avLogout = document.getElementById('logoutAvatar');
        if (avMain) avMain.src = resData.user.avatar;
        if (avLogout) avLogout.src = resData.user.avatar;
        try {
          var d = JSON.parse(localStorage.getItem('profile') || '{}');
          d.avatar = resData.user.avatar;
          localStorage.setItem('profile', JSON.stringify(d));
        } catch(e) {}
      }
    });
  });
</script>

</body>
</html>




