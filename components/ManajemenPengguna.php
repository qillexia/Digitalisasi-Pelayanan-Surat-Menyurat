<?php
session_start();
include '../config/koneksi.php';

if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("location: ../pages/LoginPage.php?pesan=belum_login");
    exit();
}

$page = 'pengguna';

// Query ambil data user
$query = mysqli_query($koneksi, "SELECT * FROM users ORDER BY id_user DESC");
?>

<!DOCTYPE html>
<html lang="id">

<?php include 'header.php'; ?>

<body>

    <div class="d-flex" id="wrapper">

        <!-- Sidebar -->
        <?php include 'sidebar.php'; ?>

        <!-- Main Content -->
        <main id="page-content-wrapper">

            <!-- HEADER / NAV TOP -->
            <header class="sticky-top">
                <nav class="navbar navbar-expand-lg bg-white border-bottom px-4 py-3" aria-label="Top Navigation">
                    <div class="d-flex align-items-center justify-content-between w-100">

                        <!-- Left: Judul + Sidebar Toggle -->
                        <div class="d-flex align-items-center gap-3">
                            <button class="btn btn-light d-md-none border" id="menu-toggle" aria-label="Toggle Sidebar">
                                <span class="material-symbols-outlined">menu</span>
                            </button>

                            <h2 class="h5 fw-bold mb-0 text-dark">Manajemen Pengguna</h2>
                        </div>

                        <!-- Right: Profil -->
                        <div class="d-flex align-items-center gap-4">
                            <div class="rounded-circle bg-secondary"
                                style="width: 40px; height: 40px; background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAz5KR-OKxSEcrvF9CPm1IZf3XxQg1GSLADz0FuaEkdljU5A99TlYjspargXLS0fiqF0MtjUGQQAdAk6H8Ufc4nxOsbJoT8S7F7SKfDWClccDLm7deLpOaL9vh2TKskWtbybPcQbVDodBCXuBQHXebYqdFlUpcNVQpz8_jfbmTfRP2PVt9N-gY2U4sjvZeE4kUzl66KacsfodT2U6_aYGQptYq-wqdEjz9CHh8kmSJSF8vBONyGS-YVHSINZ60CqEmSNDE4M2FTeYd3'); 
                                    background-size: cover;">
                            </div>
                        </div>

                    </div>
                </nav>
            </header>

            <!-- CONTENT -->
            <div class="container-fluid p-4 p-lg-5">

                <!-- Title + Button -->
                <section class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3" aria-labelledby="user-title">
                    <div>
                        <h1 id="user-title" class="fw-bold mb-1 display-6 fs-3 text-dark">Daftar Pengguna</h1>
                        <p class="text-secondary small mb-0">Kelola akses dan data pengguna sistem.</p>
                    </div>
                    <a href="tambah_pengguna.php"
                        class="btn btn-brand d-flex align-items-center gap-2 px-3 py-2 rounded-3 shadow-sm text-decoration-none">
                        <span class="material-symbols-outlined fs-6">add</span>
                        <span class="fw-semibold small">Tambah Pengguna</span>
                    </a>
                </section>

                <!-- Search -->
                <section class="row g-3 mb-4">
                    <div class="col-md-5 col-lg-3">
                        <div class="input-group search-group">
                            <span class="input-group-text bg-white border-end-0 text-secondary">
                                <span class="material-symbols-outlined fs-5">search</span>
                            </span>
                            <input type="search" class="form-control border-start-0 ps-0" placeholder="Cari nama atau email...">
                        </div>
                    </div>
                </section>


                <!-- TABLE -->
                <section class="card border-0 shadow-sm rounded-4 p-0 overflow-hidden" aria-labelledby="table-title">
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

                                <?php if (mysqli_num_rows($query) > 0): ?>
                                    <?php while ($data = mysqli_fetch_assoc($query)): ?>

                                        <?php
                                        // Badge Status
                                        if ($data['status'] == 'aktif') {
                                            $badge_class = 'bg-success-subtle text-success';
                                            $status_text = 'Aktif';
                                        } else {
                                            $badge_class = 'bg-secondary-subtle text-secondary';
                                            $status_text = 'Tidak Aktif';
                                        }

                                        // Format ID
                                        $formatted_id = "USR-" . str_pad($data['id_user'], 3, '0', STR_PAD_LEFT);
                                        ?>

                                        <tr>
                                            <td class="ps-4 text-secondary small fw-medium"><?= $formatted_id ?></td>
                                            <td class="fw-medium text-secondary"><?= htmlspecialchars($data['nama_lengkap']) ?></td>
                                            <td class="text-secondary small"><?= htmlspecialchars($data['username']) ?></td>
                                            <td class="text-secondary small"><?= htmlspecialchars($data['email'] ?? '-') ?></td>
                                            <td class="text-secondary text-capitalize"><?= htmlspecialchars($data['role']) ?></td>
                                            <td>
                                                <span class="badge <?= $badge_class ?> rounded-pill px-3 fw-medium">
                                                    <?= $status_text ?>
                                                </span>
                                            </td>
                                            <td class="text-end pe-4">
                                                <div class="d-flex justify-content-end gap-2">

                                                    <!-- Tombol Edit -->
                                                    <a href="edit_pengguna.php?id=<?= $data['id_user'] ?>"
                                                        class="btn btn-light d-flex align-items-center justify-content-center rounded-3 shadow-sm border-0 action-btn edit-btn"
                                                        title="Edit">
                                                        <span class="material-symbols-outlined fs-5 text-primary">edit</span>
                                                    </a>

                                                    <!-- Tombol Hapus -->
                                                    <a href="hapus_pengguna.php?id=<?= $data['id_user'] ?>"
                                                        class="btn btn-light d-flex align-items-center justify-content-center rounded-3 shadow-sm border-0 action-btn delete-btn"
                                                        onclick="return confirm('Yakin ingin menghapus user ini?');"
                                                        title="Hapus">
                                                        <span class="material-symbols-outlined fs-5 text-danger">delete</span>
                                                    </a>

                                                </div>
                                            </td>

                                        </tr>

                                    <?php endwhile; ?>
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
                        <a href="#" class="btn-paginasi text-secondary text-decoration-none" aria-label="Previous">
                            <span class="material-symbols-outlined fs-6">chevron_left</span>
                        </a>
                        <a href="#" class="btn-paginasi active bg-success-subtle text-success-emphasis fw-bold text-decoration-none">
                            1
                        </a>
                        <a href="#" class="btn-paginasi text-secondary text-decoration-none">
                            2
                        </a>
                        <a href="#" class="btn-paginasi text-secondary text-decoration-none">
                            3
                        </a>
                        <span class="text-muted small">...</span>
                        <a href="#" class="btn-paginasi text-secondary text-decoration-none">
                            10
                        </a>
                        <a href="#" class="btn-paginasi text-secondary text-decoration-none" aria-label="Next">
                            <span class="material-symbols-outlined fs-6">chevron_right</span>
                        </a>
                    </div>
                </nav>

            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById("menu-toggle").addEventListener("click", function(e) {
            e.preventDefault();
            document.body.classList.toggle("sidebar-toggled");
        });
    </script>

</body>

</html>