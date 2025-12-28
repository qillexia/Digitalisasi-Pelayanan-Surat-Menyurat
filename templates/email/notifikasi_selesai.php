<?php
/**
 * Template Email Notifikasi Surat Selesai
 * Variabel yang dibutuhkan: $nama_penerima, $jenis_surat, $nama_pengirim
 */

function getTemplateEmailSelesai($nama_penerima, $jenis_surat, $nama_pengirim) {
    return "
    <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; background-color: #f4f4f4; padding: 20px; border-radius: 10px;'>
        
        <!-- Header -->
        <div style='background-color: #198754; padding: 20px; text-align: center; border-radius: 10px 10px 0 0;'>
            <h2 style='color: #ffffff; margin: 0; font-size: 24px;'>Kelurahan Windusengkahan</h2>
            <p style='color: #e8f5e9; margin: 5px 0 0; font-size: 14px;'>Layanan Surat Digital</p>
        </div>

        <!-- Body -->
        <div style='background-color: #ffffff; padding: 30px; border-radius: 0 0 10px 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.05);'>
            <h3 style='color: #333333; margin-top: 0;'>Halo, {$nama_penerima} 👋</h3>
            
            <p style='color: #555555; line-height: 1.6; font-size: 16px;'>
                Kabar baik! Pengajuan surat <strong>{$jenis_surat}</strong> Anda telah selesai diproses dan disetujui.
            </p>

            <div style='background-color: #e8f5e9; border-left: 4px solid #198754; padding: 15px; margin: 20px 0; color: #2e7d32;'>
                <strong>Status: SELESAI</strong><br>
                <span style='font-size: 14px;'>Diverifikasi oleh: {$nama_pengirim}</span>
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
}