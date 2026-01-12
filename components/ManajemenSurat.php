<?php
// <!-- Panggil konfigurasi dan logic utama manajemen surat -->
include '../config/ManajemenSuratConfig.php';
include '../config/Inisial.php';
include '../config/RoleSession.php';
include '../config/helpers/SuratHelper.php';
?>

<!DOCTYPE html>
<html lang="id">

<?php include 'header.php'; ?>

<body>

    <div class="d-flex" id="wrapper">

        <!-- Sidebar Navigasi -->
        <aside id="sidebar-wrapper">
            <?php include 'sidebar.php'; ?>
        </aside>

        <main id="page-content-wrapper">

            <!-- Header Navigasi Atas -->
            <header class="sticky-top">
                <nav class="navbar navbar-expand-lg bg-white border-bottom px-4 py-3" aria-label="Top Navigation">
                    <div class="d-flex align-items-center justify-content-between w-100">
                        <div class="d-flex align-items-center gap-3">
                            <!-- Tombol toggle sidebar (hanya muncul di mobile) -->
                            <button class="btn btn-light d-md-none border" id="menu-toggle" aria-label="Toggle Sidebar">
                                <span class="material-symbols-outlined">menu</span>
                            </button>
                            <h2 class="h5 fw-bold mb-0 text-dark">Manajemen Surat</h2>
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

            <div class="container-fluid p-4 p-lg-5">
                <!-- Alert Sukses/Gagal -->
                <?php if (isset($status) && $status == 'hapus_sukses'): ?>
                    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                        <div class="d-flex align-items-center">
                            <span class="material-symbols-outlined me-2">delete</span>
                            <div><strong>Terhapus!</strong> Data surat berhasil dihapus permanen.</div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                <!-- Alert untuk status email -->
                <?php elseif (isset($_GET['pesan']) && $_GET['pesan'] == 'email_sukses'): ?>
                    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                        <div class="d-flex align-items-center">
                            <span class="material-symbols-outlined me-2">mark_email_read</span>
                            <div><strong>Berhasil!</strong> Notifikasi email telah dikirim ke pemohon.</div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                <?php elseif (isset($_GET['pesan']) && $_GET['pesan'] == 'email_gagal'): ?>
                    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                        <div class="d-flex align-items-center">
                            <span class="material-symbols-outlined me-2">error</span>
                            <div><strong>Gagal!</strong> Tidak dapat mengirim email. Pastikan konfigurasi benar.</div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                <?php endif; ?>

                <!-- Judul & Tombol Tambah Surat -->
                <section class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-3 mb-4">
                    <div>
                        <h1 class="fw-bold mb-1 fs-3">Daftar Semua Surat</h1>
                        <p class="text-secondary mb-0 small">Kelola semua surat yang masuk ke sistem desa.</p>
                    </div>
                    <a href="PengajuanSurat.php" class="btn btn-brand d-flex align-items-center gap-2 px-3 py-2 rounded-3 shadow-sm">
                        <span class="material-symbols-outlined fs-6">add</span>
                        <span class="fw-semibold small">Tambah Surat Baru</span>
                    </a>
                </section>

                <!-- Form Pencarian/Filter -->
                <section class="row g-3 mb-4" aria-label="Filter Data">
                    <div class="col-md-6">
                        <form action="" method="GET">
                            <div class="input-group search-group">
                                <span class="input-group-text bg-white border-end-0 text-secondary">
                                    <span class="material-symbols-outlined fs-5">search</span>
                                </span>
                                <input type="search" name="cari" class="form-control border-start-0 ps-0"
                                    placeholder="Cari NIK atau Nama Pemohon..."
                                    value="<?= isset($_GET['cari']) ? htmlspecialchars($_GET['cari']) : '' ?>">
                            </div>
                        </form>
                    </div>
                </section>

                <!-- Tabel Data Surat -->
                <section class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="table-responsive">
                        <table class="table table-hover table-custom align-middle mb-0">
                            <thead class="bg-light border-bottom">
                                <tr>
                                    <th scope="col" class="py-3 px-4">No. Pengajuan</th>
                                    <th scope="col" class="py-3">Jenis Surat</th>
                                    <th scope="col" class="py-3">Pemohon (NIK)</th>
                                    <th scope="col" class="py-3">Tanggal Pengajuan</th>
                                    <th scope="col" class="py-3">Status</th>
                                    <th scope="col" class="py-3 px-4 text-end">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (mysqli_num_rows($result) > 0): ?>
                                    <?php while ($row = mysqli_fetch_assoc($result)): ?>

                                        <?php
                                        // <!-- Format tanggal, nomor surat, label surat, dan badge status -->
                                        $tanggal = date('d M Y', strtotime($row['tanggal_pengajuan']));
                                        $no_surat = formatNoPengajuan($row['id_pengajuan']);
                                        $label_surat = getLabelJenisSurat($row['jenis_surat']);
                                        $badge = getStatusBadge($row['status_pengajuan']);
                                        ?>

                                        <tr>
                                            <!-- Nomor Pengajuan -->
                                            <td class="px-4 fw-medium text-secondary"><?= $no_surat ?></td>
                                            <!-- Jenis Surat -->
                                            <td class="small text-dark"><?= $label_surat ?></td>
                                            <!-- Nama Pemohon & NIK -->
                                            <td>
                                                <div class="d-flex flex-column">
                                                    <span class="fw-medium text-dark"><?= htmlspecialchars($row['nama_lengkap']) ?></span>
                                                    <span class="small text-muted"><?= htmlspecialchars($row['nik']) ?></span>
                                                </div>
                                            </td>
                                            <!-- Tanggal Pengajuan -->
                                            <td class="text-secondary small"><?= $tanggal ?></td>
                                            <!-- Status Surat -->
                                            <td>
                                                <div class="badge <?= $badge['class'] ?> rounded-pill px-3 py-2 d-inline-flex align-items-center gap-1 fw-medium border border-0">
                                                    <span class="material-symbols-outlined" style="font-size: 16px;"><?= $badge['icon'] ?></span>
                                                    <span><?= $row['status_pengajuan'] ?></span>
                                                </div>
                                            </td>
                                            <!-- Tombol Aksi -->
                                            <td class="px-4 text-end">
                                                <div class="d-flex justify-content-end gap-2">

                                                    <!-- Tombol Detail Surat (Modal) -->
                                                    <button type="button" class="btn btn-sm btn-light text-primary btn-detail"
                                                        data-bs-toggle="modal" data-bs-target="#modalDetailSurat"
                                                        data-id="<?= $no_surat ?>"
                                                        data-jenis="<?= htmlspecialchars($row['jenis_surat']) ?>"
                                                        data-pemohon="<?= htmlspecialchars($row['nama_lengkap']) ?>"
                                                        data-nik="<?= htmlspecialchars($row['nik']) ?>"
                                                        data-ttl="<?= htmlspecialchars($row['tempat_lahir'] . ', ' . date('d-m-Y', strtotime($row['tanggal_lahir']))) ?>"
                                                        data-jk="<?= htmlspecialchars($row['jenis_kelamin']) ?>"
                                                        data-agama="<?= htmlspecialchars($row['agama']) ?>"
                                                        data-status="<?= htmlspecialchars($row['status_perkawinan']) ?>"
                                                        data-pekerjaan="<?= htmlspecialchars($row['pekerjaan']) ?>"
                                                        data-ortu="<?= isset($row['nama_orang_tua']) ? htmlspecialchars($row['nama_orang_tua']) : '-' ?>"
                                                        data-lingkungan="<?= isset($row['lingkungan']) ? htmlspecialchars($row['lingkungan']) : '-' ?>"
                                                        data-alamat="<?= htmlspecialchars($row['alamat']) ?>"
                                                        data-keperluan="<?= htmlspecialchars($row['keperluan']) ?>"
                                                        data-tanggal="<?= $tanggal ?>"
                                                        data-status-pengajuan="<?= $row['status_pengajuan'] ?>"
                                                        data-alasan="<?= isset($row['keterangan_tolak']) ? htmlspecialchars($row['keterangan_tolak']) : '-' ?>"
                                                        data-file-ktp="../uploads/<?= htmlspecialchars($row['file_ktp']) ?>"
                                                        data-file-kk="../uploads/<?= htmlspecialchars($row['file_kk']) ?>"
                                                        title="Lihat Detail">
                                                        <span class="material-symbols-outlined fs-5">visibility</span>
                                                    </button>

                                                    <?php
                                                    // <!-- Logic tombol aksi sesuai role dan status surat -->
                                                    // STAFF / PETUGAS / ADMIN (Verifikasi, Tolak, Print, Email)
                                                    if ($role_session == 'admin' || $role_session == 'petugas') {

                                                        // Verifikasi (hanya jika Pending)
                                                        if ($row['status_pengajuan'] == 'Pending') { ?>

                                                            <button type="button" class="btn btn-sm btn-success" title="Verifikasi"
                                                                onclick="tampilkanModalProses('<?= $row['id_pengajuan'] ?>', 'verifikasi')">
                                                                <span class="material-symbols-outlined fs-5">check</span>
                                                            </button>

                                                            <button type="button" class="btn btn-sm btn-danger text-white"
                                                                onclick="tampilkanModalProses('<?= $row['id_pengajuan'] ?>', 'tolak')" title="Tolak">
                                                                <span class="material-symbols-outlined fs-5">close</span>
                                                            </button>

                                                        <?php }

                                                        // Print & Email (hanya jika Selesai)
                                                        if ($row['status_pengajuan'] == 'Selesai') { ?>

                                                            <a href="../config/CetakSurat.php?id=<?= $row['id_pengajuan'] ?>" target="_blank"
                                                                class="btn btn-sm btn-dark" title="Cetak / Simpan PDF">
                                                                <span class="material-symbols-outlined fs-5">print</span>
                                                            </a>

                                                            <!-- Kirim Notifikasi Email -->
                                                            <button type="button" class="btn btn-sm btn-primary" title="Kirim Notifikasi Email"
                                                                onclick="tampilkanModalProses('<?= $row['id_pengajuan'] ?>', 'kirim_email')">
                                                                <span class="material-symbols-outlined fs-5">mail</span>
                                                            </button>

                                                        <?php }
                                                    }

                                                    // KEPALA DESA / KADES (ACC, Tolak)
                                                    if ($role_session == 'kades' || $role_session == 'kadep') {

                                                        // ACC / Tolak (hanya jika Diproses)
                                                        if ($row['status_pengajuan'] == 'Diproses') { ?>

                                                            <button type="button" class="btn btn-sm btn-primary" title="ACC / Tanda Tangan"
                                                                onclick="tampilkanModalProses('<?= $row['id_pengajuan'] ?>', 'acc')">
                                                                <span class="material-symbols-outlined fs-5">draw</span>
                                                            </button>

                                                            <button type="button" class="btn btn-sm btn-danger"
                                                                onclick="tampilkanModalProses('<?= $row['id_pengajuan'] ?>', 'tolak')" title="Tolak">
                                                                <span class="material-symbols-outlined fs-5">block</span>
                                                            </button>

                                                        <?php }
                                                    }

                                                    // ADMIN (Hapus Permanen)
                                                    if ($role_session == 'admin') { ?>
                                                        <button type="button" class="btn btn-sm btn-light text-danger"
                                                            onclick="hapusSurat('<?= $row['id_pengajuan'] ?>', '<?= htmlspecialchars($row['nama_lengkap']) ?>')"
                                                            title="Hapus">
                                                            <span class="material-symbols-outlined fs-5">delete</span>
                                                        </button>
                                                    <?php } ?>

                                                </div>
                                            </td>
                                        </tr>

                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <!-- Jika tidak ada data surat -->
                                    <tr>
                                        <td colspan="6" class="text-center py-5 text-muted">
                                            <span class="material-symbols-outlined fs-1 mb-2 d-block">inbox</span>
                                            Belum ada data pengajuan surat.
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </section>

                <!-- Navigasi Halaman (Pagination) -->
                <nav class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4 gap-3 border-top pt-4" aria-label="Navigasi Halaman">
                    <p class="text-secondary mb-0 small fw-medium">
                        Menampilkan halaman <span class="text-dark fw-bold"><?= $halamanAktif ?></span> dari <?= $jumlahHalaman ?>
                        <span class="text-muted mx-1">|</span> Total <?= $jumlahData ?> surat
                    </p>

                    <ul class="pagination mb-0">
                        <!-- Logic tombol prev/next dan nomor halaman -->
                        <?php if ($halamanAktif > 1): ?>
                            <li class="page-item">
                                <a class="page-link" href="?halaman=<?= $halamanAktif - 1 ?>&cari=<?= $keyword ?>" aria-label="Previous">
                                    <span class="material-symbols-outlined fs-6">chevron_left</span>
                                </a>
                            </li>
                        <?php else: ?>
                            <li class="page-item disabled">
                                <span class="page-link"><span class="material-symbols-outlined fs-6">chevron_left</span></span>
                            </li>
                        <?php endif; ?>

                        <?php
                        $start_number = ($halamanAktif > 2) ? $halamanAktif - 2 : 1;
                        $end_number = ($halamanAktif < ($jumlahHalaman - 2)) ? $halamanAktif + 2 : $jumlahHalaman;

                        if ($start_number > 1) {
                            echo '<li class="page-item"><a class="page-link" href="?halaman=1&cari=' . $keyword . '">1</a></li>';
                            if ($start_number > 2) {
                                echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                            }
                        }

                        for ($i = $start_number; $i <= $end_number; $i++):
                        ?>
                            <li class="page-item <?= ($i == $halamanAktif) ? 'active' : '' ?>">
                                <a class="page-link" href="?halaman=<?= $i ?>&cari=<?= $keyword ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>

                        <?php
                        if ($end_number < $jumlahHalaman) {
                            if ($end_number < ($jumlahHalaman - 1)) {
                                echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                            }
                            echo '<li class="page-item"><a class="page-link" href="?halaman=' . $jumlahHalaman . '&cari=' . $keyword . '">' . $jumlahHalaman . '</a></li>';
                        }
                        ?>

                        <?php if ($halamanAktif < $jumlahHalaman): ?>
                            <li class="page-item">
                                <a class="page-link" href="?halaman=<?= $halamanAktif + 1 ?>&cari=<?= $keyword ?>" aria-label="Next">
                                    <span class="material-symbols-outlined fs-6">chevron_right</span>
                                </a>
                            </li>
                        <?php else: ?>
                            <li class="page-item disabled">
                                <span class="page-link"><span class="material-symbols-outlined fs-6">chevron_right</span></span>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>

            </div>
        </main>

    </div>

    <!-- Modal Detail, Hapus, dan Proses Surat -->
    <?php include 'modals/ModalDetailSurat.php'; ?>
    <?php include 'modals/ModalHapusSurat.php'; ?>
    <?php include 'modals/ModalProsesSurat.php'; ?>

    <!-- Script Bootstrap & Custom -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/MenuToggleResponsive.js"></script>
    <script src="../js/ModalDetailSurat.js"></script>
    <script src="../js/ModalHapusSurat.js"></script>
    <script src="../js/ModalProsesSurat.js"></script>

</body>
</html>