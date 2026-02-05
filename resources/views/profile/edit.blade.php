<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Profile - SIMARU</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
  background: linear-gradient(135deg, #eff6ff, #e0e7ff);
}

.card-simaru {
  border: none;
  border-radius: 20px;
  box-shadow: 0 20px 50px rgba(15,23,42,.12);
}
</style>
</head>

<body class="bg-light" style="background: linear-gradient(135deg, #eff6ff, #e0e7ff);">

<!-- NAVBAR (samakan dengan halaman utama) -->
<nav class="navbar navbar-expand-lg bg-body-tertiary shadow-sm">
  <div class="container-fluid">
    <img src="{{ asset('img/logo_kkn.png') }}" style="height:60px" class="me-2">

    <div class="collapse navbar-collapse">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link fw-bold px-3" href="/houses">Home</a>
        </li>
      </ul>

      <ul class="navbar-nav ms-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle fw-bold px-3" href="#" role="button" data-bs-toggle="dropdown">
            ⚙️ {{ Auth::user()->name }}
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item active" href="{{ route('profile.edit') }}">👤 Profile Saya</a></li>
            <li><hr class="dropdown-divider"></li>
            <li>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="dropdown-item">🚪 Logout</button>
              </form>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- CONTENT -->
<div class="container py-5">


  <div class="row g-4 justify-content-center">

    <div class="col-lg-4">
      <div class="card card-simaru p-4">
        @include('profile.partials.update-profile-information-form')
      </div>
    </div>

    <div class="col-lg-4">
      <div class="card card-simaru p-4">
        @include('profile.partials.update-password-form')
      </div>
    </div>

  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- Footer -->
<footer class="bg-light text-dark mt-5 py-4 shadow-sm ">
  <div class="container">
    <div class="row align-items-center mb-4">
      <div class="col-md-4 mb-3 mb-md-0">
        <div class="d-flex align-items-center gap-3">
          <img src="{{ asset('img/logo_simaru.png') }}" alt="SIMARU Logo" style="max-width: 200px; height: auto;">
        </div>
      </div>
      <div class="col-md-4 mb-3 mb-md-0">
        <h6 class="fw-bold">Kontak</h6>
        <p class="small">
          Instagram : <a href="https://www.instagram.com/puyang.berkembang" class="text-dark" style="text-decoration: none;">puyang.berkembang</a><br>
          Youtube : <a href="https://www.youtube.com/@puyang_berkembang" class="text-dark" style="text-decoration: none;">KKN 56 PUYANG 2026</a>
        </p>
        <h6 class="fw-bold">Alamat</h6>
        <p class="small">
         <span>Puyang, Purwoharjo, Samigaluh, Kulon Progo</span>
        </p>
      </div>
      <div class="col-md-4">
        <div class="text-md-end">
          <h6 class="fw-bold mb-2">Didukung oleh</h6>
          <img src="{{ asset('img/logo_kkn.png') }}" alt="KKN Logo" style="max-width: 150px; height: auto;">
        </div>
      </div>
    </div>
    <hr class="bg-secondary">
    <div class="text-center">
      <p class="small text-muted mb-0">&copy; 2026 SIMARU - KKN UPY 41 KEL-56. All Rights Reserved.</p>
    </div>
  </div>
</footer>
</body>
</html>
