<?php
// Konfigurasi manajemen pengguna (query, pagination, dsb)
include '../config/ManajemenPenggunaConfig.php'; 

// Inisial nama user untuk avatar
include '../config/Inisial.php';

// Proteksi session & role user
include '../config/RoleSession.php';
?>

<!DOCTYPE html>
<html lang="id">

<!-- Include header (meta, css, dll) -->
<?php include 'header.php'; ?>

<body>

    <div class="d-flex" id="wrapper">

        <!-- Sidebar navigasi -->
        <aside id="sidebar-wrapper">
            <?php include 'sidebar.php'; ?>
        </aside>

        <!-- Konten utama -->
        <main id="page-content-wrapper">

            <!-- Header / Navbar -->
            <header class="sticky-top">
                <nav class="navbar navbar-expand-lg bg-white border-bottom px-4 py-3" aria-label="Top Navigation">
                    <div class="d-flex align-items-center justify-content-between w-100">

                        <!-- Judul halaman & toggle sidebar -->
                        <div class="d-flex align-items-center gap-3">
                            <button class="btn btn-light d-md-none border" id="menu-toggle" aria-label="Toggle Sidebar">
                                <span class="material-symbols-outlined">menu</span>
                            </button>
                            <h2 class="h5 fw-bold mb-0 text-dark">Manajemen Pengguna</h2>
                        </div>

                        <!-- Informasi user login -->
                        <div class="d-flex align-items-center gap-4">
                            <div class="text-end d-none d-md-block">
                                <span class="d-block fw-bold text-dark small">
                                    <?= htmlspecialchars($nama_user) ?>
                                </span>
                                <span class="d-block text-secondary x-small" style="font-size: 0.75rem;">
                                    <?= $label_role ?>
                                </span>
                            </div>

                            <!-- Avatar inisial -->
                            <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center fw-bold shadow-sm"
                                style="width: 40px; height: 40px; font-size: 16px; user-select: none;">
                                <?= $inisial ?>
                            </div>
                        </div>

                    </div>
                </nav>
            </header>

            <!-- Container utama -->
            <div class="container-fluid p-4 p-lg-5">

                <!-- Alert notifikasi -->
                <?php if ($status == 'sukses'): ?>
                    <!-- Alert sukses simpan -->
                    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4 rounded-3" role="alert">
                        <div class="d-flex align-items-center">
                            <span class="material-symbols-outlined me-2 fs-5">check_circle</span>
                            <div><strong>Berhasil!</strong> Data pengguna telah disimpan.</div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>

                <?php elseif ($status == 'hapus_sukses'): ?>
                    <!-- Alert sukses hapus -->
                    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4 rounded-3" role="alert">
                        <div class="d-flex align-items-center">
                            <span class="material-symbols-outlined me-2 fs-5">delete</span>
                            <div><strong>Terhapus!</strong> Data pengguna berhasil dihapus.</div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>

                <?php elseif ($status == 'gagal'): ?>
                    <!-- Alert gagal -->
                    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4 rounded-3" role="alert">
                        <div class="d-flex align-items-center">
                            <span class="material-symbols-outlined me-2 fs-5">error</span>
                            <div>
                                <strong>Gagal!</strong>
                                <?= htmlspecialchars($pesan) ?: 'Terjadi kesalahan sistem.' ?>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <!-- Judul & tombol tambah pengguna -->
                <section class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
                    <div>
                        <h1 class="fw-bold mb-1 display-6 fs-3 text-dark">Daftar Pengguna</h1>
                        <p class="text-secondary small mb-0">Kelola akses dan data pengguna sistem.</p>
                    </div>

                    <!-- Tombol tambah pengguna -->
                    <a href="Tambah_pengguna.php"
                        class="btn btn-brand d-flex align-items-center gap-2 px-3 py-2 rounded-3 shadow-sm text-decoration-none">
                        <span class="material-symbols-outlined fs-6">add</span>
                        <span class="fw-semibold small">Tambah Pengguna</span>
                    </a>
                </section>

                <!-- Form pencarian -->
                <section class="row g-3 mb-4">
                    <div class="col-md-5 col-lg-4">
                        <form action="" method="GET">
                            <div class="input-group search-group">
                                <span class="input-group-text bg-white border-end-0 text-secondary">
                                    <span class="material-symbols-outlined fs-5">search</span>
                                </span>
                                <input type="search" name="cari"
                                    class="form-control border-start-0 ps-0"
                                    placeholder="Cari nama, username, atau email..."
                                    value="<?= isset($_GET['cari']) ? htmlspecialchars($_GET['cari']) : '' ?>">
                            </div>
                        </form>
                    </div>
                </section>

                <!-- Tabel data pengguna -->
                <section class="card border-0 shadow-sm rounded-4 p-0 overflow-hidden">
                    <div class="table-responsive">
                        <table class="table table-hover table-custom w-100 mb-0 align-middle">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4">ID Pengguna</th>
                                    <th>Nama Lengkap</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Peran</th>
                                    <th>Status</th>
                                    <th class="text-end pe-4">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                <!-- Jika data tersedia -->
                                <?php if (mysqli_num_rows($query) > 0): ?>
                                    <?php while ($data = mysqli_fetch_assoc($query)): ?>
                                        <?php
                                        // ===== LOGIKA STATUS BADGE =====
                                        $badge_class = 'bg-secondary text-white';
                                        $status_text = 'Tidak Aktif';
                                        $icon_status = 'block';

                                        if ($data['status'] == 'aktif') {
                                            $badge_class = 'bg-success text-white';
                                            $status_text = 'Aktif';
                                            $icon_status = 'check_circle';
                                        }

                                        // Format ID pengguna
                                        $formatted_id = "USR-" . str_pad($data['id_user'], 3, '0', STR_PAD_LEFT);
                                        ?>
                                        <tr>
                                            <td class="ps-4 text-secondary small fw-medium"><?= $formatted_id ?></td>
                                            <td class="fw-medium text-dark"><?= htmlspecialchars($data['nama_lengkap']) ?></td>
                                            <td class="text-secondary small"><?= htmlspecialchars($data['username']) ?></td>
                                            <td class="text-secondary small"><?= htmlspecialchars($data['email'] ?? '-') ?></td>
                                            <td class="text-dark text-capitalize"><?= htmlspecialchars($data['role']) ?></td>

                                            <!-- Status pengguna -->
                                            <td>
                                                <div class="badge <?= $badge_class ?> rounded-pill px-3 py-2 d-inline-flex align-items-center gap-1 fw-medium">
                                                    <span class="material-symbols-outlined" style="font-size: 16px;">
                                                        <?= $icon_status ?>
                                                    </span>
                                                    <span><?= $status_text ?></span>
                                                </div>
                                            </td>

                                            <!-- Aksi edit & hapus -->
                                            <td class="text-end pe-4">
                                                <div class="d-flex justify-content-end gap-2">

                                                    <!-- Tombol edit -->
                                                    <a href="Edit_pengguna.php?id=<?= $data['id_user'] ?>"
                                                        class="btn btn-light rounded-3 shadow-sm border-0"
                                                        title="Edit">
                                                        <span class="material-symbols-outlined fs-5 text-primary">edit</span>
                                                    </a>

                                                    <!-- Tombol hapus -->
                                                    <button type="button"
                                                        class="btn btn-light rounded-3 shadow-sm border-0"
                                                        onclick="konfirmasiHapus('<?= $data['id_user'] ?>', '<?= htmlspecialchars($data['nama_lengkap']) ?>')"
                                                        title="Hapus">
                                                        <span class="material-symbols-outlined fs-5 text-danger">delete</span>
                                                    </button>

                                                </div>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>

                                <!-- Jika data kosong -->
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7" class="text-center py-5 text-muted">
                                            <span class="material-symbols-outlined fs-1 mb-2 d-block">person_off</span>
                                            Belum ada data pengguna.
                                        </td>
                                    </tr>
                                <?php endif; ?>

                            </tbody>
                        </table>
                    </div>
                </section>

                <!-- Pagination -->
                <nav class="mt-4 pt-3" aria-label="Navigasi Halaman">
                    <div class="d-flex justify-content-center align-items-center gap-3">
                        <!-- Pagination logic (prev, number, next) -->
                        ...
                    </div>
                </nav>

            </div>
        </main>
    </div>

    <!-- Modal konfirmasi hapus -->
    <?php include 'modals/ModalHapusPengguna.php'; ?>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/ModalKonfirmasi.js"></script>
    <script src="../js/MenuToggleResponsive.js"></script>

</body>
</html>
