<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load PHPMailer
require __DIR__ . '/../../vendor/autoload.php';

// ==========================================
// KONFIGURASI SMTP (Ubah sesuai kebutuhan)
// ==========================================
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_USERNAME', 'haqilabdillah@gmail.com');
define('SMTP_PASSWORD', 'njbfawosiijzxwmr');
define('SMTP_PORT', 465);
define('SMTP_FROM_NAME', 'Kantor Lurah Windusengkahan');

/**
 * Kirim email notifikasi
 * @param string $email_penerima
 * @param string $nama_penerima
 * @param string $subject
 * @param string $body_html
 * @param string $reply_to_email (opsional)
 * @param string $reply_to_name (opsional)
 * @return array ['success' => bool, 'message' => string]
 */
function kirimEmail($email_penerima, $nama_penerima, $subject, $body_html, $reply_to_email = '', $reply_to_name = '') {
    $mail = new PHPMailer(true);

    try {
        // Konfigurasi Server
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host       = SMTP_HOST;
        $mail->SMTPAuth   = true;
        $mail->Username   = SMTP_USERNAME;
        $mail->Password   = SMTP_PASSWORD;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = SMTP_PORT;

        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        // Pengirim
        $mail->setFrom(SMTP_USERNAME, SMTP_FROM_NAME);
        
        // Reply-To (jika ada)
        if (!empty($reply_to_email)) {
            $mail->addReplyTo($reply_to_email, $reply_to_name);
        }
        
        // Penerima
        $mail->addAddress($email_penerima, $nama_penerima);

        // Konten
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body_html;

        $mail->send();
        return ['success' => true, 'message' => 'Email berhasil dikirim'];

    } catch (Exception $e) {
        return ['success' => false, 'message' => $mail->ErrorInfo];
    }
}