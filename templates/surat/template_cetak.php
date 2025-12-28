<?php
/**
 * Template Cetak Surat Resmi
 * File ini hanya berisi tampilan HTML, logika ada di CetakSuratConfig.php
 */
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Cetak Surat - <?= htmlspecialchars($data['nama_lengkap']) ?></title>
    <link rel="stylesheet" href="../css/CetakSurat.css">
</head>

<body>

    <!-- Toolbar Cetak (Tidak ikut tercetak) -->
    <div class="print-toolbar no-print">
        <button onclick="window.print()">🖨️ Cetak / Simpan PDF</button>
    </div>

    <!-- Kertas A4 -->
    <div class="sheet">

        <!-- Kop Surat -->
        <header class="kop-surat">
            <h2>PEMERINTAH KABUPATEN KUNINGAN</h2>
            <h2>KECAMATAN KUNINGAN</h2>
            <h2>KELURAHAN WINDUSENGKAHAN</h2>
            <p>Jalan Syech Muhibat Windusengkahan, Kode Pos: 45515</p>
        </header>

        <!-- Judul Surat -->
        <section class="judul-surat">
            <h4><?= $judul_surat ?></h4>
            <p>Nomor: <?= $nomor_surat ?></p>
        </section>

        <!-- Isi Surat -->
        <article class="isi-surat">
            <p>Yang bertanda tangan di bawah ini Kepala Desa Windusengkahan, Kecamatan Windusengkahan, Kabupaten Kuningan, menerangkan dengan sebenarnya bahwa:</p>

            <table class="tabel-bio">
                <tr>
                    <td class="label">Nama Lengkap</td>
                    <td>: <b><?= htmlspecialchars($data['nama_lengkap']) ?></b></td>
                </tr>
                <tr>
                    <td>NIK</td>
                    <td>: <?= htmlspecialchars($data['nik']) ?></td>
                </tr>
                <tr>
                    <td>Tempat/Tgl Lahir</td>
                    <td>: <?= htmlspecialchars($data['tempat_lahir']) ?>, <?= tgl_indo($data['tanggal_lahir']) ?></td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>: <?= formatText($data['jenis_kelamin']) ?></td>
                </tr>
                <tr>
                    <td>Pekerjaan</td>
                    <td>: <?= formatText($data['pekerjaan']) ?></td>
                </tr>
                <tr>
                    <td>Agama</td>
                    <td>: <?= formatText($data['agama']) ?></td>
                </tr>
                <tr>
                    <td>Status Perkawinan</td>
                    <td>: <?= formatText($data['status_perkawinan']) ?></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>: <?= htmlspecialchars($data['alamat']) ?></td>
                </tr>
            </table>

            <p>Orang tersebut di atas adalah benar-benar warga penduduk Desa Windusengkahan yang berdomisili di alamat tersebut di atas. Surat keterangan ini dibuat untuk keperluan: <b>"<?= htmlspecialchars($data['keperluan']) ?>"</b>.</p>

            <p>Demikian surat keterangan ini kami buat dengan sebenarnya agar dapat dipergunakan sebagaimana mestinya.</p>
        </article>

        <!-- Tanda Tangan -->
        <aside class="ttd">
            <p>Windusengkahan, <?= $tanggal_cetak ?></p>
            <p>Kepala Desa Windusengkahan</p>
            <div class="ttd-box"></div>
            <p class="ttd-nama">Didi Supardi</p>
        </aside>

    </div>

</body>

</html>