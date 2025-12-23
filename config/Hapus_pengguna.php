<?php
session_start();
include '../config/koneksi.php';

// Cek Login
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("location: ../pages/LoginPage.php");
    exit();
}

// Cek ID
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);

    $query = "DELETE FROM users WHERE id_user='$id'";
    
    if (mysqli_query($koneksi, $query)) {
        // SUKSES: Redirect dengan status sukses (biar muncul alert hijau di dashboard)
        header("Location: ../components/ManajemenPengguna.php?status=hapus_sukses");
    } else {
        // GAGAL: Redirect dengan status gagal
        header("Location: ../components/ManajemenPengguna.php?status=gagal&pesan=Database Error");
    }
} else {
    header("Location: ../components/ManajemenPengguna.php");
}
?>