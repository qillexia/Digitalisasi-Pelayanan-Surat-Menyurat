<?php
// <!-- Include konfigurasi dan logic utama dashboard -->
include '../config/DashboardConfig.php';

// <!-- Logic untuk inisial nama user -->
include '../config/Inisial.php';

// <!-- Logic untuk menentukan label role user -->
include '../config/RoleSession.php';
?>

<!DOCTYPE html>
<html lang="id">

<?php include 'header.php'; ?>

<body>

    <div class="d-flex" id="wrapper">
        <!-- Sidebar Navigasi -->
        <?php include 'sidebar.php'; ?>

        <main id="page-content-wrapper">

            <!-- Header Navigasi Atas -->
            <header class="sticky-top">
                <nav class="navbar navbar-expand-lg bg-white border-bottom px-4 py-3 shadow-sm-custom">
                    <div class="d-flex align-items-center justify-content-between w-100">
                        <div class="d-flex align-items-center gap-3">
                            <!-- Tombol toggle sidebar (hanya muncul di mobile) -->
                            <button class="btn btn-light d-md-none border" id="menu-toggle">
                                <span class="material-symbols-outlined">menu</span>
                            </button>
                            <h2 class="h5 fw-bold mb-0 text-dark">Dashboard</h2>
                        </div>

                        <!-- Info User (Nama, Role, Inisial) -->
                        <div class="d-flex align-items-center gap-4">
                            <div class="text-end d-none d-md-block">
                                <span class="d-block fw-bold text-dark small"><?= htmlspecialchars($nama_user) ?></span>
                                <span class="d-block text-secondary x-small" style="font-size: 0.75rem;">
                                    <?= $label_role ?>
                                </span>
                            </div>
                            <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center fw-bold shadow-sm"
                                style="width: 40px; height: 40px; font-size: 16px; user-select: none;">
                                <?= $inisial ?>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>

            <div class="container-fluid p-4 p-lg-5 dashboard-area">

                <!-- Section: Sambutan -->
                <section class="mb-5">
                    <h1 class="fw-bold mb-1 display-6 fs-3 text-dark">
                        Selamat datang, <?php echo htmlspecialchars($nama_user); ?>!
                    </h1>
                    <p class="text-secondary mb-0 small">Berikut adalah statistik pelayanan surat desa tahun <?= date('Y') ?>.</p>
                </section>

                <!-- Section: Statistik Kartu -->
                <section class="row g-4 mb-5">
                    <!-- Total Surat Masuk -->
                    <div class="col-md-4">
                        <article class="card border-0 shadow-sm rounded-4 h-100 p-4">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h3 class="h6 fw-medium text-secondary mb-2">Total Surat Masuk</h3>
                                    <span class="fw-bold fs-3 lh-1 text-dark"><?= $totalSurat ?></span>
                                </div>
                                <div class="p-2 rounded-3 bg-primary-subtle text-primary">
                                    <span class="material-symbols-outlined">mail</span>
                                </div>
                            </div>
                        </article>
                    </div>
                    <!-- Menunggu Persetujuan -->
                    <div class="col-md-4">
                        <article class="card border-0 shadow-sm rounded-4 h-100 p-4">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h3 class="h6 fw-medium text-secondary mb-2">Menunggu Persetujuan</h3>
                                    <span class="fw-bold fs-3 lh-1 text-dark"><?= $totalMenunggu ?></span>
                                </div>
                                <div class="p-2 rounded-3 bg-warning-subtle text-warning-emphasis">
                                    <span class="material-symbols-outlined">pending_actions</span>
                                </div>
                            </div>
                        </article>
                    </div>
                    <!-- Surat Selesai -->
                    <div class="col-md-4">
                        <article class="card border-0 shadow-sm rounded-4 h-100 p-4">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h3 class="h6 fw-medium text-secondary mb-2">Surat Selesai</h3>
                                    <span class="fw-bold fs-3 lh-1 text-dark"><?= $totalSelesai ?></span>
                                </div>
                                <div class="p-2 rounded-3 bg-success-subtle text-success">
                                    <span class="material-symbols-outlined">check_circle</span>
                                </div>
                            </div>
                        </article>
                    </div>
                </section>

                <!-- Section: Grafik dan Donat -->
                <section class="row g-4 mb-5">
                    <!-- Grafik Tren Permohonan Surat -->
                    <div class="col-lg-8">
                        <div class="card border-0 shadow-sm rounded-4 h-100 p-4">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h2 class="h6 fw-bold mb-0 text-dark">Tren Permohonan Surat</h2>
                                <span class="badge bg-light text-secondary border">Tahun <?= date('Y') ?></span>
                            </div>
                            <div style="height: 300px;">
                                <canvas id="chartTrenSurat"></canvas>
                            </div>
                        </div>
                    </div>
                    <!-- Grafik Donat Status Surat -->
                    <div class="col-lg-4">
                        <div class="card border-0 shadow-sm rounded-4 h-100 p-4">
                            <h2 class="h6 fw-bold mb-4 text-dark">Persentase Status</h2>
                            <div style="height: 250px; position: relative;">
                                <canvas id="chartStatusSurat"></canvas>
                            </div>
                            <div class="mt-4 d-flex justify-content-center gap-3 text-center">
                                <div>
                                    <span class="d-block fw-bold fs-5 text-success"><?= $totalSelesai ?></span>
                                    <span class="small text-secondary">Selesai</span>
                                </div>
                                <div class="vr opacity-25"></div>
                                <div>
                                    <span class="d-block fw-bold fs-5 text-warning"><?= $totalMenunggu ?></span>
                                    <span class="small text-secondary">Proses</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Section: Daftar Surat Terbaru -->
                <section class="card border-0 shadow-sm rounded-4 p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h2 class="h6 fw-bold mb-1 text-dark">Daftar Surat Terbaru</h2>
                            <p class="text-secondary small mb-0">5 pengajuan surat terakhir yang masuk.</p>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light border-bottom">
                                <tr>
                                    <th class="ps-3 text-secondary fw-semibold small py-3">No. Surat</th>
                                    <th class="text-secondary fw-semibold small py-3">Jenis Surat</th>
                                    <th class="text-secondary fw-semibold small py-3">Pemohon</th>
                                    <th class="text-secondary fw-semibold small py-3">Tanggal</th>
                                    <th class="text-secondary fw-semibold small py-3">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // <!-- Query untuk mengambil 5 surat terbaru -->
                                $qTerbaru = mysqli_query($koneksi, "SELECT * FROM pengajuan_surat ORDER BY id_pengajuan DESC LIMIT 5");

                                if (mysqli_num_rows($qTerbaru) > 0) {
                                    while ($row = mysqli_fetch_assoc($qTerbaru)) {

                                        // <!-- Logic badge warna dan icon status -->
                                        $badgeClass = 'bg-secondary text-white';
                                        $iconStatus = 'pending'; // Default icon

                                        if ($row['status_pengajuan'] == 'Selesai') {
                                            $badgeClass = 'bg-success text-white';
                                            $iconStatus = 'check_circle';
                                        } elseif ($row['status_pengajuan'] == 'Diproses') {
                                            $badgeClass = 'bg-warning text-dark';
                                            $iconStatus = 'sync';
                                        } elseif ($row['status_pengajuan'] == 'Ditolak') {
                                            $badgeClass = 'bg-danger text-white';
                                            $iconStatus = 'cancel';
                                        }

                                        // <!-- Mapping nama surat agar tampil lebih rapi -->
                                        $jenis_kode = strtolower($row['jenis_surat']);
                                        $nama_surat_lengkap = ucwords(str_replace('_', ' ', $jenis_kode)); // Default fallback

                                        // <!-- Kamus nama surat untuk tampilan -->
                                        $kamus_surat = [
                                            'sktm' => 'Surat Keterangan Tidak Mampu',
                                            'sku' => 'Surat Keterangan Usaha',
                                            'skd' => 'Surat Keterangan Domisili',
                                            'skbm' => 'Surat Ket. Belum Menikah',
                                            'spn' => 'Surat Pengantar Nikah',
                                            'skk' => 'Surat Keterangan Kehilangan',
                                        ];

                                        if (array_key_exists($jenis_kode, $kamus_surat)) {
                                            $nama_surat_lengkap = $kamus_surat[$jenis_kode];
                                        }

                                        // <!-- Format nomor surat dan tanggal -->
                                        $no_surat = "REQ-" . str_pad($row['id_pengajuan'], 4, '0', STR_PAD_LEFT);
                                        $tgl = date('d M Y', strtotime($row['tanggal_pengajuan']));
                                ?>
                                        <tr>
                                            <!-- Nomor Surat -->
                                            <td class="ps-3 fw-medium text-dark small"><?= $no_surat ?></td>
                                            <!-- Jenis Surat dan Keperluan -->
                                            <td>
                                                <div class="d-flex flex-column">
                                                    <span class="fw-medium text-dark small"><?= $nama_surat_lengkap ?></span>
                                                    <span class="text-muted" style="font-size: 0.75rem;">Keperluan: <?= mb_strimwidth($row['keperluan'], 0, 20, "...") ?></span>
                                                </div>
                                            </td>
                                            <!-- Nama Pemohon -->
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center text-secondary border" style="width: 30px; height: 30px;">
                                                        <span class="material-symbols-outlined fs-6">person</span>
                                                    </div>
                                                    <span class="small fw-medium"><?= htmlspecialchars($row['nama_lengkap']) ?></span>
                                                </div>
                                            </td>
                                            <!-- Tanggal Pengajuan -->
                                            <td class="text-secondary small"><?= $tgl ?></td>
                                            <!-- Status Surat -->
                                            <td>
                                                <div class="badge <?= $badgeClass ?> rounded-pill px-3 py-2 d-inline-flex align-items-center gap-1 fw-medium border border-0">
                                                    <span class="material-symbols-outlined" style="font-size: 14px;"><?= $iconStatus ?></span>
                                                    <span><?= $row['status_pengajuan'] ?></span>
                                                </div>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    // <!-- Jika tidak ada surat masuk -->
                                    echo '<tr><td colspan="6" class="text-center py-5 text-muted"><span class="material-symbols-outlined fs-1 d-block mb-2 text-secondary-subtle">inbox</span>Belum ada surat masuk hari ini.</td></tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </section>

            </div>
        </main>
    </div>

    <!-- Script Bootstrap, Chart.js, dan JS Custom -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/MenuToggleResponsive.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Data untuk Chart dari PHP -->
    <script>
        var dataBulanPHP = <?= $jsonGrafikBulan ?>;
        var dataStatusPHP = <?= $jsonStatus ?>;
    </script>

    <!-- Script Chart Dashboard -->
    <script src="../js/ChartsDashboard.js"></script>

</body>
</html>