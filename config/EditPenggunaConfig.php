<?php
session_start();
include '../config/koneksi.php';

// Cek login
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("location: ../pages/LoginPage.php?pesan=belum_login");
    exit();
}

// Ambil ID dari URL
if (!isset($_GET['id'])) {
    header("location: ../components/ManajemenPengguna.php");
    exit();
}

// Sanitasi ID untuk keamanan
$id_user = mysqli_real_escape_string($koneksi, $_GET['id']);

// Ambil data user
$query = mysqli_query($koneksi, "SELECT * FROM users WHERE id_user = '$id_user'");
$data = mysqli_fetch_assoc($query);

// Jika user tidak ditemukan, lempar balik
if (!$data) {
    header("location: ../components/ManajemenPengguna.php?status=notfound");
    exit();
}

// Proses Update Data
if (isset($_POST['update'])) {
    $nama_lengkap = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap']);
    $username     = mysqli_real_escape_string($koneksi, $_POST['username']);
    $email        = mysqli_real_escape_string($koneksi, $_POST['email']);
    $role         = mysqli_real_escape_string($koneksi, $_POST['role']);
    $status       = mysqli_real_escape_string($koneksi, $_POST['status']);

    // Cek apakah password diubah
    if (!empty($_POST['password'])) {
        $password = mysqli_real_escape_string($koneksi, $_POST['password']);
        $query_update = "UPDATE users SET nama_lengkap='$nama_lengkap', username='$username', email='$email', password='$password', role='$role', status='$status' WHERE id_user='$id_user'";
    } else {
        $query_update = "UPDATE users SET nama_lengkap='$nama_lengkap', username='$username', email='$email', role='$role', status='$status' WHERE id_user='$id_user'";
    }

    if (mysqli_query($koneksi, $query_update)) {
        // SUKSES: Redirect dengan status sukses ke halaman Edit ini sendiri
        header("Location: ../components/Edit_Pengguna.php?id=$id_user&status=sukses");
        exit();
    } else {
        // GAGAL: Redirect dengan status gagal
        $error = mysqli_error($koneksi);
        header("Location: ../components/Edit_Pengguna.php?id=$id_user&status=gagal&pesan=" . urlencode($error));
        exit();
    }
}
