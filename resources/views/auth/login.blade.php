<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - E-Aspirasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .card { border: none; border-radius: 15px; }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow p-4">
                    <h3 class="text-center fw-bold mb-4">LOGIN</h3>
                    
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <form action="{{ route('login.post') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Login Sebagai</label>
                            <select name="role" id="roleSelect" class="form-select" onchange="toggleFields()" required>
                                <option value="siswa">Siswa</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>

                        <div class="mb-3" id="nisGroup">
                            <label class="form-label">NIS</label>
                            <input type="number" name="nis" class="form-control" placeholder="Masukkan NIS Anda">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Masukkan Username" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Masukkan Password" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">MASUK</button>
                    </form>

                    <div class="text-center mt-3">
                        <p class="small text-muted">Siswa belum punya akun? <a href="{{ route('register') }}" class="text-decoration-none">Daftar Sekarang</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleFields() {
            const role = document.getElementById('roleSelect').value;
            const nisGroup = document.getElementById('nisGroup');
            const nisInput = nisGroup.querySelector('input');

            if (role === 'admin') {
                nisGroup.style.display = 'none';
                nisInput.required = false;
            } else {
                nisGroup.style.display = 'block';
                nisInput.required = true;
            }
        }
        // Jalankan saat halaman pertama kali dimuat
        window.onload = toggleFields;
    </script>
</body>
</html>