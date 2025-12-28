<?php
// Sertakan file konfigurasi (pastikan path ini benar)
include '../config/PengaturanConfig.php';
include '../config/RoleSession.php';
include '../config/Inisial.php';

?>

<!DOCTYPE html>
<html lang="id">
<?php include 'header.php'; ?>

<body>

    <!-- MAIN CONTENT -->
    <div class="d-flex" id="wrapper">
        <!-- SIDEBAR -->
        <aside id="sidebar-wrapper">
            <?php include 'sidebar.php'; ?>
        </aside>

        <!-- PAGE CONTENT -->
        <main id="page-content-wrapper">
            <!-- HEADER / NAVBAR -->
            <header class="sticky-top">
                <nav class="navbar navbar-expand-lg bg-white border-bottom px-4 py-3 shadow-sm-custom" aria-label="Top Navigation">
                    <div class="d-flex align-items-center justify-content-between w-100">
                        <div class="d-flex align-items-center gap-3">
                            <button class="btn btn-light d-md-none border" id="menu-toggle" aria-label="Toggle Sidebar">
                                <span class="material-symbols-outlined">menu</span>
                            </button>
                            <h1 class="h5 fw-bold mb-0 text-dark">Pengaturan</h1>
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

            <!-- MAIN CONTENT -->
            <div class="container-fluid p-4 p-lg-5">
                <!-- Breadcrumb & Title -->
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb mb-1">
                        <li class="breadcrumb-item"><a href="Dashboard.php" class="text-decoration-none text-secondary small">Dashboard</a></li>
                        <li class="breadcrumb-item active text-dark small" aria-current="page">Pengaturan</li>
                    </ol>
                    <h2 class="fw-bold text-dark display-6 fs-3">Pengaturan Akun</h2>
                </nav>

                <!-- Notifikasi -->
                <?php if (isset($_GET['status'])): ?>
                    <?php if ($_GET['status'] == 'sukses'): ?>
                        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
                            <div class="d-flex align-items-center gap-2">
                                <span class="material-symbols-outlined fs-5">check_circle</span>
                                <div><strong>Berhasil!</strong> Profil Anda telah diperbarui.</div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php elseif ($_GET['status'] == 'gagal'): ?>
                        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
                            <div class="d-flex align-items-center gap-2">
                                <span class="material-symbols-outlined fs-5">error</span>
                                <div><strong>Gagal!</strong> Password lama salah atau terjadi kesalahan sistem.</div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>

                <!-- Tabs Navigation -->
                <section class="mb-4">
                    <ul class="nav nav-tabs border-bottom" id="settingsTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active text-dark fw-bold border-0 border-bottom border-3 border-dark px-0 py-2 me-4 bg-transparent"
                                id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab">
                                Profil Pengguna
                            </button>
                        </li>
                    </ul>
                </section>

                <!-- Tabs Content -->
                <section class="tab-content" id="settingsTabContent">
                    <div class="tab-pane fade show active" id="profile" role="tabpanel">
                        <!-- Form Update Profil Pengguna -->
                        <form class="card border-0 shadow-sm rounded-4 p-4 p-lg-5" method="POST">
                            <div class="row g-4">

                                <div class="col-md-6">
                                    <label for="namaLengkap" class="form-label fw-medium text-secondary small">Nama Lengkap</label>
                                    <input type="text" name="nama_lengkap"
                                        class="form-control form-control-lg fs-6 bg-light border-0"
                                        id="namaLengkap"
                                        value="<?= htmlspecialchars($data['nama_lengkap']) ?>" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="username" class="form-label fw-medium text-secondary small">Username</label>
                                    <input type="text" name="username"
                                        class="form-control form-control-lg fs-6 bg-light border-0"
                                        id="username"
                                        value="<?= htmlspecialchars($data['username']) ?>" required>
                                </div>

                                <div class="col-md-12">
                                    <label for="email" class="form-label fw-medium text-secondary small">Alamat Email</label>
                                    <input type="email" name="email"
                                        class="form-control form-control-lg fs-6 bg-light border-0"
                                        id="email"
                                        value="<?= htmlspecialchars($data['email']) ?>">
                                </div>

                                <div class="col-12">
                                    <hr class="text-muted opacity-25 my-2">
                                </div>

                                <div class="col-md-6">
                                    <label for="passwordLama" class="form-label fw-medium text-secondary small">Password Lama</label>
                                    <input type="password" name="password_lama"
                                        class="form-control form-control-lg fs-6 bg-light border-0"
                                        id="passwordLama"
                                        placeholder="Isi jika ingin ganti password">
                                </div>

                                <div class="col-md-6">
                                    <label for="passwordBaru" class="form-label fw-medium text-secondary small">Password Baru</label>
                                    <input type="password" name="password_baru"
                                        class="form-control form-control-lg fs-6 bg-light border-0"
                                        id="passwordBaru"
                                        placeholder="Masukkan password baru">
                                </div>

                            </div>

                            <div class="d-flex justify-content-end gap-3 mt-5 pt-3 border-top">
                                <button type="button" class="btn btn-light border px-4 fw-medium text-secondary" onclick="window.location.reload()">Batal</button>
                                <button type="submit" name="update_profil" class="btn btn-brand px-4 fw-medium shadow-sm">Simpan Perubahan</button>
                            </div>
                        </form>

                    </div>
                </section>

            </div>
        </main>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Script Menu Toggle -->
    <script src="../js/MenuToggleResponsive.js"></script>
</body>

</html>