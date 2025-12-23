<?php
session_start();
include '../config/koneksi.php';

// Cek apakah user sudah login
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("location: ../pages/LoginPage.php?pesan=belum_login");
    exit();
}

// Ambil username dari session
$username_session = $_SESSION['username'];

// Ambil data user dari database berdasarkan username session
$query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username_session'");
$data = mysqli_fetch_assoc($query);

// Jika data tidak ditemukan (misal user dihapus saat sedang login)
if (!$data) {
    session_destroy();
    header("location: ../pages/LoginPage.php");
    exit();
}

// --- PROSES UPDATE PROFIL ---
if (isset($_POST['update_profil'])) {
    $nama_lengkap = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap']);
    $username_baru = mysqli_real_escape_string($koneksi, $_POST['username']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password_lama = mysqli_real_escape_string($koneksi, $_POST['password_lama']);
    $password_baru = mysqli_real_escape_string($koneksi, $_POST['password_baru']);

    // Cek apakah username baru sudah dipakai orang lain (kecuali diri sendiri)
    $cek_username = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username_baru' AND id_user != '{$data['id_user']}'");

    if (mysqli_num_rows($cek_username) > 0) {
        echo "<script>alert('Username sudah digunakan pengguna lain!');</script>";
    } else {
        $query_update = "";
        $error = false;

        // Logika Ganti Password
        if (!empty($password_lama) || !empty($password_baru)) {
            // Jika salah satu kolom password diisi, maka user berniat ganti password
            if ($password_lama == $data['password']) { // Cek password lama (Plain text sesuai sistem Anda)
                if (!empty($password_baru)) {
                    $query_update = "UPDATE users SET nama_lengkap='$nama_lengkap', username='$username_baru', email='$email', password='$password_baru' WHERE id_user='{$data['id_user']}'";
                } else {
                    echo "<script>alert('Password baru tidak boleh kosong!');</script>";
                    $error = true;
                }
            } else {
                echo "<script>alert('Password lama salah!');</script>";
                $error = true;
            }
        } else {
            // Update tanpa ganti password
            $query_update = "UPDATE users SET nama_lengkap='$nama_lengkap', username='$username_baru', email='$email' WHERE id_user='{$data['id_user']}'";
        }

        // Eksekusi Query jika tidak ada error
        if (!$error && !empty($query_update)) {
            if (mysqli_query($koneksi, $query_update)) {
                // Update Session dengan data baru
                $_SESSION['username'] = $username_baru;
                $_SESSION['nama'] = $nama_lengkap;

                echo "<script>alert('Profil berhasil diperbarui!'); window.location='Pengaturan.php';</script>";
            } else {
                echo "<script>alert('Gagal memperbarui profil: " . mysqli_error($koneksi) . "');</script>";
            }
        }
    }
}
?>
