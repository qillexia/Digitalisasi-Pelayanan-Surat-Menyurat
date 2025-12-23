<?php
session_start();
include '../config/koneksi.php'; // Panggil koneksi

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);

    // Mencari user di database
    $query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username' AND password='$password'");
    $cek = mysqli_num_rows($query);

    if ($cek > 0) {
        $data = mysqli_fetch_assoc($query);
        
        // Simpan data ke session agar bisa dipakai di dashboard
        $_SESSION['id_user'] = $data['id_user']; // <--- TAMBAHKAN BARIS INI (Pastikan nama kolom di DB adalah id_user)
        $_SESSION['username'] = $username;
        $_SESSION['nama'] = $data['nama_lengkap'];
        $_SESSION['status'] = "login";
        $_SESSION['role'] = $data['role'];

        // Alihkan ke dashboard
        header("location: ../components/Dashboard.php");
    } else {
        // Jika gagal, balik ke login dengan pesan error
        header("location: ../pages/LoginPage.php?pesan=gagal");
    }
}
?>