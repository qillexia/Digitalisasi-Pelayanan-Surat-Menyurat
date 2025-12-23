<?php
// Pastikan variabel $nama_user sudah tersedia sebelum file ini di-include

$nama_user = isset($_SESSION['nama']) ? $_SESSION['nama'] : 'Admin';

if(isset($nama_user)) {
    $words = explode(" ", $nama_user);
    $inisial = "";
    
    foreach ($words as $w) {
        $inisial .= mb_substr($w, 0, 1);
    }
    // Ambil maksimal 2 huruf, uppercase
    $inisial = strtoupper(substr($inisial, 0, 2));
} else {
    $inisial = "AD"; // Default jika nama user tidak ada
}
?>