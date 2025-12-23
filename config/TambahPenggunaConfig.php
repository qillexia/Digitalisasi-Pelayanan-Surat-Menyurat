<?php
session_start();
include '../config/koneksi.php';

$page = 'pengguna'; // Penanda sidebar aktif

// Cek login (Security)
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("location: ../pages/LoginPage.php?pesan=belum_login");
    exit();
}


// Proses Tambah Data
if (isset($_POST['submit'])) {

    // 1. Tangkap & Sanitasi Data (Mencegah SQL Injection sederhana)
    $nama_lengkap = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap']);
    $username     = mysqli_real_escape_string($koneksi, $_POST['username']);
    $email        = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password     = mysqli_real_escape_string($koneksi, $_POST['password']);
    $role         = mysqli_real_escape_string($koneksi, $_POST['role']);
    $status       = mysqli_real_escape_string($koneksi, $_POST['status']);

    // 2. Cek apakah username atau email sudah ada
    $cek_user = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username' OR email='$email'");

    if (mysqli_num_rows($cek_user) > 0) {
        // GAGAL: Username/Email Duplikat
        // Kita kembalikan ke halaman form dengan status gagal
        header("Location: ../components/TambahPengguna.php?status=gagal&pesan=Username atau Email sudah digunakan!");
        exit();
    } else {

        // --- LOGIKA MENCARI ID KOSONG (Sesuai kode asli Anda) ---
        $query_id = mysqli_query($koneksi, "SELECT id_user FROM users ORDER BY id_user ASC");
        $ids = [];
        while ($row = mysqli_fetch_assoc($query_id)) {
            $ids[] = $row['id_user'];
        }

        $new_id = 1;
        while (in_array($new_id, $ids)) {
            $new_id++;
        }
        // --------------------------------------------------------

        // 3. Masukkan data ke Database
        $query = "INSERT INTO users (id_user, nama_lengkap, username, email, password, role, status) 
                  VALUES ('$new_id', '$nama_lengkap', '$username', '$email', '$password', '$role', '$status')";

        if (mysqli_query($koneksi, $query)) {
            // SUKSES
            // Redirect kembali ke halaman TambahPengguna agar Alert Hijau muncul
            header("Location: ../components/Tambah_Pengguna.php?status=sukses");
            exit();
        } else {
            // GAGAL: Error Database
            $error_msg = mysqli_error($koneksi);
            header("Location: ../components/Tambah_Pengguna.php?status=gagal&pesan=Database Error: " . urlencode($error_msg));
            exit();
        }
    }
}
