<?php
session_start();
include 'koneksi.php';

// Cek apakah ada ID yang dikirim
if (isset($_GET['id'])) {

    // Ambil ID dan bersihkan
    $id_pengajuan = mysqli_real_escape_string($koneksi, $_GET['id']);

    // (Opsional) Ambil nama file gambar dulu untuk dihapus dari folder
    $querySelect = "SELECT file_ktp, file_kk FROM pengajuan_surat WHERE id_pengajuan = '$id_pengajuan'";
    $resultSelect = mysqli_query($koneksi, $querySelect);

    if ($row = mysqli_fetch_assoc($resultSelect)) {
        // Hapus file fisik jika ada
        $pathKTP = "../uploads/" . $row['file_ktp'];
        $pathKK = "../uploads/" . $row['file_kk'];

        if (file_exists($pathKTP)) unlink($pathKTP);
        if (file_exists($pathKK)) unlink($pathKK);
    }

    // Jalankan Query Hapus Database
    $queryDelete = "DELETE FROM pengajuan_surat WHERE id_pengajuan = '$id_pengajuan'";

    if (mysqli_query($koneksi, $queryDelete)) {
        header("Location: ../components/ManajemenSurat.php?status=hapus_sukses");
    } else {
        $error = mysqli_error($koneksi);
        header("Location: ../components/ManajemenSurat.php?status=gagal&pesan=" . urlencode($error));
    }
} else {
    // Jika akses tanpa ID
    header("Location: ../components/ManajemenSurat.php");
}
