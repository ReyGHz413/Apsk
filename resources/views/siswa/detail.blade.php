<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Aspirasi - E-Aspirasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        .card-img-detail {
            width: 100%;
            max-height: 400px;
            object-fit: contain;
            background-color: #f8f9fa;
            border-radius: 8px;
        }
        .status-badge {
            font-size: 0.9rem;
            padding: 8px 16px;
            border-radius: 50px;
        }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4 shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('siswa.dashboard') }}">
                <i class="bi bi-megaphone-fill me-2"></i>E-Aspirasi
            </a>
            <a href="{{ route('siswa.dashboard') }}" class="btn btn-light btn-sm fw-bold text-primary">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </nav>

    <div class="container pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="fw-bold mb-0">Rincian Laporan</h4>
                    @php
                        $status = $aspirasi->tanggapan->status ?? 'Menunggu';
                        $color = match($status) {
                            'Selesai' => 'success',
                            'Proses' => 'warning text-dark',
                            default => 'danger'
                        };
                    @endphp
                    <span class="badge bg-{{ $color }} status-badge">
                        Status: {{ $status }}
                    </span>
                </div>

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        @if($aspirasi->foto)
                            <div class="mb-4 text-center">
                                <img src="{{ asset('upload_aspirasi/'.$aspirasi->foto) }}" alt="Foto Laporan" class="card-img-detail shadow-sm">
                            </div>
                        @endif

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="text-muted small d-block text-uppercase fw-bold">Kategori</label>
                                <span class="fw-bold text-primary">{{ $aspirasi->kategori->ket_kategori }}</span>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small d-block text-uppercase fw-bold">Tanggal Lapor</label>
                                <span class="fw-bold">{{ $aspirasi->created_at->format('d F Y - H:i') }} WIB</span>
                            </div>
                            <div class="col-md-12">
                                <label class="text-muted small d-block text-uppercase fw-bold">Lokasi Kejadian</label>
                                <span class="fw-bold"><i class="bi bi-geo-alt-fill text-danger me-1"></i>{{ $aspirasi->lokasi }}</span>
                            </div>
                        </div>

                        <hr>

                        <div class="mt-3">
                            <label class="text-muted small d-block text-uppercase fw-bold mb-2">Isi Aspirasi / Keterangan</label>
                            <p class="text-dark shadow-sm p-3 bg-light rounded" style="white-space: pre-wrap; line-height: 1.6;">{{ $aspirasi->ket }}</p>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm border-start border-4 border-primary">
                    <div class="card-header bg-white py-3">
                        <h6 class="fw-bold mb-0"><i class="bi bi-chat-left-dots-fill text-primary me-2"></i>Tanggapan Admin</h6>
                    </div>
                    <div class="card-body p-4">
                        @if($aspirasi->tanggapan)
                            <div class="d-flex justify-content-between mb-3">
                                <span class="badge bg-primary">Respon Resmi</span>
                                <small class="text-muted">{{ $aspirasi->tanggapan->created_at->format('d M Y, H:i') }}</small>
                            </div>
                            <p class="mb-0" style="line-height: 1.6;">{{ $aspirasi->tanggapan->feedback }}</p>
                        @else
                            <div class="text-center py-3">
                                <i class="bi bi-hourglass-split text-muted mb-2" style="font-size: 2rem;"></i>
                                <p class="text-muted mb-0 italic">Laporan Anda belum ditanggapi oleh petugas. Mohon bersabar.</p>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>