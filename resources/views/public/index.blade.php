<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMARU - PUYANG</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
<style>
/* =========================
   GLOBAL STYLE
========================= */
body {
  font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
  background: linear-gradient(135deg, #eff6ff, #eef2ff);
  color: #1f2933;
}

.hero {
  padding: 40px 20px 40px;
  text-align: center;
}

.hero img {
  max-width: 260px;
  margin-bottom: 20px;
  animation: fadeDown 1s ease;
}

.hero h1 {
  font-weight: 800;
  font-size: clamp(2rem, 4vw, 3rem);
  background: linear-gradient(90deg, #2563eb, #4f46e5);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

.hero p {
  max-width: 720px;
  margin: 12px auto;
  color: #475569;
  font-size: 1.05rem;
}

/* =========================
   SEARCH BOX
========================= */
.search-card {
  border-radius: 20px;
  border: none;
  box-shadow: 0 20px 50px rgba(37,99,235,0.12);
}

.search-card input {
  border-radius: 14px;
  border: 1px solid #e5e7eb;
  padding: 16px 18px;
}

.search-card input:focus {
  border-color: #4f46e5;
  box-shadow: 0 0 0 3px rgba(79,70,229,0.15);
}

.search-card button {
  border-radius: 14px;
  font-weight: 600;
  padding: 0 28px;
}

/* =========================
   MAP
========================= */
.map-card {
  border-radius: 24px;
  overflow: hidden;
  border: none;
  box-shadow: 0 30px 80px rgba(15,23,42,0.12);
}

/* =========================
   RESULT CARD
========================= */
.hover-shadow {
  border-radius: 20px;
  border: none;
  transition: all .3s ease;
  box-shadow: 0 10px 30px rgba(15,23,42,0.08);
}

.hover-shadow:hover {
  transform: translateY(-6px);
  box-shadow: 0 25px 60px rgba(37,99,235,0.18);
}

/* =========================
   LIVE SEARCH
========================= */
#liveSearchResults {
  position: absolute;
  width: 100%;
  z-index: 99;
  border-radius: 14px;
  overflow: hidden;
}

#liveSearchResults div:hover {
  background: #f1f5ff;
}

/* =========================
   ANIMATION
========================= */
@keyframes fadeDown {
  from {
    opacity: 0;
    transform: translateY(-15px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
.card-simaru {
  border: none;
  border-radius: 20px;
  box-shadow: 0 20px 50px rgba(15,23,42,.12);
}
</style>

  </head>
<body>

<nav class="navbar navbar-expand-lg bg-body-tertiary shadow-sm">
  <div class="container-fluid">
    <img src="{{ asset('img/logo_kkn.png') }}" alt="KKN UPY 56 PUYANG" class="me-2" style="height:60px;">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link fw-bold px-3" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fw-bold px-3" aria-current="page" href="#">About</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="min-vh-100 bg-light p-4" style="background: linear-gradient(135deg, #eff6ff, #e0e7ff);">
  <div class="container">

    <!-- Header -->
    <div class="hero">
      <img src="{{ asset('img/logo_simaru.png') }}" alt="SIMARU">
      <p class="fw-semibold">
        Sistem Informasi Map Rumah Warga – Puyang, Purwoharjo, Samigaluh, Kulon Progo
      </p>
      <p>
        Temukan data dan lokasi rumah warga secara cepat, akurat, dan interaktif melalui sistem pemetaan digital.
      </p>
    </div>


    <!-- Search Form -->
    <div class="card search-card mb-5 position-relative">
      <div class="card-body p-3">
        <div class="d-flex gap-2">
          <input 
            type="text"
            id="searchInput"
            placeholder="Cari nama KK / nomor rumah..." 
            value="{{ $q ?? '' }}"
            class="form-control form-control-sm"
            style="font-size: 1.05rem;"
          >
          <button id="searchBtn" type="button" class="btn btn-primary btn-sm" style="font-size: 1.05rem;">
            <i class="bi bi-search"></i>
          </button>
        </div>

        <div id="liveSearchResults" class="mt-2 bg-white d-none"></div>
      </div>
    </div>
<!-- Results -->
    @if($q !== null && $q !== '')
      <div class="mb-4">
        <div class="p-4 text-white rounded-top" style="background: linear-gradient(90deg, #2563eb, #4f46e5);">
          <h2 class="fw-bold">Hasil Pencarian</h2>
          <p class="mb-0 pb-3">Ditemukan {{ count($houses) }} rumah</p>
        </div>

        @if(count($houses) > 0)
          <div class="row g-4 p-4 bg-white shadow rounded-bottom">
            @foreach($houses as $h)
              <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-2 hover-shadow">

                  <div style="height:200px; overflow:hidden;">
                    <img 
                      src="https://static-maps.yandex.ru/1.x/?ll={{ $h->longitude }},{{ $h->latitude }}&size=400,300&z=16&l=map&pt={{ $h->longitude }},{{ $h->latitude }},pm2lbm"
                      class="w-100 h-100 object-fit-cover"
                    >
                    <span class="badge bg-primary position-absolute top-0 end-0 m-2">
                      RT {{ $h->rt }}
                    </span>
                  </div>

                  <div class="card-body">
                    <h5 class="fw-bold">{{ $h->kk_name }}</h5>
                    <small class="text-muted d-block mb-3">
                      {{ number_format($h->latitude, 6) }}, {{ number_format($h->longitude, 6) }}
                    </small>

                    <a target="_blank"
                       href="https://www.google.com/maps?q={{ $h->latitude }},{{ $h->longitude }}"
                       class="btn btn-success w-100">
                       📍 Buka di Google Maps
                    </a>
                  </div>

                </div>
              </div>
            @endforeach
          </div>
        @else
          <div class="p-5 text-center text-muted bg-white shadow rounded-bottom">
            <h5>❌ Tidak ada hasil pencarian</h5>
            <small>Coba cari dengan nama KK atau nomor rumah yang lain</small>
          </div>
        @endif
      </div>
    @endif
    <!-- Maps Section -->
    <div class="card map-card mb-5 ">
      <div class="card-body p-0">
        <div id="map" style="height:520px;"></div>
      </div>
    </div>

    

  </div>
</div>

<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<!-- Data untuk JavaScript (Blade Template) -->
@php
  $housesJson = json_encode($houses ?? []);
  $searchQueryJson = json_encode($q ?? null);
  $allHousesJson = json_encode(\App\Models\House::all());
@endphp

<script>
// Data dari server
var houses = {!! $housesJson !!};
var searchQuery = {!! $searchQueryJson !!};
var allHouses = {!! $allHousesJson !!};


var map = L.map('map').setView([-7.5,110], 13);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors'
}).addTo(map);

var mapMarkersLayer = L.featureGroup();
mapMarkersLayer.addTo(map);

// Fungsi untuk clear map dan update dengan houses baru
function updateMapMarkers(housesToShow) {
    mapMarkersLayer.clearLayers();
    
    if (housesToShow.length === 0) {
        // Tampilkan semua rumah jika tidak ada filter
        allHouses.forEach(h => {
            L.marker([h.latitude, h.longitude], {
                title: h.kk_name + ' - RT ' + h.rt
            })
             .addTo(mapMarkersLayer)
             .bindPopup(`<b>${h.kk_name}</b><br>RT ${h.rt}`);
        });
        
        if (allHouses.length > 0) {
            map.fitBounds(mapMarkersLayer.getBounds().pad(0.1));
        }
    } else {
        // Tampilkan hanya hasil pencarian
        housesToShow.forEach(h => {
            L.marker([h.latitude, h.longitude], {
                title: h.kk_name + ' - RT ' + h.rt
            })
             .addTo(mapMarkersLayer)
             .bindPopup(`<b>${h.kk_name}</b><br>RT ${h.rt}<br><a href="https://www.google.com/maps?q=${h.latitude},${h.longitude}" target="_blank">📍 Google Maps</a>`);
        });

        // Auto-scroll ke lokasi rumah pertama
        if (housesToShow.length > 0) {
            var firstHouse = housesToShow[0];
            map.setView([firstHouse.latitude, firstHouse.longitude], 17);
        }
    }
}

// Initial render
if (!searchQuery || searchQuery === '') {
    updateMapMarkers([]);
} else if (houses.length > 0) {
    updateMapMarkers(houses);
}

// ===== LIVE SEARCH =====
const searchInput = document.getElementById('searchInput');
const searchBtn = document.getElementById('searchBtn');
const liveSearchResults = document.getElementById('liveSearchResults');
let searchTimeout;

function performSearch(query) {
    if (query.length === 0) {
        liveSearchResults.classList.add('d-none');
        updateMapMarkers([]);
        return;
    }

    fetch(`/api/live-search?q=${encodeURIComponent(query)}`)
        .then(response => response.json())
        .then(data => {
            if (data.houses.length === 0) {
                liveSearchResults.innerHTML = `
                    <div class="p-3 text-center text-muted">
                        <p>Tidak ada hasil untuk "${query}"</p>
                    </div>
                `;
                liveSearchResults.classList.remove('d-none');
                updateMapMarkers([]);
            } else {
                // Tampilkan dropdown hasil
                let html = '<div class="border-top">';
                data.houses.forEach(house => {
                    html += `
                        <div class="p-3 border-bottom" style="cursor: pointer;" onclick="selectHouse('${house.kk_name}', ${house.latitude}, ${house.longitude})">
                            <p class="fw-semibold text-dark mb-0">${house.kk_name}</p>
                        </div>
                    `;
                });
                html += '</div>';
                liveSearchResults.innerHTML = html;
                liveSearchResults.classList.remove('d-none');
                
                // Update maps dengan hasil pencarian
                updateMapMarkers(data.houses);
            }
        })
        .catch(error => console.error('Error:', error));
}

// Event listener untuk live search dengan debounce
searchInput.addEventListener('input', (e) => {
    clearTimeout(searchTimeout);
    const query = e.target.value.trim();
    
    searchTimeout = setTimeout(() => {
        performSearch(query);
    }, 300); // Debounce 300ms
});

// Klik tombol Cari untuk submit form
searchBtn.addEventListener('click', (e) => {
    const query = searchInput.value.trim();
    if (query.length > 0) {
        window.location.href = `/?q=${encodeURIComponent(query)}`;
    }
});

// Fungsi untuk select result dari dropdown
function selectHouse(kkName, latitude, longitude) {
    searchInput.value = kkName;
    liveSearchResults.classList.add('d-none');
    map.setView([latitude, longitude], 17);
}

// Hide dropdown saat klik di luar
document.addEventListener('click', (e) => {
    if (!e.target.closest('#searchInput') && !e.target.closest('#liveSearchResults')) {
        liveSearchResults.classList.add('d-none');
    }
});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>

<!-- Footer -->
<footer class="bg-light text-dark py-4 shadow-sm">
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