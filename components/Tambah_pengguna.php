<?php
include '../config/TambahPenggunaConfig.php';

// Logika menangkap status dari URL (biasanya dikirim balik oleh Config)
$status = isset($_GET['status']) ? $_GET['status'] : '';
$pesan = isset($_GET['pesan']) ? $_GET['pesan'] : '';

// SET MENU AKTIF SECARA MANUAL
$currentPage = 'ManajemenPengguna.php'; 
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
            <header>
                <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom border-custom px-4 py-3 sticky-top">
                    <div class="d-flex align-items-center gap-3">
                        <button class="btn btn-sm btn-light d-md-none border-custom" id="menu-toggle">
                            <span class="material-symbols-outlined">menu</span>
                        </button>
                        <h1 class="h5 fw-bold mb-0 text-dark">Manajemen Pengguna</h1>
                    </div>
                </nav>
            </header>

            <!-- MAIN CONTENT -->
            <div class="container-fluid px-4 px-lg-5 py-4">
                <!-- Notifikasi -->
                <?php if ($status == 'sukses'): ?>
                    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4 rounded-3" role="alert">
                        <div class="d-flex align-items-center">
                            <span class="material-symbols-outlined me-2">check_circle</span>
                            <div>
                                <strong>Berhasil!</strong> Pengguna baru telah ditambahkan ke sistem.
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php elseif ($status == 'gagal'): ?>
                    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4 rounded-3" role="alert">
                        <div class="d-flex align-items-center">
                            <span class="material-symbols-outlined me-2">error</span>
                            <div>
                                <strong>Gagal!</strong> <?= htmlspecialchars($pesan) ?: 'Terjadi kesalahan saat menyimpan data.' ?>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <!-- Breadcrumb & Title -->
                <nav aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="ManajemenPengguna.php" class="text-decoration-none text-secondary">Manajemen Pengguna</a></li>
                        <li class="breadcrumb-item active text-dark fw-medium" aria-current="page">Tambah Baru</li>
                    </ol>
                </nav>

                <!-- Title and Description -->
                <div class="mb-3">
                    <h2 class="fw-bold display-6 fs-3 text-dark mb-2">Tambah Pengguna Baru</h2>
                    <p class="text-secondary mb-0 small">Lengkapi formulir di bawah untuk mendaftarkan user baru ke dalam sistem.</p>
                </div>

                <!-- Form Tambah Pengguna -->
                <section class="card-custom border-0 shadow-sm">
                    <div class="card-body px-4 px-lg-4 py-4">
                        <form method="POST" action="">
                            <h5 class="fw-bold text-dark border-bottom pb-2 mb-4">Data Akun</h5>

                            <!-- Form Fields -->
                            <div class="row g-4 mb-4">
                                <div class="col-12">
                                    <label class="form-label fw-medium text-secondary small">Nama Lengkap</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-secondary">
                                            <span class="material-symbols-outlined fs-5">badge</span>
                                        </span>
                                        <input type="text" name="nama_lengkap" class="form-control border-start-0 ps-0 bg-light-subtle" required placeholder="Masukkan nama lengkap">
                                    </div>
                                </div>

                                <!-- Form Fields -->
                                <div class="col-md-6">
                                    <label class="form-label fw-medium text-secondary small">Username</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-secondary">
                                            <span class="material-symbols-outlined fs-5">account_circle</span>
                                        </span>
                                        <input type="text" name="username" class="form-control border-start-0 ps-0 bg-light-subtle" required placeholder="Masukkan username">
                                    </div>
                                </div>

                                <!-- Form Fields -->
                                <div class="col-md-6">
                                    <label class="form-label fw-medium text-secondary small">Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-secondary">
                                            <span class="material-symbols-outlined fs-5">email</span>
                                        </span>
                                        <input type="email" name="email" class="form-control border-start-0 ps-0 bg-light-subtle" placeholder="contoh@desa.go.id">
                                    </div>
                                </div>

                                <!-- Form Fields -->
                                <div class="col-12">
                                    <label class="form-label fw-medium text-secondary small">Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-secondary">
                                            <span class="material-symbols-outlined fs-5">lock</span>
                                        </span>
                                        <input type="password" name="password" class="form-control border-start-0 ps-0 bg-light-subtle" required placeholder="••••••••">
                                    </div>
                                </div>
                            </div>

                            <h5 class="fw-bold text-dark border-bottom pb-2 mb-4 mt-5">Hak Akses</h5>

                            <!-- Form Fields -->
                            <div class="row g-4 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-medium text-secondary small">Peran (Role)</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-secondary">
                                            <span class="material-symbols-outlined fs-5">manage_accounts</span>
                                        </span>
                                        <select name="role" class="form-select border-start-0 ps-0 bg-light-subtle">
                                            <option value="user">Warga / User</option>
                                            <option value="petugas">Petugas Desa</option>
                                            <option value="admin">Administrator</option>
                                            <option value="kades">Kepala Desa</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-medium text-secondary small">Status Akun</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-secondary">
                                            <span class="material-symbols-outlined fs-5">toggle_on</span>
                                        </span>
                                        <select name="status" class="form-select border-start-0 ps-0 bg-light-subtle">
                                            <option value="aktif">Aktif</option>
                                            <option value="nonaktif">Nonaktif / Suspend</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Form Actions -->
                            <div class="d-flex justify-content-end gap-3 mt-5 pt-3 border-top">
                                <a href="ManajemenPengguna.php" class="btn btn-light border px-4 py-2 text-secondary fw-medium">Batal</a>
                                <button type="submit" name="submit" class="btn btn-brand px-4 py-2 fw-medium d-flex align-items-center gap-2">
                                    <span class="material-symbols-outlined fs-5">save</span>
                                    Simpan Pengguna
                                </button>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </main>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>