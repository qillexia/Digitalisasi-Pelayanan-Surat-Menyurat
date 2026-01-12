# Digitalisasi Pelayanan Surat Menyurat

Aplikasi berbasis web untuk digitalisasi, pengelolaan, dan pelacakan pelayanan surat-menyurat. Sistem ini dirancang untuk mempermudah instansi dalam manajemen pengguna, pengajuan surat, pemrosesan, hingga pelaporan.

## Fitur Utama

- **Dashboard**: Gambaran umum statistik surat dan aktivitas.
- **Manajemen Pengguna**:
  - Tambah, Edit, dan Hapus pengguna.
  - Pengaturan peran (Role).
- **Manajemen Surat**:
  - Pengajuan Surat baru.
  - Pemrosesan status surat (Disetujui, Ditolak, dll).
  - Cetak Surat (Template dinamis).
  - Riwayat dan Arsip Surat.
- **Laporan**: Rekapitulasi data surat.
- **Notifikasi Email**: Pemberitahuan otomatis status surat menggunakan PHPMailer.
- **Antarmuka Responsif**: Mendukung tampilan desktop dan mobile.

## Teknologi yang Digunakan

- **Backend**: PHP Native
- **Frontend**: HTML, CSS, JavaScript
- **Database**: MySQL
- **Library Pihak Ketiga**:
  - [PHPMailer](https://github.com/PHPMailer/PHPMailer) untuk pengiriman email.
  - Composer untuk manajemen dependensi.

## Struktur Folder

```
/
├── components/       # Komponen UI (Dashboard, Sidebar, Manajemen User/Surat)
├── config/           # Konfigurasi DB, Helper, dan Logika Pemrosesan
├── css/              # Stylesheet aplikasi
├── database/         # File SQL untuk import database
├── js/               # Script JavaScript (Charts, Modals, Toggle)
├── Pages/            # Halaman utama (Login, Landing Page)
├── templates/        # Template Email dan Cetak Surat
├── uploads/          # Folder penyimpanan file upload
└── vendor/           # Dependensi Composer
```

## Cara Instalasi

1. **Clone Repository**
   ```bash
   git clone https://github.com/username/Digitalisasi-Pelayanan-Surat-Menyurat.git
   ```

2. **Persiapan Database**
   - Buat database baru di MySQL dengan nama `db_surat_menyurat`.
   - Import file `database/db_surat_menyurat.sql` ke dalam database tersebut.

3. **Konfigurasi Koneksi**
   - Buka file `config/koneksi.php`.
   - Sesuaikan konfigurasi database dengan lingkungan lokal Anda:
     ```php
     $host     = "localhost";
     $username = "root";       // User database Anda
     $password = "";           // Password database Anda
     $database = "db_surat_menyurat";
     ```

4. **Instalasi Dependensi (Opsional)**
   - Jika folder `vendor/` belum ada, jalankan perintah berikut di terminal:
     ```bash
     composer install
     ```

5. **Menjalankan Aplikasi**
   - Pastikan web server (Apache/Nginx) dan MySQL sudah berjalan (contoh: via XAMPP/Laragon).
   - Akses aplikasi melalui browser, misalnya:
     `http://localhost/Digitalisasi-Pelayanan-Surat-Menyurat/Pages/LandingPage.php` atau `LoginPage.php`

## Lisensi

[MIT License](LICENSE)
