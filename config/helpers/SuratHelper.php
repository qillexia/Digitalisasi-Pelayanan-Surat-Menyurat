<?php
// ==================================================
// SuratHelper.php
// Fungsi helper untuk format surat
// TANPA include koneksi & query
// ==================================================


// Konversi tanggal ke format Indonesia
function tgl_indo($tanggal)
{
    $bulan = array(
        1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    );

    // Pisahkan format YYYY-MM-DD
    $pecahkan = explode('-', $tanggal);

    // Kembalikan format: DD NamaBulan YYYY
    return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}


// Mendapatkan judul surat berdasarkan jenis
function getJudulSurat($jenis)
{
    // Ubah ke huruf kecil
    $jenis = strtolower($jenis);

    // Daftar judul surat
    $daftar_judul = [
        'sktm' => 'SURAT KETERANGAN TIDAK MAMPU',
        'sku'  => 'SURAT KETERANGAN USAHA',
        'skd'  => 'SURAT KETERANGAN DOMISILI',
        'skbm' => 'SURAT KETERANGAN BELUM MENIKAH',
        'spn'  => 'SURAT PENGANTAR NIKAH',
        'skk'  => 'SURAT KETERANGAN KEHILANGAN',
    ];

    // Kembalikan judul sesuai jenis
    return $daftar_judul[$jenis] ?? 'SURAT KETERANGAN';
}


// Format nomor surat resmi
function formatNomorSurat($id_pengajuan)
{
    // Contoh: 470 / 001 / Ds.WDS / 2025
    return '470 / ' . str_pad($id_pengajuan, 3, '0', STR_PAD_LEFT) . ' / Ds.WDS / ' . date('Y');
}


// Format teks: hapus underscore dan kapital setiap kata
function formatText($text)
{
    return ucwords(str_replace('_', ' ', $text));
}


// Generate label jenis surat dengan HTML
function getLabelJenisSurat($jenis_surat)
{
    // Ubah ke huruf kecil
    $jenis = strtolower($jenis_surat);

    // Daftar jenis surat
    $daftar = [
        'sktm' => ['kode' => 'SKTM', 'nama' => 'Surat Keterangan Tidak Mampu'],
        'sku'  => ['kode' => 'SKU',  'nama' => 'Surat Keterangan Usaha'],
        'skd'  => ['kode' => 'SKD',  'nama' => 'Surat Keterangan Domisili'],
        'skbm' => ['kode' => 'SKBM', 'nama' => 'Surat Ket. Belum Menikah'],
        'spn'  => ['kode' => 'SPN',  'nama' => 'Surat Pengantar Nikah'],
        'skk'  => ['kode' => 'SKK',  'nama' => 'Surat Keterangan Kehilangan'],
    ];

    // Cek apakah jenis surat tersedia
    if (isset($daftar[$jenis])) {
        $kode = $daftar[$jenis]['kode'];
        $nama = $daftar[$jenis]['nama'];
    } else {
        $kode = strtoupper(str_replace('_', ' ', $jenis));
        $nama = 'Jenis Surat Lainnya';
    }

    // Return label HTML
    return '<div class="d-flex flex-column">
                <span class="fw-bold">' . $kode . '</span>
                <span class="small text-muted">' . $nama . '</span>
            </div>';
}


// Generate badge status pengajuan
function getStatusBadge($status)
{
    // Daftar badge status
    $badges = [
        'Selesai'  => ['class' => 'bg-success text-white',  'icon' => 'check_circle'],
        'Diproses' => ['class' => 'bg-warning text-dark',   'icon' => 'sync'],
        'Ditolak'  => ['class' => 'bg-danger text-white',   'icon' => 'cancel'],
        'Pending'  => ['class' => 'bg-secondary text-white','icon' => 'pending'],
    ];

    // Kembalikan badge sesuai status
    return $badges[$status] ?? $badges['Pending'];
}


// Format nomor pengajuan
function formatNoPengajuan($id_pengajuan)
{
    // Contoh: REQ-0001
    return "REQ-" . str_pad($id_pengajuan, 4, '0', STR_PAD_LEFT);
}
