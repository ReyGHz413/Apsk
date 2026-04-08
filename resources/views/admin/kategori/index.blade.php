<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kategori - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="d-flex align-items-center">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary me-3">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
                <h3 class="fw-bold mb-0 text-uppercase">Kelola Kategori</h3>
            </div>
            <button class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#addModal">
                <i class="bi bi-plus-lg me-1"></i> Kategori Baru
            </button>
        </div>

        @if(session('success')) 
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div> 
        @endif

        <div class="card border-0 shadow-sm overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th class="ps-4 py-3" style="width: 100px;">ID</th>
                            <th>Nama Kategori</th>
                            <th class="text-center pe-4" style="width: 200px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kategoris as $k)
                        <tr>
                            <td class="ps-4 fw-bold text-muted">#{{ $k->id_kategori }}</td>
                            <td class="fw-bold">{{ $k->ket_kategori }}</td>
                            <td class="text-center pe-4">
                                <button class="btn btn-sm btn-warning fw-bold text-white me-1" data-bs-toggle="modal" data-bs-target="#editModal{{ $k->id_kategori }}">
                                    <i class="bi bi-pencil-square me-1"></i> Edit
                                </button>
                                <form action="{{ route('admin.kategori.destroy', $k->id_kategori) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger fw-bold" onclick="return confirm('Hapus kategori ini? Semua aspirasi dengan kategori ini juga akan terhapus.')">
                                        <i class="bi bi-trash me-1"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <div class="modal fade" id="editModal{{ $k->id_kategori }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow">
                                    <form action="{{ route('admin.kategori.update', $k->id_kategori) }}" method="POST">
                                        @csrf @method('PUT')
                                        <div class="modal-header bg-warning text-white">
                                            <h5 class="modal-title fw-bold"><i class="bi bi-pencil-square me-2"></i>Edit Kategori</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body py-4">
                                            <label class="form-label small fw-bold text-muted">NAMA KATEGORI</label>
                                            <input type="text" name="ket_kategori" class="form-control form-control-lg" value="{{ $k->ket_kategori }}" required>
                                        </div>
                                        <div class="modal-footer bg-light">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-warning text-white fw-bold">Simpan Perubahan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-5 text-muted italic">
                                <i class="bi bi-tags d-block mb-2" style="font-size: 2rem;"></i>
                                Belum ada kategori yang ditambahkan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <form action="{{ route('admin.kategori.store') }}" method="POST">
                    @csrf
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title fw-bold"><i class="bi bi-plus-circle me-2"></i>Tambah Kategori Baru</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body py-4">
                        <label class="form-label small fw-bold text-muted">NAMA KATEGORI</label>
                        <input type="text" name="ket_kategori" class="form-control form-control-lg" placeholder="Contoh: Kebersihan" required>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary fw-bold">Tambah Kategori</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>