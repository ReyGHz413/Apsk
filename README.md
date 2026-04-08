# E-Aspirasi - Sistem Pengaduan Siswa Online

E-Aspirasi adalah platform berbasis web yang dikembangkan menggunakan **Laravel 11** untuk memudahkan siswa dalam menyampaikan aspirasi, keluhan, atau laporan terkait fasilitas dan layanan sekolah secara digital.

## 🚀 Fitur Utama

- **Multi-Auth System**: Pemisahan akses antara **Siswa** dan **Admin/Petugas**.
- **Kelola Aspirasi**: Siswa dapat mengirim laporan lengkap dengan foto kejadian.
- **Tanggapan Real-time**: Admin dapat menanggapi laporan dan mengubah status (Menunggu, Proses, Selesai).
- **Manajemen Kategori**: CRUD kategori aspirasi yang dinamis oleh Admin.
- **Security Middleware**: 
    - `PreventBackHistory`: Mencegah user kembali ke dashboard setelah logout.
    - `Authentication Guards`: Memastikan keamanan data antar role.
- **UI Responsif**: Menggunakan Bootstrap 5 dan Bootstrap Icons.

## 🛠️ Teknologi yang Digunakan

- **Framework:** Laravel 11
- **Bahasa Pemrograman:** PHP 8.2+
- **Database:** MySQL
- **Frontend:** Blade Templating, Bootstrap 5
- **Icons:** Bootstrap Icons

## 📋 Prasyarat Instalasi

Pastikan Anda sudah menginstal:
- PHP >= 8.2
- Composer
- MySQL / MariaDB
- Web Server (Apache/Nginx)

## 🔧 Cara Instalasi

1. **Clone Repository**
   bash
   git clone [https://github.com/ReyGHz413/e-aspirasi.git](https://github.com/ReyGHz413/e-aspirasi.git)
   cd e-aspirasi


2.  **Instal Dependensi**

    ```bash
    composer install
    ```

3.  **Konfigurasi Environment**
    Salin file `.env.example` menjadi `.env` dan sesuaikan pengaturan database Anda.

    ```bash
    cp .env.example .env
    ```

4.  **Generate App Key**

    ```bash
    php artisan key:generate
    ```

5.  **Migrasi Database**

    ```bash
    php artisan migrate
    ```

6.  **Menjalankan Server**

    ```bash
    php artisan serve
    ```

    Akses di browser: `http://127.0.0.1:8000`

## 📂 Struktur Database (Relasi)

Project ini memiliki relasi database yang solid:

  - `siswas` memiliki banyak `aspirasis` (One-to-Many).
  - `kategoris` memiliki banyak `aspirasis` (One-to-Many).
  - `aspirasis` memiliki satu `tanggapans` (One-to-One).

## 👤 Akun Demo (Optional)

*Jika Anda menyertakan seeder, tuliskan akun di sini.*

  - **Admin:** admin@gmail.com / password
  - **Siswa:** NIS Siswa / password

-----

Developed by [ReyGHz413](https://www.google.com/search?q=https://github.com/ReyGHz413)
