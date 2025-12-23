<?php
// Pastikan session hanya dimulai jika belum ada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// 1. HUBUNGKAN KE DATABASE
// Asumsi file ini ada di folder config, jadi include sesama folder config cukup panggil namanya
include 'koneksi.php'; 

// Cek Login
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    // Arahkan kembali ke login jika belum login
    header("location: ../pages/LoginPage.php?pesan=belum_login");
    exit();
}

$page = 'dashboard';

// ==========================================
// LOGIKA MENGHITUNG DATA KARTU (CARD)
// ==========================================
function hitungData($koneksi, $query) {
    $result = mysqli_query($koneksi, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['jumlah'];
}

$totalSurat = hitungData($koneksi, "SELECT COUNT(*) as jumlah FROM pengajuan_surat");
$totalMenunggu = hitungData($koneksi, "SELECT COUNT(*) as jumlah FROM pengajuan_surat WHERE status_pengajuan IN ('Pending', 'Diproses')");
$totalSelesai = hitungData($koneksi, "SELECT COUNT(*) as jumlah FROM pengajuan_surat WHERE status_pengajuan = 'Selesai'");

// ==========================================
// LOGIKA DATA UNTUK CHART (GRAFIK)
// ==========================================

// A. Data Grafik Tren Bulanan
$dataBulan = array_fill(1, 12, 0); 
$tahunIni = date('Y');

$queryGrafik = mysqli_query($koneksi, "
    SELECT MONTH(tanggal_pengajuan) as bulan, COUNT(*) as jumlah 
    FROM pengajuan_surat 
    WHERE YEAR(tanggal_pengajuan) = '$tahunIni' 
    GROUP BY MONTH(tanggal_pengajuan)
");

while($rowG = mysqli_fetch_assoc($queryGrafik)) {
    $dataBulan[$rowG['bulan']] = $rowG['jumlah'];
}
$jsonGrafikBulan = json_encode(array_values($dataBulan));

// B. Data Grafik Status Donat
$qStatus = mysqli_query($koneksi, "SELECT status_pengajuan, COUNT(*) as jumlah FROM pengajuan_surat GROUP BY status_pengajuan");
$dataStatus = ['Selesai' => 0, 'Pending' => 0, 'Ditolak' => 0];

while($rowS = mysqli_fetch_assoc($qStatus)) {
    $st = $rowS['status_pengajuan'];
    $jml = $rowS['jumlah'];
    
    if($st == 'Selesai') $dataStatus['Selesai'] += $jml;
    elseif($st == 'Ditolak') $dataStatus['Ditolak'] += $jml;
    else $dataStatus['Pending'] += $jml;
}
$jsonStatus = json_encode(array_values($dataStatus));
?>