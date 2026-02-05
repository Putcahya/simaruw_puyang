<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
        /* =========================
           GLOBAL STYLE
        ========================= */
        body {
            font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, #eff6ff, #eef2ff);
            color: #1f2933;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .navbar-simaru {
            background: white;
            box-shadow: 0 4px 12px rgba(15,23,42,0.08);
            padding: 12px 0;
        }

        .navbar-simaru img {
            height: 60px;
        }

        .error-section {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }

        .error-container {
            text-align: center;
            max-width: 600px;
        }

        .error-code {
            font-size: 7rem;
            font-weight: 800;
            background: linear-gradient(90deg, #2563eb, #4f46e5);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin: 0;
            line-height: 1;
            animation: fadeDown 0.6s ease;
        }

        .error-title {
            font-size: 1.8rem;
            font-weight: 700;
            margin: 20px 0;
            color: #1f2933;
        }

        .error-message {
            font-size: 1rem;
            color: #475569;
            margin-bottom: 40px;
            line-height: 1.6;
        }

        .btn-home {
            background: linear-gradient(90deg, #2563eb, #4f46e5);
            border: none;
            color: white;
            padding: 14px 36px;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 14px;
            transition: all 0.3s ease;
            display: inline-block;
            text-decoration: none;
        }

        .btn-home:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(37, 99, 235, 0.3);
            color: white;
        }

        .illustration {
            margin: 30px 0;
            opacity: 0.9;
        }

        .footer-404 {
            background: #f8fafc;
            padding: 30px 20px;
            text-align: center;
            border-top: 1px solid #e2e8f0;
            color: #64748b;
            font-size: 0.9rem;
        }

        @keyframes fadeDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            .error-code {
                font-size: 5rem;
            }

            .error-title {
                font-size: 1.5rem;
            }

            .error-message {
                font-size: 0.95rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-simaru sticky-top">
        <div class="container-fluid">
            <div class="d-flex align-items-center">
                <img src="{{ asset('img/logo_kkn.png') }}" alt="KKN UPY 56 PUYANG" class="me-2">
                <span class="fw-bold text-dark">SIMARU - PUYANG</span>
            </div>
        </div>
    </nav>

    <!-- Error Section -->
    <div class="error-section">
        <div class="error-container">
            <!-- Logo SIMARU -->
            <div class="mb-4">
                <img src="{{ asset('img/logo_simaru.png') }}" alt="SIMARU Logo" style="max-width: 200px; height: auto; animation: fadeDown 0.8s ease;">
            </div>

            <!-- Error Code -->
            <h1 class="error-code">404</h1>
            
            <!-- Error Title -->
            <h2 class="error-title">Halaman Tidak Ditemukan</h2>
            
            <!-- Error Message -->
            <p class="error-message">
                Maaf, halaman yang Anda cari tidak dapat ditemukan. Silakan periksa URL atau kembali ke halaman utama SIMARU.
            </p>

            <!-- Illustration -->
            <div class="illustration">
                <i class="bi bi-exclamation-triangle" style="font-size: 4rem; color: #2563eb; opacity: 0.3;"></i>
            </div>

            <!-- Button -->
            <a href="{{ url('/') }}" class="btn-home">
                ← Kembali ke Beranda
            </a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer-404">
        <p class="mb-0">&copy; 2026 SIMARU - KKN UPY 56 PUYANG. All Rights Reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
