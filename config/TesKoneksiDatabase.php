<?php
// components/Dashboard.php

// 1. Panggil koneksi database
// Gunakan "../" untuk mundur satu folder (keluar dari components, masuk ke config)
include '../config/koneksi.php';

// 2. Cek apakah koneksi berhasil (Hanya untuk testing, nanti bisa dihapus)
if ($koneksi) {
    echo "<div style='background-color: #d4edda; color: #155724; padding: 10px; border: 1px solid #c3e6cb; margin-bottom: 10px;'>
            ✅ Koneksi Database Berhasil!
          </div>";
} else {
    echo "<div style='background-color: #f8d7da; color: #721c24; padding: 10px; border: 1px solid #f5c6cb; margin-bottom: 10px;'>
            ❌ Koneksi Gagal: " . mysqli_connect_error() . "
          </div>";
}
?>