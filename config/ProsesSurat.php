<?php

// TAMBAHKAN 2 BARIS INI:
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();
// Karena satu folder dengan koneksi.php, tidak perlu tanda "../"
include 'koneksi.php';

// Cek login
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("location:../index.php");
    exit();
}



$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : '';
$id_surat = isset($_GET['id']) ? $_GET['id'] : '';

// PERBAIKAN 1: Tambahkan pengecekan isset agar tidak warning
$id_user_login = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : 0; 

// Redirect kembali ke folder components jika ID kosong
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
        // Redirect ke folder components
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
    
    // A. AMBIL DATA PEMOHON (PENERIMA)
    $query = "SELECT * FROM pengajuan_surat WHERE id_pengajuan = '$id_surat'";
    $result = mysqli_query($koneksi, $query);
    $data = mysqli_fetch_assoc($result);

    // B. AMBIL DATA PENGIRIM (USER LOGIN)
    $id_user_login = $_SESSION['id_user'];
    $query_user = "SELECT * FROM users WHERE id_user = '$id_user_login'";
    $result_user = mysqli_query($koneksi, $query_user);
    $user_login = mysqli_fetch_assoc($result_user);

    $email_pengirim_asli = $user_login['email']; // Email user yang sedang login
    $nama_pengirim_asli  = $user_login['nama_lengkap']; // Nama user yang sedang login

    // Pastikan kolom 'email' ada di database Anda
    if ($data && !empty($data['email'])) {
        $email_penerima = $data['email'];
        $nama_penerima = $data['nama_lengkap'];
        $jenis_surat = strtoupper($data['jenis_surat']);

        // Load PHPMailer
        require '../vendor/autoload.php'; 

        $mail = new PHPMailer(true);

        try {
            // Debugging (Bisa dimatikan/dihapus nanti jika sudah sukses)
            $mail->SMTPDebug = 0; // Ubah ke 0 agar tidak muncul teks aneh di layar user
            $mail->Debugoutput = 'html';

            // Konfigurasi Server SMTP (AKUN UTAMA SISTEM)
            // Password & Email ini WAJIB valid untuk autentikasi ke Google
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com'; 
            $mail->SMTPAuth   = true;
            $mail->Username   = 'haqilabdillah@gmail.com'; // Email Utama Sistem
            $mail->Password   = 'njbfawosiijzxwmr';        // App Password Utama
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;

            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            // --- PENGATURAN PENGIRIM DINAMIS ---
            
            // 1. From: Tetap pakai email sistem (agar tidak masuk spam), tapi NAMA pakai nama user login
            $mail->setFrom('haqilabdillah@gmail.com', 'Kantor Lurah Windusengkahan');
            
            // 2. Reply-To: Jika warga membalas, masuk ke email user yang login
            $mail->addReplyTo($email_pengirim_asli, $nama_pengirim_asli);
            
            // 3. Penerima
            $mail->addAddress($email_penerima, $nama_penerima);

            // Konten Email
            $mail->isHTML(true);
            $mail->Subject = 'Status Pengajuan Surat: Selesai';
            
            // Template Email HTML Modern
            $mail->Body = "
            <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; background-color: #f4f4f4; padding: 20px; border-radius: 10px;'>
                
                <!-- Header -->
                <div style='background-color: #198754; padding: 20px; text-align: center; border-radius: 10px 10px 0 0;'>
                    <h2 style='color: #ffffff; margin: 0; font-size: 24px;'>Kelurahan Windusengkahan</h2>
                    <p style='color: #e8f5e9; margin: 5px 0 0; font-size: 14px;'>Layanan Surat Digital</p>
                </div>

                <!-- Body -->
                <div style='background-color: #ffffff; padding: 30px; border-radius: 0 0 10px 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.05);'>
                    <h3 style='color: #333333; margin-top: 0;'>Halo, $nama_penerima 👋</h3>
                    
                    <p style='color: #555555; line-height: 1.6; font-size: 16px;'>
                        Kabar baik! Pengajuan surat <strong>$jenis_surat</strong> Anda telah selesai diproses dan disetujui.
                    </p>

                    <div style='background-color: #e8f5e9; border-left: 4px solid #198754; padding: 15px; margin: 20px 0; color: #2e7d32;'>
                        <strong>Status: SELESAI</strong><br>
                        <span style='font-size: 14px;'>Diverifikasi oleh: $nama_pengirim_asli</span>
                    </div>

                    <p style='color: #555555; line-height: 1.6; font-size: 16px;'>
                        Silakan datang ke kantor kelurahan pada jam kerja untuk mengambil dokumen fisik surat Anda. Jangan lupa membawa identitas diri (KTP/KK) sebagai bukti pengambilan.
                    </p>

                    <hr style='border: 0; border-top: 1px solid #eeeeee; margin: 30px 0;'>

                    <p style='color: #888888; font-size: 14px; margin-bottom: 5px;'>Salam hangat,</p>
                    <p style='color: #333333; font-weight: bold; margin-top: 0;'>Pemerintah Kelurahan Windusengkahan</p>
                </div>

                <!-- Footer -->
                <div style='text-align: center; padding-top: 20px; color: #999999; font-size: 12px;'>
                    <p>&copy; " . date('Y') . " Kelurahan Windusengkahan. All rights reserved.</p>
                    <p>Jalan Syech Muhibat Windusengkahan, Kuningan, Jawa Barat</p>
                </div>

            </div>
            ";

            $mail->send();
            header("location:../components/ManajemenSurat.php?pesan=email_sukses");
        } catch (Exception $e) {
            // Tampilkan error jika gagal
            echo "Gagal mengirim email. Error: {$mail->ErrorInfo}";
            exit(); 
        }
    } else {
        echo "<script>alert('Email pemohon tidak ditemukan!'); window.location.href='../components/ManajemenSurat.php';</script>";
    }

} else {
    header("location:../components/ManajemenSurat.php");
}
