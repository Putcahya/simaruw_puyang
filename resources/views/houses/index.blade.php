<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMARU - PUYANG</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- DataTables -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
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

<body class="bg-light" style="background: linear-gradient(135deg, #eff6ff, #e0e7ff);">
<nav class="navbar navbar-expand-lg bg-body-tertiary shadow-sm">
  <div class="container-fluid">
    <img src="{{ asset('img/logo_kkn.png') }}" alt="KKN UPY 56 PUYANG" class="me-2" style="height:60px;">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link fw-bold px-3" aria-current="page" href="/home">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fw-bold px-3" aria-current="page" href="/houses">Data Rumah</a>
        </li>
      </ul>
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle fw-bold px-3" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            ⚙️ {{ Auth::user()->name ?? 'User' }}
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">👤 Profile Saya</a></li>
            <li><hr class="dropdown-divider"></li>
            <li>
              <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <button type="submit" class="dropdown-item" style="border:none; background:none; cursor:pointer;">
                  🚪 Logout
                </button>
              </form>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="container py-5" >
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <!-- Header -->
    <div class="hero">
      <img src="{{ asset('img/logo_simaru.png') }}" alt="SIMARU">
      <p class="fw-semibold">
        Sistem Informasi Map Rumah Warga – Puyang, Purwoharjo, Samigaluh, Kulon Progo
      </p>
    </div>

    <div class="card card-simaru">
        <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-4">
              <h2 class="fw-bold">🏠 Data Rumah</h2>
              <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal" onclick="resetAddForm()">
                  + Tambah Rumah
              </button>
          </div>
            <table id="housesTable" class="table table-bordered table-hover align-middle">
                <thead class="table-light text-center">
                    <tr class="text-center">
                        <th>No</th>
                        <th>No Rumah</th>
                        <th>Nama KK</th>
                        <th>RW</th>
                        <th>RT</th>
                        <th>Dusun</th>
                        <th>Kalurahan</th>
                        <th>Kecamatan</th>
                        <th>Kabupaten</th>
                        <th>Provinsi</th>
                        <th width="160">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($houses as $h)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center">{{ $h->house_number }}</td>
                        <td>{{ $h->kk_name }}</td>
                        <td class="text-center">{{ $h->rw }}</td>
                        <td class="text-center">{{ $h->rt }}</td>
                        <td class="text-center">{{ $h->dusun }}</td>
                        <td class="text-center">{{ $h->kalurahan }}</td>
                        <td class="text-center">{{ $h->kecamatan }}</td>
                        <td class="text-center">{{ $h->kabupaten }}</td>
                        <td class="text-center">{{ $h->provinsi }}</td>
                        <td class="text-center">
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal" 
                                onclick="loadEditData({{ $h->id }}, '{{ $h->kk_name }}', '{{ $h->house_number }}', '{{ $h->rw }}', '{{ $h->rt }}', '{{ $h->dusun }}', '{{ $h->kalurahan }}', '{{ $h->kecamatan }}', '{{ $h->kabupaten }}', '{{ $h->provinsi }}', {{ $h->latitude }}, {{ $h->longitude }})">
                                ✏ Edit
                            </button>

                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal"
                                onclick="setDeleteId({{ $h->id }}, '{{ $h->kk_name }}')">
                                🗑 Hapus
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>

<!-- JS -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function () {
    $('#housesTable').DataTable({
        pageLength: 10,
        lengthMenu: [5, 10, 25, 50],
        language: {
            search: "🔍 Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ - _END_ dari _TOTAL_ rumah",
            paginate: {
                first: "Awal",
                last: "Akhir",
                next: "›",
                previous: "‹"
            },
            zeroRecords: "Data tidak ditemukan",
        }
    });
});
</script>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title fw-bold">⚠️ Konfirmasi Hapus</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="mb-0">Apakah Anda yakin ingin menghapus data rumah atas nama <strong id="deleteNameDisplay"></strong>?</p>
        <p class="text-muted small mt-2">Tindakan ini tidak dapat dibatalkan.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <form id="deleteForm" method="POST" class="d-inline">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger">🗑️ Hapus Data</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title fw-bold">Tambah Data Rumah Baru</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="addForm" method="POST" action="{{ route('houses.store') }}">
        @csrf
        <div class="modal-body">
          
          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label fw-bold">Nomor Rumah</label>
              <input type="text" name="house_number" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label fw-bold">Nama KK</label>
              <input type="text" name="kk_name" class="form-control" required>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-3">
              <label class="form-label fw-bold">RW</label>
              <select name="rw" class="form-select">
                <option value="">-- Pilih RW --</option>
                <option value="9">9</option>
                <option value="10">10</option>
              </select>
            </div>
            <div class="col-md-3">
              <label class="form-label fw-bold">RT</label>
              <select name="rt" class="form-select">
                <option value="">-- Pilih RT --</option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="20">20</option>
                <option value="21">21</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label fw-bold">Dusun</label>
              <input type="hidden" name="dusun" class="form-control" value="Puyang">
              <input type="text" class="form-control" value="Puyang" disabled>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label fw-bold">Kalurahan</label>
              <input type="hidden" name="kalurahan" class="form-control" value="Purwoharjo">
              <input type="text" class="form-control" value="Purwoharjo" disabled>
            </div>
            <div class="col-md-6">
              <label class="form-label fw-bold">Kapanewon</label>
              <input type="hidden" name="kecamatan" class="form-control" value="Samigaluh">
              <input type="text" class="form-control" value="Samigaluh" disabled>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label fw-bold">Kabupaten</label>
              <input type="hidden" name="kabupaten" class="form-control" value="Kulon Progo">
              <input type="text" class="form-control" value="Kulon Progo" disabled>
            </div>
            <div class="col-md-6">
              <label class="form-label fw-bold">Provinsi</label>
              <input type="hidden" name="provinsi" class="form-control" value="DI Yogyakarta">
              <input type="text" class="form-control" value="DI Yogyakarta" disabled>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label fw-bold">Latitude</label>
              <input type="number" name="latitude" step="0.000001" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label fw-bold">Longitude</label>
              <input type="number" name="longitude" step="0.000001" class="form-control" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-success">➕ Tambah Rumah</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title fw-bold">Edit Data Rumah</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="editForm" method="POST" action="">
        @csrf
        @method('PUT')
        <div class="modal-body">
          
          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label fw-bold">Nomor Rumah</label>
              <input type="text" name="house_number" id="house_number" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label fw-bold">Nama KK</label>
              <input type="text" name="kk_name" id="kk_name" class="form-control" required>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-3">
              <label class="form-label fw-bold">RW</label>
              <select name="rw" id="rw" class="form-select" required>
                <option value="">-- Pilih RW --</option>
                <option value="9">9</option>
                <option value="10">10</option>
              </select>
            </div>
            <div class="col-md-3">
              <label class="form-label fw-bold">RT</label>
              <select name="rt" id="rt" class="form-select" required>
                <option value="">-- Pilih RT --</option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="20">20</option>
                <option value="21">21</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label fw-bold">Dusun</label>
              <input type="hidden" name="dusun" id="dusun" class="form-control" value="Puyang" required>
              <input type="text" class="form-control" value="Puyang" disabled>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label fw-bold">Kalurahan</label>
              <input type="hidden" name="kalurahan" id="kalurahan" class="form-control" value="Purwoharjo" required>
              <input type="text" class="form-control" value="Purwoharjo" disabled>
            </div>
            <div class="col-md-6">
              <label class="form-label fw-bold">Kapanewon</label>
              <input type="hidden" name="kecamatan" id="kecamatan" class="form-control" value="Samigaluh" required>
              <input type="text" class="form-control" value="Samigaluh" disabled>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label fw-bold">Kabupaten</label>
              <input type="hidden" name="kabupaten" id="kabupaten" class="form-control" value="Kulon Progo" required>
              <input type="text" class="form-control" value="Kulon Progo" disabled>
            </div>
            <div class="col-md-6">
              <label class="form-label fw-bold">Provinsi</label>
              <input type="hidden" name="provinsi" id="provinsi" class="form-control" value="DI Yogyakarta" required>
              <input type="text" class="form-control" value="DI Yogyakarta" disabled>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label fw-bold">Latitude</label>
              <input type="number" name="latitude" id="latitude" step="0.000001" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label fw-bold">Longitude</label>
              <input type="number" name="longitude" id="longitude" step="0.000001" class="form-control" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">💾 Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
function loadEditData(id, kk_name, house_number, rw, rt, dusun, kalurahan, kecamatan, kabupaten, provinsi, latitude, longitude) {
  document.getElementById('house_number').value = house_number;
  document.getElementById('kk_name').value = kk_name;
  document.getElementById('rw').value = rw;
  document.getElementById('rt').value = rt;
  document.getElementById('dusun').value = dusun;
  document.getElementById('kalurahan').value = kalurahan;
  document.getElementById('kecamatan').value = kecamatan;
  document.getElementById('kabupaten').value = kabupaten;
  document.getElementById('provinsi').value = provinsi;
  document.getElementById('latitude').value = latitude;
  document.getElementById('longitude').value = longitude;
  
  // Set form action ke route update dengan benar
  const form = document.getElementById('editForm');
  form.action = `/houses/${id}`;
}

// Reset Add Form
function resetAddForm() {
  document.getElementById('addForm').reset();
}

// Set Delete ID and Name
function setDeleteId(id, kkName) {
  document.getElementById('deleteNameDisplay').textContent = kkName;
  const deleteForm = document.getElementById('deleteForm');
  deleteForm.action = `/houses/${id}`;
}
</script>

<!-- Footer -->
<footer class="bg-light text-dark mt-5 py-4 shadow-sm">
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
