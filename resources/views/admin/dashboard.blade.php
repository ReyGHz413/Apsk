<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - E-Aspirasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        .navbar-brand { font-size: 1.5rem; }
        .nav-link { font-weight: 500; }
        .nav-link.active { color: #fff !important; border-bottom: 2px solid #fff; }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('admin.dashboard') }}">
                <i class="bi bi-shield-lock-fill me-2"></i>Admin Panel
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                            <i class="bi bi-chat-left-text me-1"></i> Daftar Aspirasi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('admin.kategori.*') ? 'active' : '' }}" href="{{ route('admin.kategori.index') }}">
                            <i class="bi bi-tags me-1"></i> Kelola Kategori
                        </a>
                    </li>
                </ul>
                <div class="d-flex align-items-center">
                    <span class="text-secondary me-3 small">Administrator</span>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-outline-danger btn-sm fw-bold">
                            <i class="bi bi-box-arrow-right me-1"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-uppercase fw-bold mb-0">Daftar Aspirasi Siswa</h2>
            <span class="badge bg-dark px-3 py-2">Total: {{ $aspirasis->count() }} Laporan</span>
        </div>

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white fw-bold py-3">
                <i class="bi bi-search me-2"></i> Filter Pencarian
            </div>
            <div class="card-body">
                <form action="{{ route('admin.dashboard') }}" method="GET" class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label small fw-bold text-muted">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" value="{{ request('tanggal') }}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small fw-bold text-muted">Bulan</label>
                        <input type="month" name="bulan" class="form-control" value="{{ request('bulan') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-bold text-muted">Siswa</label>
                        <select name="nis" class="form-select">
                            <option value="">Semua Siswa</option>
                            @foreach($siswas as $s)
                                <option value="{{ $s->nis }}" {{ request('nis') == $s->nis ? 'selected' : '' }}>
                                    {{ $s->username }} ({{ $s->nis }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small fw-bold text-muted">Kategori</label>
                        <select name="id_kategori" class="form-select">
                            <option value="">Semua Kategori</option>
                            @foreach($kategoris as $k)
                                <option value="{{ $k->id_kategori }}" {{ request('id_kategori') == $k->id_kategori ? 'selected' : '' }}>
                                    {{ $k->ket_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 d-flex align-items-end gap-2">
                        <button type="submit" class="btn btn-primary w-100" title="Terapkan Filter">
                            <i class="bi bi-funnel"></i>
                        </button>
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary w-100" title="Reset Filter">
                            <i class="bi bi-arrow-clockwise"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="card border-0 shadow-sm overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th class="ps-4 py-3">Tgl Lapor</th>
                            <th>Siswa</th>
                            <th>Kategori</th>
                            <th>Lokasi</th>
                            <th>Status</th>
                            <th class="text-center pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($aspirasis as $item)
                        <tr>
                            <td class="ps-4">
                                <span class="d-block fw-bold small">{{ $item->created_at->format('d M Y') }}</span>
                                <span class="text-muted smaller" style="font-size: 0.75rem;">{{ $item->created_at->format('H:i') }} WIB</span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm bg-light rounded-circle me-2 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                        <i class="bi bi-person-circle text-secondary"></i>
                                    </div>
                                    <div>
                                        <span class="d-block fw-bold">{{ $item->siswa->username }}</span>
                                        <small class="text-muted">{{ $item->nis }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle">
                                    {{ $item->kategori->ket_kategori }}
                                </span>
                            </td>
                            <td>{{ $item->lokasi }}</td>
                            <td>
                                @php
                                    $status = $item->tanggapan->status ?? 'Menunggu';
                                    $color = match($status) {
                                        'Selesai' => 'success',
                                        'Proses' => 'warning',
                                        default => 'danger'
                                    };
                                @endphp
                                <span class="badge rounded-pill bg-{{ $color }}">
                                    <i class="bi bi-circle-fill me-1 small"></i>{{ $status }}
                                </span>
                            </td>
                            <td class="text-center pe-4">
                                <a href="{{ route('admin.detail', $item->id) }}" class="btn btn-sm btn-outline-primary fw-bold">
                                    <i class="bi bi-chat-quote me-1"></i> Tanggapi
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted italic">
                                <i class="bi bi-clipboard-x d-block mb-2" style="font-size: 2rem;"></i>
                                Belum ada data aspirasi yang ditemukan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>