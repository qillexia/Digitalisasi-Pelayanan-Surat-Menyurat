<?php 
session_start();

// Cek apakah sudah login? Kalau belum tendang balik
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("location: ../pages/LoginPage.php?pesan=belum_login");
    exit();
}

$page = 'dashboard';
$nama_user = $_SESSION['nama']; 
?>



<!DOCTYPE html>
<html lang="id">

<?php include 'header.php'; ?>

<body>

    <div class="d-flex" id="wrapper">
        <!-- Narik file sidebar -->
        <?php include 'sidebar.php'; ?>

        <main id="page-content-wrapper">

            <header class="sticky-top">
                <nav class="navbar navbar-expand-lg bg-white border-bottom px-4 py-3" aria-label="Top Navigation">
                    <div class="d-flex align-items-center justify-content-between w-100">

                        <div class="d-flex align-items-center gap-3">
                            <button class="btn btn-light d-md-none border" id="menu-toggle" aria-label="Toggle Sidebar">
                                <span class="material-symbols-outlined">menu</span>
                            </button>
                            <h2 class="h5 fw-bold mb-0 text-dark">Dashboard</h2>
                        </div>

                        <div class="d-flex align-items-center gap-4">
                            <form class="d-none d-sm-flex search-group" role="search">
                                <div class="input-group" style="width: 250px;">
                                    <span class="input-group-text bg-light border-end-0 text-secondary">
                                        <span class="material-symbols-outlined fs-5">search</span>
                                    </span>
                                    <input type="search" class="form-control bg-light border-start-0 ps-0" placeholder="Cari surat..." aria-label="Search">
                                </div>
                            </form>

                            <button class="btn btn-light rounded-2 p-2 position-relative" aria-label="Notifikasi">
                                <span class="material-symbols-outlined fs-5">notifications</span>
                                <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle">
                                    <span class="visually-hidden">New alerts</span>
                                </span>
                            </button>

                            <div class="rounded-circle bg-secondary" style="width: 40px; height: 40px; background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBE3oUjw1tN-87R1nU3IFBBVRXHQ-NrvIHpOzjm0iQSoTAFHwzMqgftPFHxLW5Dp6EkOkV0788wlcmGpqIrTSOK38kTXvy_6oOi5cUD4OzrKm11RykKNoiwtFk3O6DNN5-slsXJdcApbERmrxiASZMDTGDDFL_boluOiphXWtvZsIXqPpTIn7o1h3cIW6iKJTecVPjngS6n_-dnj2gHpp8XeB9tIN5KeMzmWuSGvdcEh8FxyaeogN6N7ODZlvWoj-abzDAEzP_QJaHG'); background-size: cover;" role="img" aria-label="Profil Admin"></div>
                        </div>
                    </div>
                </nav>
            </header>

            <div class="container-fluid p-4 p-lg-5">

                <section class="mb-5" aria-labelledby="welcome-title">
                    <h1 id="welcome-title" class="fw-bold mb-1 display-6 fs-3 text-dark">
                        Selamat datang, <?php echo htmlspecialchars($nama_user); ?>!
                    </h1>
                    <p class="text-secondary mb-0 small">Berikut adalah ringkasan aktivitas sistem hari ini.</p>
                </section>

                <section class="row g-4 mb-5" aria-label="Statistik">
                    <div class="col-md-4">
                        <article class="card border-0 shadow-sm rounded-4 h-100 p-4">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h3 class="h6 fw-medium text-secondary mb-2">Total Surat Masuk</h3>
                                    <span class="fw-bold fs-3 lh-1 text-dark">150</span>
                                </div>
                                <div class="p-2 rounded-3 bg-brand-subtle">
                                    <span class="material-symbols-outlined text-brand">mail</span>
                                </div>
                            </div>
                        </article>
                    </div>

                    <div class="col-md-4">
                        <article class="card border-0 shadow-sm rounded-4 h-100 p-4">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h3 class="h6 fw-medium text-secondary mb-2">Menunggu Persetujuan</h3>
                                    <span class="fw-bold fs-3 lh-1 text-dark">12</span>
                                </div>
                                <div class="p-2 rounded-3 bg-warning-subtle text-warning-emphasis">
                                    <span class="material-symbols-outlined">pending_actions</span>
                                </div>
                            </div>
                        </article>
                    </div>

                    <div class="col-md-4">
                        <article class="card border-0 shadow-sm rounded-4 h-100 p-4">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h3 class="h6 fw-medium text-secondary mb-2">Surat Selesai</h3>
                                    <span class="fw-bold fs-3 lh-1 text-dark">98</span>
                                </div>
                                <div class="p-2 rounded-3 bg-primary-subtle text-primary-emphasis">
                                    <span class="material-symbols-outlined">check_circle</span>
                                </div>
                            </div>
                        </article>
                    </div>
                </section>

                <section class="card border-0 shadow-sm rounded-4 p-4" aria-labelledby="table-title">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 id="table-title" class="h6 fw-bold mb-0 text-dark">Daftar Surat Terbaru</h2>
                        <a href="#" class="text-decoration-none text-brand fw-semibold small">Lihat Semua</a>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="border-bottom">
                                <tr>
                                    <th scope="col" class="text-secondary fw-semibold small py-3">No. Surat</th>
                                    <th scope="col" class="text-secondary fw-semibold small py-3">Jenis Surat</th>
                                    <th scope="col" class="text-secondary fw-semibold small py-3">Pemohon</th>
                                    <th scope="col" class="text-secondary fw-semibold small py-3">Tanggal Masuk</th>
                                    <th scope="col" class="text-secondary fw-semibold small py-3">Status</th>
                                    <th scope="col" class="text-end text-secondary fw-semibold small py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="small">
                                    <td class="fw-medium">SKTM/021/XI/2023</td>
                                    <td>Surat Keterangan Tidak Mampu</td>
                                    <td>Budi Santoso</td>
                                    <td>28 Nov 2023</td>
                                    <td>
                                        <span class="badge bg-success-subtle text-success rounded-pill px-3 fw-medium">Selesai</span>
                                    </td>
                                    <td class="text-end">
                                        <button class="btn btn-sm btn-link text-secondary p-0" aria-label="Opsi">
                                            <span class="material-symbols-outlined">more_horiz</span>
                                        </button>
                                    </td>
                                </tr>
                                <tr class="small">
                                    <td class="fw-medium">SKU/045/XI/2023</td>
                                    <td>Surat Keterangan Usaha</td>
                                    <td>Siti Aminah</td>
                                    <td>27 Nov 2023</td>
                                    <td>
                                        <span class="badge bg-warning-subtle text-warning-emphasis rounded-pill px-3 fw-medium">Menunggu</span>
                                    </td>
                                    <td class="text-end">
                                        <button class="btn btn-sm btn-link text-secondary p-0" aria-label="Opsi">
                                            <span class="material-symbols-outlined">more_horiz</span>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>

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