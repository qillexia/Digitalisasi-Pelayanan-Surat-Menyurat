<?php
$page = 'laporan';
include '../config/koneksi.php';
include '../config/RoleSession.php';
include '../config/Inisial.php';



// LOGIKA FILTER TANGGAL
$tgl_mulai = isset($_GET['tgl_mulai']) ? $_GET['tgl_mulai'] : date('Y-m-01');
$tgl_selesai = isset($_GET['tgl_selesai']) ? $_GET['tgl_selesai'] : date('Y-m-d');

// Query Data
$queryLaporan = mysqli_query($koneksi, "
    SELECT * FROM pengajuan_surat 
    WHERE tanggal_pengajuan BETWEEN '$tgl_mulai' AND '$tgl_selesai' 
    ORDER BY tanggal_pengajuan ASC
");
?>

<!DOCTYPE html>
<html lang="id">
<?php include 'header.php'; ?>

<body>

    <div class="d-flex" id="wrapper">

        <aside id="sidebar-wrapper">
            <?php include 'sidebar.php'; ?>
        </aside>

        <main id="page-content-wrapper">

            <header>
                <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom border-custom px-4 py-3 sticky-top">
                    <div class="d-flex align-items-center justify-content-between w-100">
                        <div class="d-flex align-items-center gap-3">
                            <button class="btn btn-sm btn-light d-md-none border-custom" id="menu-toggle">
                                <span class="material-symbols-outlined">menu</span>
                            </button>
                            <h1 class="h5 fw-bold mb-0 text-dark">Laporan</h1>
                        </div>
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

            <div class="container-fluid p-4 p-lg-5 print-container">

                <div class="no-print">
                    <section class="mb-4">
                        <h2 class="display-6 fw-bold text-dark mb-0 fs-3">Laporan Rekapitulasi Surat</h2>
                        <p class="text-secondary small">Data pengajuan surat masuk berdasarkan periode tanggal.</p>
                    </section>

                    <section class="card-custom p-4 shadow-sm mb-4">
                        <form method="GET" action="">
                            <div class="row g-3 align-items-end">
                                <div class="col-md-4">
                                    <label class="form-label fw-medium text-dark small">Dari Tanggal</label>
                                    <input type="date" name="tgl_mulai" class="form-control" value="<?= $tgl_mulai ?>" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-medium text-dark small">Sampai Tanggal</label>
                                    <input type="date" name="tgl_selesai" class="form-control" value="<?= $tgl_selesai ?>" required>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-brand w-100 fw-bold d-flex align-items-center justify-content-center gap-2">
                                        <span class="material-symbols-outlined fs-5">filter_alt</span>
                                        Tampilkan Data
                                    </button>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>

                <section class="card-custom border-0 shadow-sm rounded-4 p-4 bg-white print-card">

                    <div class="d-none d-print-block mb-4">
                        <h3 class="fw-bold mb-1">Laporan Rekapitulasi Surat</h3>
                        <p class="mb-0">Periode: <?= date('d/m/Y', strtotime($tgl_mulai)) ?> s/d <?= date('d/m/Y', strtotime($tgl_selesai)) ?></p>
                        <hr class="border-dark">
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4 no-print">
                        <h3 class="h6 fw-bold mb-0 text-dark">
                            Periode: <span class="text-success"><?= date('d M Y', strtotime($tgl_mulai)) ?></span> s/d <span class="text-success"><?= date('d M Y', strtotime($tgl_selesai)) ?></span>
                        </h3>
                        <button onclick="window.print()" class="btn btn-sm btn-outline-secondary d-flex align-items-center gap-2">
                            <span class="material-symbols-outlined fs-6">print</span> Cetak Laporan
                        </button>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle mb-0 print-table">
                            <thead class="bg-light">
                                <tr>
                                    <th class="text-center" width="5%">No</th>
                                    <th>Tanggal</th>
                                    <th>Jenis Surat</th>
                                    <th>Pemohon</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (mysqli_num_rows($queryLaporan) > 0): ?>
                                    <?php $no = 1;
                                    while ($row = mysqli_fetch_assoc($queryLaporan)): ?>
                                        <tr>
                                            <td class="text-center"><?= $no++ ?></td>
                                            <td><?= date('d/m/Y', strtotime($row['tanggal_pengajuan'])) ?></td>
                                            <td class="fw-medium text-dark"><?= strtoupper(str_replace('_', ' ', $row['jenis_surat'])) ?></td>
                                            <td><?= htmlspecialchars($row['nama_lengkap']) ?></td>
                                            <td>
                                                <?php
                                                // === LOGIC STATUS BARU (SESUAI DASHBOARD) ===
                                                $status = $row['status_pengajuan'];
                                                $badgeClass = 'bg-secondary text-white';
                                                $iconStatus = 'pending';

                                                if ($status == 'Selesai') {
                                                    $badgeClass = 'bg-success text-white';
                                                    $iconStatus = 'check_circle';
                                                } elseif ($status == 'Diproses') {
                                                    $badgeClass = 'bg-warning text-dark';
                                                    $iconStatus = 'sync';
                                                } elseif ($status == 'Ditolak') {
                                                    $badgeClass = 'bg-danger text-white';
                                                    $iconStatus = 'cancel';
                                                }
                                                ?>

                                                <div class="badge <?= $badgeClass ?> rounded-pill px-3 py-2 d-inline-flex align-items-center gap-1 fw-medium border border-0 print-badge">
                                                    <span class="material-symbols-outlined" style="font-size: 16px;"><?= $iconStatus ?></span>
                                                    <span><?= $status ?></span>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center py-5 text-muted">
                                            <span class="material-symbols-outlined fs-1 d-block mb-2 text-secondary-subtle">assignment_late</span>
                                            Tidak ada data surat pada rentang tanggal ini.
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </section>

            </div>
        </main>
    </div>

    <style>
        @media print {

            /* 1. Sembunyikan elemen yang tidak perlu */
            #sidebar-wrapper,
            header,
            .no-print,
            .btn,
            #menu-toggle {
                display: none !important;
            }

            /* 2. Reset Layout Utama */
            body,
            html {
                margin: 0;
                padding: 0;
                background-color: white !important;
            }

            #wrapper {
                display: block !important;
            }

            #page-content-wrapper {
                margin: 0 !important;
                padding: 0 !important;
                width: 100% !important;
            }

            /* 3. HILANGKAN JARAK (PADDING) CONTAINER */
            .print-container {
                padding: 0 !important;
                margin: 0 !important;
                max-width: 100% !important;
            }

            /* 4. Reset Card agar rapat ke atas */
            .print-card {
                border: none !important;
                box-shadow: none !important;
                padding: 0 !important;
                margin-top: 0 !important;
                border-radius: 0 !important;
            }

            /* 5. Atur Margin Halaman Kertas */
            @page {
                margin: 1.5cm;
                /* Memberi margin standar pada kertas fisik */
                size: auto;
            }

            /* 6. Pastikan tabel border terlihat jelas */
            .table-bordered th,
            .table-bordered td {
                border: 1px solid #000 !important;
            }

            /* 7. Reset Badge saat Print agar Rapi (Hitam Putih / Sederhana) */
            .print-badge {
                border: 1px solid #000 !important;
                /* Tambah border saat print */
                background-color: transparent !important;
                /* Hilangkan background warna saat print */
                color: #000 !important;
                /* Teks hitam */
                font-weight: bold;
                padding: 2px 6px;
            }

            /* Hilangkan icon saat print jika ingin lebih bersih (opsional) */
            /* .print-badge .material-symbols-outlined { display: none; } */
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/MenuToggleResponsive.js"></script>
</body>

</html>