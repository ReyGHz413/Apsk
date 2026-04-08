<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Aspirasi - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Detail Aspirasi</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-7">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white fw-bold py-3">Laporan Siswa</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="text-muted small">Foto Bukti:</label>
                            @if($aspirasi->foto)
                                <img src="{{ asset('upload_aspirasi/'.$aspirasi->foto) }}" class="img-fluid rounded d-block mt-2 border" style="max-height: 400px;">
                            @else
                                <div class="p-4 bg-light text-center rounded border mt-2">Tidak ada foto</div>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label class="text-muted small">Pelapor:</label>
                                <p class="fw-bold">{{ $aspirasi->siswa->username }} ({{ $aspirasi->nis }})</p>
                            </div>
                            <div class="col-6 mb-3">
                                <label class="text-muted small">Kategori:</label>
                                <p class="fw-bold">{{ $aspirasi->kategori->ket_kategori }}</p>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="text-muted small">Lokasi Kejadian:</label>
                                <p class="fw-bold">{{ $aspirasi->lokasi }}</p>
                            </div>
                            <div class="col-12">
                                <label class="text-muted small">Isi Laporan:</label>
                                <p class="bg-light p-3 rounded border">{{ $aspirasi->ket }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-dark text-white fw-bold py-3">Berikan Tanggapan</div>
                    <div class="card-body">
                        <form action="{{ route('admin.tanggapi', $aspirasi->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="id_kategori_hidden" value="{{ $aspirasi->id_kategori }}">
                            
                            <div class="mb-3">
                                <label class="form-label fw-bold">Update Status</label>
                                <select name="status" class="form-select border-primary">
                                    <option value="Menunggu" {{ ($aspirasi->tanggapan->status ?? '') == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                                    <option value="Proses" {{ ($aspirasi->tanggapan->status ?? '') == 'Proses' ? 'selected' : '' }}>Dalam Proses</option>
                                    <option value="Selesai" {{ ($aspirasi->tanggapan->status ?? '') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Tanggapan / Feedback</label>
                                <textarea name="feedback" class="form-control" rows="5" maxlength="200" placeholder="Tulis tanggapan untuk siswa..." required>{{ $aspirasi->tanggapan->feedback ?? '' }}</textarea>
                                <div class="form-text text-end">Maks. 200 karakter</div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">Simpan & Kirim Tanggapan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>