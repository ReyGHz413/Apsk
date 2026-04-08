<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa - E-Aspirasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#"><i class="bi bi-megaphone-fill me-2"></i>E-Aspirasi</a>
            <div class="d-flex align-items-center">
                <span class="text-white me-3 small">Halo, {{ Auth::guard('siswa')->user()->username }}</span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-light btn-sm fw-bold text-primary">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold">Riwayat Aspirasi Anda</h3>
            <a href="{{ route('siswa.input') }}" class="btn btn-primary shadow-sm">
                <i class="bi bi-plus-lg me-1"></i> Buat Pengaduan
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row">
            @forelse($aspirasis as $item)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        @if($item->foto)
                            <img src="{{ asset('upload_aspirasi/'.$item->foto) }}" class="card-img-top" style="height: 180px; object-fit: cover;">
                        @endif
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="badge bg-info text-dark">{{ $item->kategori->ket_kategori }}</span>
                                <small class="text-muted">{{ $item->created_at->format('d/m/Y') }}</small>
                            </div>
                            <h6 class="fw-bold text-truncate">{{ $item->lokasi }}</h6>
                            <p class="card-text text-muted small text-truncate-2" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                {{ $item->ket }}
                            </p>
                        </div>
                        <div class="card-footer bg-white border-0 d-flex justify-content-between align-items-center pb-3">
                            @php
                                $status = $item->tanggapan->status ?? 'Menunggu';
                                $badgeColor = $status == 'Selesai' ? 'success' : ($status == 'Proses' ? 'warning text-dark' : 'danger');
                            @endphp
                            <span class="badge bg-{{ $badgeColor }}">{{ $status }}</span>
                            <a href="{{ route('siswa.detail', $item->id) }}" class="btn btn-sm btn-outline-primary">Detail</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <i class="bi bi-inbox text-muted" style="font-size: 3rem;"></i>
                    <p class="mt-2 text-muted">Anda belum pernah mengirim aspirasi.</p>
                </div>
            @endforelse
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>