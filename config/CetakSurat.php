<?php

// 1. Load koneksi
include 'koneksi.php';

// 2. Load helper (hanya fungsi, tanpa query)
include 'helpers/SuratHelper.php';

// 3. Ambil data surat
$id_surat = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id_surat <= 0) {
    die("ID Surat tidak valid");
}

$query = mysqli_query($koneksi, "SELECT * FROM pengajuan_surat WHERE id_pengajuan = '$id_surat'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    die("Data tidak ditemukan");
}

// 4. Siapkan variabel untuk template
$judul_surat = getJudulSurat($data['jenis_surat']);
$nomor_surat = formatNomorSurat($data['id_pengajuan']);
$tanggal_cetak = tgl_indo(date('Y-m-d'));

// 5. Load template tampilan
include '../templates/surat/template_cetak.php';
?>