<?php 
// <!-- Panggil konfigurasi dan logic edit pengguna -->
include '../config/EditPenggunaConfig.php'; 

// <!-- Penanda halaman aktif untuk sidebar -->
$currentPage = 'ManajemenPengguna.php'; 

// <!-- Tangkap status dan pesan dari URL untuk alert -->
$status = isset($_GET['status']) ? $_GET['status'] : '';
$pesan  = isset($_GET['pesan']) ? $_GET['pesan'] : '';
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
            <header>
                <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom border-custom px-4 py-3 sticky-top">
                    <div class="d-flex align-items-center gap-3">
                        <!-- Tombol toggle sidebar (hanya muncul di mobile) -->
                        <button class="btn btn-sm btn-light d-md-none border-custom" id="menu-toggle">
                            <span class="material-symbols-outlined">menu</span>
                        </button>
                        <h1 class="h5 fw-bold mb-0 text-dark">Manajemen Pengguna</h1>
                    </div>
                </nav>
            </header>

            <div class="container-fluid px-4 px-lg-5 py-3">

                <!-- Alert Sukses/Gagal -->
                <?php if ($status == 'sukses'): ?>
                    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4 rounded-3" role="alert">
                        <div class="d-flex align-items-center">
                            <span class="material-symbols-outlined me-2 fs-5">check_circle</span>
                            <div>
                                <strong>Berhasil!</strong> Data pengguna telah diperbarui. 
                                <a href="ManajemenPengguna.php" class="alert-link">Kembali ke daftar</a>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php elseif ($status == 'gagal'): ?>
                    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4 rounded-3" role="alert">
                        <div class="d-flex align-items-center">
                            <span class="material-symbols-outlined me-2 fs-5">error</span>
                            <div>
                                <strong>Gagal!</strong> <?= htmlspecialchars($pesan) ?: 'Terjadi kesalahan saat memperbarui data.' ?>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <!-- Breadcrumb Navigasi -->
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="ManajemenPengguna.php" class="text-decoration-none text-secondary">Manajemen Pengguna</a></li>
                        <li class="breadcrumb-item active text-dark fw-medium" aria-current="page">Edit Data</li>
                    </ol>
                </nav>

                <!-- Judul dan Deskripsi Halaman -->
                <div class="mb-4">
                    <h2 class="fw-bold display-6 fs-3 text-dark mb-2">Edit Pengguna</h2>
                    <p class="text-secondary mb-0 small">Perbarui informasi pengguna di bawah ini.</p>
                </div>

                <!-- Form Edit Pengguna -->
                <section class="card-custom border-0 shadow-sm">
                    <div class="card-body p-4">

                        <form method="POST">
                            
                            <!-- Data Akun -->
                            <h5 class="fw-bold text-dark border-bottom pb-2 mb-4">Data Akun</h5>

                            <div class="row g-4 mb-4">
                                <!-- Nama Lengkap -->
                                <div class="col-12">
                                    <label class="form-label fw-medium text-secondary small">Nama Lengkap</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-secondary">
                                            <span class="material-symbols-outlined fs-5">badge</span>
                                        </span>
                                        <input type="text" name="nama_lengkap" class="form-control border-start-0 ps-0 bg-light-subtle" value="<?= htmlspecialchars($data['nama_lengkap']) ?>" required>
                                    </div>
                                </div>

                                <!-- Username -->
                                <div class="col-md-6">
                                    <label class="form-label fw-medium text-secondary small">Username</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-secondary">
                                            <span class="material-symbols-outlined fs-5">account_circle</span>
                                        </span>
                                        <input type="text" name="username" class="form-control border-start-0 ps-0 bg-light-subtle" value="<?= htmlspecialchars($data['username']) ?>" required>
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="col-md-6">
                                    <label class="form-label fw-medium text-secondary small">Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-secondary">
                                            <span class="material-symbols-outlined fs-5">email</span>
                                        </span>
                                        <input type="email" name="email" class="form-control border-start-0 ps-0 bg-light-subtle" value="<?= htmlspecialchars($data['email']) ?>">
                                    </div>
                                </div>
                            </div>

                            <!-- Info Ganti Password -->
                            <div class="alert alert-light border-start border-3 border-warning shadow-sm mb-4" role="alert">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="material-symbols-outlined text-warning">lock_reset</span>
                                    <div>
                                        <strong class="text-dark">Ganti Password?</strong>
                                        <span class="text-secondary small d-block">Biarkan kolom password kosong jika tidak ingin mengubah password user ini.</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Password Baru -->
                            <div class="mb-4">
                                <label class="form-label fw-medium text-secondary small">Password Baru</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-secondary">
                                        <span class="material-symbols-outlined fs-5">lock</span>
                                    </span>
                                    <input type="password" name="password" class="form-control border-start-0 ps-0 bg-light-subtle" placeholder="••••••••">
                                </div>
                            </div>

                            <!-- Hak Akses & Status -->
                            <h5 class="fw-bold text-dark border-bottom pb-2 mb-4 mt-5">Hak Akses & Status</h5>

                            <div class="row g-4 mb-4">
                                <!-- Pilihan Role -->
                                <div class="col-md-6">
                                    <label class="form-label fw-medium text-secondary small">Peran (Role)</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-secondary">
                                            <span class="material-symbols-outlined fs-5">manage_accounts</span>
                                        </span>
                                        <select name="role" class="form-select border-start-0 ps-0 bg-light-subtle">
                                            <option value="user" <?= $data['role'] == 'user' ? 'selected' : '' ?>>Warga / User</option>
                                            <option value="petugas" <?= $data['role'] == 'petugas' ? 'selected' : '' ?>>Petugas Desa</option>
                                            <option value="admin" <?= $data['role'] == 'admin' ? 'selected' : '' ?>>Administrator</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Pilihan Status Akun -->
                                <div class="col-md-6">
                                    <label class="form-label fw-medium text-secondary small">Status Akun</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-secondary">
                                            <span class="material-symbols-outlined fs-5">toggle_on</span>
                                        </span>
                                        <select name="status" class="form-select border-start-0 ps-0 bg-light-subtle">
                                            <option value="aktif" <?= $data['status'] == 'aktif' ? 'selected' : '' ?>>Aktif</option>
                                            <option value="nonaktif" <?= $data['status'] == 'nonaktif' ? 'selected' : '' ?>>Nonaktif / Suspend</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Tombol Aksi -->
                            <div class="d-flex justify-content-end gap-3 mt-5 pt-3 border-top">
                                <a href="ManajemenPengguna.php" class="btn btn-light border px-4 py-2 text-secondary fw-medium">
                                    Batal
                                </a>
                                <button type="submit" name="update" class="btn btn-brand px-4 py-2 fw-medium d-flex align-items-center gap-2">
                                    <span class="material-symbols-outlined fs-5">save</span>
                                    Simpan Perubahan
                                </button>
                            </div>

                        </form>

                    </div>
                </section>

            </div>
        </main>
    </div>

    <!-- Script Bootstrap & Custom -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>