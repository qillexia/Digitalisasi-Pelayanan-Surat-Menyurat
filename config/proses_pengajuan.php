<?php
session_start();
include '../config/koneksi.php'; // Koneksi tetap di folder config
$nama_user = isset($_SESSION['nama']) ? $_SESSION['nama'] : 'Admin';


// Cek apakah tombol submit ditekan
if (isset($_POST['jenis_surat'])) {

    // 1. Tangkap Data
    // (Nama variabel harus sama persis dengan name="" di form HTML)
    $jenis_surat        = mysqli_real_escape_string($koneksi, $_POST['jenis_surat']);
    $nik                = mysqli_real_escape_string($koneksi, $_POST['nik']);
    $nama_lengkap       = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap']);
    $tempat_lahir       = mysqli_real_escape_string($koneksi, $_POST['tempat_lahir']);
    $tanggal_lahir      = mysqli_real_escape_string($koneksi, $_POST['tanggal_lahir']);
    $whatsapp           = mysqli_real_escape_string($koneksi, $_POST['whatsapp']);
    $pekerjaan          = mysqli_real_escape_string($koneksi, $_POST['pekerjaan']);
    $agama              = mysqli_real_escape_string($koneksi, $_POST['agama']);
    $lingkungan         = mysqli_real_escape_string($koneksi, $_POST['lingkungan']);
    $jenis_kelamin      = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']);
    $status_perkawinan  = mysqli_real_escape_string($koneksi, $_POST['status_perkawinan']);
    $nama_orang_tua     = mysqli_real_escape_string($koneksi, $_POST['nama_orang_tua']);
    $alamat             = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $keperluan          = mysqli_real_escape_string($koneksi, $_POST['keperluan']);
    
    // --- PERUBAHAN DI SINI ---
    
    // 1. Pastikan session id_user ada (dari proses_login.php)
    if (!isset($_SESSION['id_user'])) {
        header("Location: ../pages/LoginPage.php?pesan=belum_login");
        exit();
    }
    $id_user_login = $_SESSION['id_user'];

    // 2. Ambil email dari tabel users
    $query_user = mysqli_query($koneksi, "SELECT email FROM users WHERE id_user = '$id_user_login'");
    $data_user = mysqli_fetch_assoc($query_user);
    $email = $data_user['email']; 

    // 3. Validasi jika user belum punya email di profilnya
    if (empty($email)) {
        header("Location: ../components/PengajuanSurat.php?status=gagal&pesan=Email akun Anda kosong. Harap lengkapi profil terlebih dahulu.");
        exit();
    }
    // -------------------------

    // 2. Upload File
    $target_dir = "../uploads/";
    
    // Buat folder jika belum ada (PENTING)
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $allowed_types = array('jpg', 'jpeg', 'png', 'pdf');
    $max_size = 2 * 1024 * 1024; // 2MB

    function uploadFile($fileInputName, $nik, $suffix, $target_dir, $allowed_types, $max_size) {
        $filename = $_FILES[$fileInputName]['name'];
        $filesize = $_FILES[$fileInputName]['size'];
        $filetmp  = $_FILES[$fileInputName]['tmp_name'];
        $fileext  = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        if (!in_array($fileext, $allowed_types)) return "error_ext";
        if ($filesize > $max_size) return "error_size";

        $new_filename = $nik . '_' . $suffix . '_' . time() . '.' . $fileext;
        $target_file = $target_dir . $new_filename;

        if (move_uploaded_file($filetmp, $target_file)) {
            return $new_filename;
        } else {
            return "error_upload";
        }
    }

    $upload_ktp = uploadFile('file_ktp', $nik, 'KTP', $target_dir, $allowed_types, $max_size);
    $upload_kk  = uploadFile('file_kk', $nik, 'KK', $target_dir, $allowed_types, $max_size);

    // Cek Error Upload
    if (strpos($upload_ktp, 'error') !== false || strpos($upload_kk, 'error') !== false) {
        $msg = "Gagal Upload. Pastikan file JPG/PNG/PDF max 2MB.";
        header("Location: ../components/PengajuanSurat.php?status=gagal&pesan=" . urlencode($msg));
        exit();
    }

    // 3. Insert Database
    $query = "INSERT INTO pengajuan_surat (
                jenis_surat, nik, nama_lengkap, tempat_lahir, tanggal_lahir, 
                whatsapp, pekerjaan, agama, lingkungan, jenis_kelamin, 
                status_perkawinan, nama_orang_tua, alamat, keperluan, 
                file_ktp, file_kk, status_pengajuan, email
              ) VALUES (
                '$jenis_surat', '$nik', '$nama_lengkap', '$tempat_lahir', '$tanggal_lahir',
                '$whatsapp', '$pekerjaan', '$agama', '$lingkungan', '$jenis_kelamin',
                '$status_perkawinan', '$nama_orang_tua', '$alamat', '$keperluan',
                '$upload_ktp', '$upload_kk', 'Pending', '$email'
              )";

    if (mysqli_query($koneksi, $query)) {
        header("Location: ../components/PengajuanSurat.php?status=sukses");
        exit();
    } else {
        $error = mysqli_error($koneksi);
        header("Location: ../components/PengajuanSurat.php?status=gagal&pesan=" . urlencode($error));
        exit();
    }

} else {
    // Jika diakses langsung tanpa POST, kembalikan ke form
    header("Location: ../components/PengajuanSurat.php");
    exit();
}
?>