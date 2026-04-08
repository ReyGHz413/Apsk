<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Pengaduan - E-Aspirasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border-0 shadow">
                    <div class="card-header bg-primary text-white py-3">
                        <h5 class="card-title mb-0 fw-bold">Form Input Aspirasi</h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('siswa.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label fw-bold">Kategori Aspirasi</label>
                                <select name="id_kategori" class="form-select" required>
                                    <option value="" selected disabled>Pilih Kategori...</option>
                                    @foreach($kategoris as $k)
                                        <option value="{{ $k->id_kategori }}">{{ $k->ket_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Lokasi Kejadian</label>
                                <input type="text" name="lokasi" class="form-control" placeholder="Misal: Kantin, Lab Komputer" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Keterangan Laporan</label>
                                <textarea name="ket" class="form-control" rows="5" placeholder="Jelaskan secara detail..." required></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Foto Bukti</label>
                                <input type="file" name="foto" class="form-control" accept="image/*" required>
                                <small class="text-muted">Gunakan file gambar (JPG, PNG, JPEG) maks 2MB.</small>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">Kirim Laporan</button>
                                <a href="{{ route('siswa.dashboard') }}" class="btn btn-light">Kembali ke Dashboard</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>