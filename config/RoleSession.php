<?php

$nama_user = isset($_SESSION['nama']) ? $_SESSION['nama'] : 'Admin';
// Cek apakah session sudah dimulai, jika belum start session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Ambil role dari session, default ke 'user' jika tidak ada
// Saya tambahkan strtolower agar tidak sensitif huruf besar/kecil
$role_session = isset($_SESSION['role']) ? strtolower(trim($_SESSION['role'])) : 'user';

$label_role = "Pengguna"; // Default awal

switch ($role_session) {
    case 'admin':
        $label_role = "Administrator";
        break;

    case 'kades':
        $label_role = "Kepala Desa";
        break;

    case 'user':
        $label_role = "Warga Desa";
        break;

    case 'petugas':
        $label_role = "Petugas Pelayanan";
        break;

    default:
        $label_role = ucfirst($role_session); // Fallback: Huruf depan kapital
        break;
}
