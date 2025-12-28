<?php
// SESSION
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// KONEKSI DATABASE
include 'koneksi.php';

// CEK LOGIN
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("location: ../pages/LoginPage.php?pesan=belum_login");
    exit();
}

// PAGE
$page = 'dashboard';

// HITUNG DATA
function hitungData($koneksi, $query) {
    $result = mysqli_query($koneksi, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['jumlah'];
}

// DATA CARD
$totalSurat    = hitungData($koneksi, "SELECT COUNT(*) as jumlah FROM pengajuan_surat");
$totalMenunggu = hitungData($koneksi, "SELECT COUNT(*) as jumlah FROM pengajuan_surat WHERE status_pengajuan IN ('Pending', 'Diproses')");
$totalSelesai  = hitungData($koneksi, "SELECT COUNT(*) as jumlah FROM pengajuan_surat WHERE status_pengajuan = 'Selesai'");

// DATA GRAFIK BULANAN
$dataBulan = array_fill(1, 12, 0);
$tahunIni = date('Y');

$queryGrafik = mysqli_query($koneksi, "
    SELECT MONTH(tanggal_pengajuan) as bulan, COUNT(*) as jumlah
    FROM pengajuan_surat
    WHERE YEAR(tanggal_pengajuan) = '$tahunIni'
    GROUP BY MONTH(tanggal_pengajuan)
");

while ($rowG = mysqli_fetch_assoc($queryGrafik)) {
    $dataBulan[$rowG['bulan']] = $rowG['jumlah'];
}

$jsonGrafikBulan = json_encode(array_values($dataBulan));

// DATA STATUS
$qStatus = mysqli_query($koneksi, "SELECT status_pengajuan, COUNT(*) as jumlah FROM pengajuan_surat GROUP BY status_pengajuan");

$dataStatus = [
    'Selesai' => 0,
    'Pending' => 0,
    'Ditolak' => 0
];

while ($rowS = mysqli_fetch_assoc($qStatus)) {
    if ($rowS['status_pengajuan'] == 'Selesai') {
        $dataStatus['Selesai'] += $rowS['jumlah'];
    } elseif ($rowS['status_pengajuan'] == 'Ditolak') {
        $dataStatus['Ditolak'] += $rowS['jumlah'];
    } else {
        $dataStatus['Pending'] += $rowS['jumlah'];
    }
}

$jsonStatus = json_encode(array_values($dataStatus));
