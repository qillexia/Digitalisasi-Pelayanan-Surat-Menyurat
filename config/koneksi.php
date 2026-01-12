<?php
// config/koneksi.php

$host     = "localhost";
$username = "root";
$password = "2181";          // Kosongkan kalo pake windows
$database = "db_surat_menyurat"; // Pastikan nama ini sesuai dengan database yang Anda buat di phpMyAdmin

// Buat koneksi
$koneksi = mysqli_connect($host, $username, $password, $database);

// Cek koneksi (Opsional, untuk debugging)
if (!$koneksi) {
    die("Koneksi Database Gagal: " . mysqli_connect_error());
}
?>