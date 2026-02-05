<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Lupa Password - SIMARU</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #ecfeff, #eef2ff);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card-auth {
            border: none;
            border-radius: 22px;
            box-shadow: 0 25px 80px rgba(15,23,42,.15);
            overflow: hidden;
        }

        .auth-header {
            text-align: center;
            padding: 40px 30px 10px;
        }

        .auth-header img {
            max-width: 220px;
            margin-bottom: 15px;
        }

        .auth-header h5 {
            color: #475569;
            font-weight: 600;
        }

        .form-control {
            border-radius: 12px;
            padding: 12px 14px;
        }

        .btn-primary {
            border-radius: 12px;
            padding: 12px;
            font-weight: 600;
            background: linear-gradient(135deg, #0d6efd, #0891b2);
            border: none;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #0891b2, #22c55e);
        }
    </style>
</head>
<body>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6 col-lg-5 col-xl-4">

      <div class="card card-auth">

        <!-- HEADER -->
        <div class="auth-header">
          <img src="{{ asset('img/logo_simaru.png') }}" alt="SIMARU">
          <p>Sistem Informasi Map Rumah Warga</p>
        </div>

        <!-- BODY -->
        <div class="card-body px-4 pb-4">

          @if (session('status'))
            <div class="alert alert-success">
              {{ session('status') }}
            </div>
          @endif

          <p class="text small mb-3 text-center">
            Masukkan email yang terdaftar, kami akan mengirimkan link untuk reset password.
          </p>

          <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email -->
            <div class="mb-3">
              <label class="form-label fw-semibold">Email</label>
              <input type="email" 
                     name="email" 
                     value="{{ old('email') }}" 
                     class="form-control @error('email') is-invalid @enderror" 
                     placeholder="Masukkan email"
                     required autofocus>

              @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Button -->
            <button type="submit" class="btn btn-primary w-100">
              Kirim Link Reset Password
            </button>
          </form>

          <div class="text-center mt-3">
            <a href="{{ route('login') }}" class="text-decoration-none small">
              ← Kembali ke Login
            </a>
          </div>

        </div>
      </div>

      <p class="text-center mt-4 text-muted small">
        © {{ date('Y') }} SIMARU – KKN UPY 56 Dusun Puyang
      </p>

    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
