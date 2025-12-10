<?php
// config/koneksi.php

$host     = "localhost";
$username = "root";
$password = "";          // Kosongkan jika pakai XAMPP default
$database = "db_surat_menyurat"; // Pastikan nama ini sesuai dengan database yang Anda buat di phpMyAdmin

// Buat koneksi
$koneksi = mysqli_connect($host, $username, $password, $database);

// Cek koneksi (Opsional, untuk debugging)
if (!$koneksi) {
    die("Koneksi Database Gagal: " . mysqli_connect_error());
}
?>