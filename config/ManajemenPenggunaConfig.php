<?php
session_start();
include '../config/koneksi.php';

// 1. Cek Login
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("location: ../pages/LoginPage.php?pesan=belum_login");
    exit();
}

$page = 'pengguna';

// 2. TANGKAP STATUS ALERT (Penting untuk menampilkan Alert di View)
$status = isset($_GET['status']) ? $_GET['status'] : '';
$pesan  = isset($_GET['pesan']) ? $_GET['pesan'] : '';

// --- KONFIGURASI PAGINATION ---
$jumlahDataPerHalaman = 5; 
$halamanAktif = (isset($_GET['halaman'])) ? (int)$_GET['halaman'] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

// --- LOGIKA PENCARIAN & QUERY DATA ---
$keyword = "";
if (isset($_GET['cari'])) {
    $keyword = mysqli_real_escape_string($koneksi, $_GET['cari']);
    $query_str = "SELECT * FROM users WHERE nama_lengkap LIKE '%$keyword%' OR username LIKE '%$keyword%' OR email LIKE '%$keyword%'";
} else {
    $query_str = "SELECT * FROM users";
}

// Hitung Total Data (untuk pagination)
$result_total = mysqli_query($koneksi, $query_str);
$jumlahData = mysqli_num_rows($result_total);
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);

// Ambil Data Sesuai Halaman (LIMIT)
// Tetap ASC sesuai permintaan (jangan ubah logika)
$query_final = $query_str . " ORDER BY id_user ASC LIMIT $awalData, $jumlahDataPerHalaman";
$query = mysqli_query($koneksi, $query_final);
?>