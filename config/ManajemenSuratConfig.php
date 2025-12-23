<?php
session_start();
include '../config/koneksi.php';

// 1. Cek Login (Security)
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("location: ../pages/LoginPage.php?pesan=belum_login");
    exit();
}

$page = 'surat'; // Penanda sidebar aktif

// 2. Konfigurasi Pagination
$jumlahDataPerHalaman = 5;
$halamanAktif = (isset($_GET['halaman'])) ? (int)$_GET['halaman'] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

// 3. Logika Pencarian & Filter
$keyword = "";
$whereClause = "WHERE 1=1"; // Default kondisi (True)

if (isset($_GET['cari']) && !empty($_GET['cari'])) {
    $keyword = mysqli_real_escape_string($koneksi, $_GET['cari']);
    // Cari berdasarkan ID Pengajuan, NIK, atau Nama
    $whereClause .= " AND (id_pengajuan LIKE '%$keyword%' OR nik LIKE '%$keyword%' OR nama_lengkap LIKE '%$keyword%')";
}

// 4. Query Total Data (Untuk menghitung jumlah halaman)
$queryTotal = "SELECT COUNT(*) as total FROM pengajuan_surat $whereClause";
$resultTotal = mysqli_query($koneksi, $queryTotal);
$rowTotal = mysqli_fetch_assoc($resultTotal);
$jumlahData = $rowTotal['total'];
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);

// 5. Query Data Utama (Untuk ditampilkan di tabel)
// Urutkan dari yang terbaru (DESC)
$queryData = "SELECT * FROM pengajuan_surat $whereClause ORDER BY id_pengajuan ASC LIMIT $awalData, $jumlahDataPerHalaman";
$result = mysqli_query($koneksi, $queryData);


$status = isset($_GET['status']) ? $_GET['status'] : '';
$pesan  = isset($_GET['pesan']) ? $_GET['pesan'] : '';
?>