<?php
/**
 * ProsesSurat.php
 * Handler untuk proses verifikasi, ACC, tolak, dan kirim email
 */

session_start();
include 'koneksi.php';

// Cek login
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("location:../index.php");
    exit();
}

$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : '';
$id_surat = isset($_GET['id']) ? $_GET['id'] : '';
$id_user_login = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : 0;

// Redirect jika ID kosong
if (empty($id_surat)) {
    header("location:../components/ManajemenSurat.php");
    exit();
}

// --- LOGIKA UTAMA ---

if ($aksi == 'verifikasi') {
    // 1. VERIFIKASI (Staff)
    $query = "UPDATE pengajuan_surat SET 
              status_pengajuan = 'Diproses',
              id_pegawai_verifikasi = '$id_user_login',
              tgl_verifikasi = NOW()
              WHERE id_pengajuan = '$id_surat'";

    if (mysqli_query($koneksi, $query)) {
        header("location:../components/ManajemenSurat.php?pesan=verifikasi_sukses");
    } else {
        echo "Gagal: " . mysqli_error($koneksi);
    }

} elseif ($aksi == 'acc') {
    // 2. ACC (Kades)
    $query = "UPDATE pengajuan_surat SET 
              status_pengajuan = 'Selesai',
              id_kades_acc = '$id_user_login', 
              tgl_acc = NOW()
              WHERE id_pengajuan = '$id_surat'";

    if (mysqli_query($koneksi, $query)) {
        header("location:../components/ManajemenSurat.php?pesan=acc_sukses");
    } else {
        echo "Gagal: " . mysqli_error($koneksi);
    }

} elseif ($aksi == 'tolak') {
    // 3. TOLAK
    $alasan = isset($_GET['alasan']) ? mysqli_real_escape_string($koneksi, $_GET['alasan']) : '-';

    $query = "UPDATE pengajuan_surat SET 
              status_pengajuan = 'Ditolak',
              keterangan_tolak = '$alasan'
              WHERE id_pengajuan = '$id_surat'";

    if (mysqli_query($koneksi, $query)) {
        header("location:../components/ManajemenSurat.php?pesan=tolak_sukses");
    } else {
        echo "Gagal: " . mysqli_error($koneksi);
    }

} elseif ($aksi == 'kirim_email') {
    // 4. KIRIM EMAIL NOTIFIKASI
    
    // Load helpers
    include 'helpers/EmailHelper.php';
    include __DIR__ . '/../templates/email/notifikasi_selesai.php';

    // Ambil data pemohon
    $query = "SELECT * FROM pengajuan_surat WHERE id_pengajuan = '$id_surat'";
    $result = mysqli_query($koneksi, $query);
    $data = mysqli_fetch_assoc($result);

    // Ambil data pengirim (user login)
    $query_user = "SELECT * FROM users WHERE id_user = '$id_user_login'";
    $result_user = mysqli_query($koneksi, $query_user);
    $user_login = mysqli_fetch_assoc($result_user);

    if ($data && !empty($data['email'])) {
        // Siapkan data
        $email_penerima = $data['email'];
        $nama_penerima = $data['nama_lengkap'];
        $jenis_surat = strtoupper($data['jenis_surat']);
        $nama_pengirim = $user_login['nama_lengkap'];
        $email_pengirim = $user_login['email'];

        // Generate template email
        $body_email = getTemplateEmailSelesai($nama_penerima, $jenis_surat, $nama_pengirim);

        // Kirim email
        $hasil = kirimEmail(
            $email_penerima,
            $nama_penerima,
            'Status Pengajuan Surat: Selesai',
            $body_email,
            $email_pengirim,
            $nama_pengirim
        );

        if ($hasil['success']) {
            header("location:../components/ManajemenSurat.php?pesan=email_sukses");
        } else {
            echo "Gagal mengirim email. Error: " . $hasil['message'];
            exit();
        }
    } else {
        echo "<script>alert('Email pemohon tidak ditemukan!'); window.location.href='../components/ManajemenSurat.php';</script>";
    }

} else {
    header("location:../components/ManajemenSurat.php");
}
