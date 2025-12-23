<?php
include '../config/koneksi.php';
$id_surat = isset($_GET['id']) ? $_GET['id'] : '';
$query = mysqli_query($koneksi, "SELECT * FROM pengajuan_surat WHERE id_pengajuan = '$id_surat'");
$data = mysqli_fetch_array($query);

if (!$data) { die("Data tidak ditemukan"); }

function tgl_indo($tanggal){
	$bulan = array (1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
	$pecahkan = explode('-', $tanggal);
	return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}

$jenis = strtolower($data['jenis_surat']);
$judul_surat = "SURAT KETERANGAN";
if($jenis == 'sktm') $judul_surat = "SURAT KETERANGAN TIDAK MAMPU";
elseif($jenis == 'sku') $judul_surat = "SURAT KETERANGAN USAHA";
elseif($jenis == 'skd') $judul_surat = "SURAT KETERANGAN DOMISILI";
elseif($jenis == 'spn') $judul_surat = "SURAT PENGANTAR NIKAH";
elseif($jenis == 'skk') $judul_surat = "SURAT KETERANGAN KEHILANGAN";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Cetak Surat - <?= $data['nama_lengkap'] ?></title>
    <style>
        /* CSS RESET UNTUK PRINTER */
        @page { size: A4; margin: 0; }
        body { margin: 0; padding: 0; font-family: 'Times New Roman', serif; background: #eee; }
        
        .sheet {
            background: white; width: 210mm; height: 297mm; display: block; margin: 10mm auto; padding: 20mm;
            box-shadow: 0 0 10px rgba(0,0,0,0.1); box-sizing: border-box; position: relative;
        }

        /* TAMPILAN SAAT DI-PRINT (HILANGKAN BACKGROUND) */
        @media print {
            body { background: none; }
            .sheet { margin: 0; box-shadow: none; width: 100%; height: auto; }
            .no-print { display: none; }
        }

        /* LAYOUTING */
        .header { text-align: center; border-bottom: 3px double black; padding-bottom: 15px; margin-bottom: 25px; }
        .header h2, .header h3 { margin: 0; text-transform: uppercase; }
        .header h2 { font-size: 16pt; }
        .header h3 { font-size: 14pt; }
        .header p { margin: 5px 0 0; font-size: 10pt; font-style: italic; }

        .judul { text-align: center; margin-bottom: 30px; }
        .judul h4 { text-decoration: underline; margin: 0; font-size: 14pt; text-transform: uppercase; }
        .judul p { margin: 5px 0 0; }

        .isi { font-size: 12pt; line-height: 1.5; text-align: justify; }
        .tabel-bio { width: 100%; margin-left: 20px; margin-bottom: 10px; }
        .tabel-bio td { vertical-align: top; padding: 2px 0; }
        .label { width: 180px; }
        
        .ttd { float: right; width: 40%; text-align: center; margin-top: 50px; }
        .ttd p { margin: 0; }
        .ttd-box { height: 80px; display: flex; align-items: center; justify-content: center; }
    </style>
</head>
<body>

    <div class="no-print" style="text-align: center; padding: 10px; background: #333; color: white;">
        <button onclick="window.print()" style="padding: 10px 20px; cursor: pointer; font-weight: bold;">🖨️ Cetak / Simpan PDF</button>
    </div>

    <div class="sheet">
        <div class="header">
            <h2>PEMERINTAH KABUPATEN KUNINGAN</h2>
            <h2>KECAMATAN WINDUSENGKAHAN</h2>
            <h3>DESA WINDUSENGKAHAN</h3>
            <p>Alamat: Jl. Raya Desa Windusengkahan No. 123 Kode Pos 45515</p>
        </div>

        <div class="judul">
            <h4><?= $judul_surat ?></h4>
            <p>Nomor: 470 / <?= str_pad($data['id_pengajuan'], 3, '0', STR_PAD_LEFT) ?> / Ds.WDS / <?= date('Y') ?></p>
        </div>

        <div class="isi">
            <p>Yang bertanda tangan di bawah ini Kepala Desa Windusengkahan, Kecamatan Windusengkahan, Kabupaten Kuningan, menerangkan dengan sebenarnya bahwa:</p>

            <table class="tabel-bio">
                <tr><td class="label">Nama Lengkap</td><td>: <b><?= $data['nama_lengkap'] ?></b></td></tr>
                <tr><td>NIK</td><td>: <?= $data['nik'] ?></td></tr>
                <tr><td>Tempat/Tgl Lahir</td><td>: <?= $data['tempat_lahir'] ?>, <?= tgl_indo($data['tanggal_lahir']) ?></td></tr>
                <tr><td>Jenis Kelamin</td><td>: <?= $data['jenis_kelamin'] ?></td></tr>
                <tr><td>Pekerjaan</td><td>: <?= $data['pekerjaan'] ?></td></tr>
                <tr><td>Agama</td><td>: <?= $data['agama'] ?></td></tr>
                <tr><td>Status Perkawinan</td><td>: <?= $data['status_perkawinan'] ?></td></tr>
                <tr><td>Alamat</td><td>: <?= $data['alamat'] ?></td></tr>
            </table>

            <p>Orang tersebut di atas adalah benar-benar warga penduduk Desa Windusengkahan yang berdomisili di alamat tersebut di atas. Surat keterangan ini dibuat untuk keperluan: <b>"<?= $data['keperluan'] ?>"</b>.</p>

            <p>Demikian surat keterangan ini kami buat dengan sebenarnya agar dapat dipergunakan sebagaimana mestinya.</p>
        </div>

        <div class="ttd">
            <p>Windusengkahan, <?= tgl_indo(date('Y-m-d')) ?></p>
            <p>Kepala Desa Windusengkahan</p>
            
            <div class="ttd-box">
                </div>

            <p style="text-decoration: underline; font-weight: bold;">NAMA KEPALA DESA</p>
        </div>
    </div>

</body>
</html>