<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pelayanan Desa Windusengkahan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/LandingPage.css">
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
</head>

<body class="bg-light">

    <header id="header">
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
            <div class="container">
                <a class="navbar-brand fw-bold text-success d-flex align-items-center gap-3" href="#">
                    <span class="material-symbols-outlined fs-3 d-block fs-2">local_florist</span>
                    Desa Windusengkahan
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto my-3 my-lg-0 gap-3">
                        <li class="nav-item"><a class="nav-link" href="#header">Beranda</a></li>
                        <li class="nav-item"><a class="nav-link" href="#alur-layanan">Alur Layanan</a></li>
                        <li class="nav-item"><a class="nav-link" href="#fitur">Fitur</a></li>
                        <li class="nav-item"><a class="nav-link" href="#contact">Kontak</a></li>
                    </ul>
                    <a href="LoginPage.php" class="btn btn-success ms-lg-5 px-4">Login</a>
                </div>
            </div>
        </nav>
    </header>

    <main style="margin-top: 120px;">

        <!-- Hero Section -->
        <section class="py-5" data-aos="fade-up">
            <div class="container py-5">
                <div class="row align-items-center gy-5">
                    <div class="col-lg-6 text-center text-lg-start" data-aos="fade-right">
                        <h1 class="display-5 fw-bold text-dark mb-3">
                            Digitalisasi Pelayanan Surat Menyurat
                        </h1>
                        <p class="fs-6 text-secondary mb-4">
                            Sistem administrasi Balai Desa Windusengkahan. Cepat, transparan, dan efisien untuk seluruh warga.
                        </p>
                        <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-lg-start">
                            <a href="LoginPage.php" class="btn btn-success btn-lg px-3 gap-2 fs-6" data-aos="fade-up" data-aos-delay="200">Ajukan Surat</a>
                            <a href="#" class="btn btn-outline-success btn-lg px-3 fs-6" data-aos="fade-up" data-aos-delay="300">Pelajari Alur</a>
                        </div>
                    </div>
                    <div class="col-lg-5 offset-lg-1" data-aos="fade-left">
                        <img src="../components/Assets/image.jpeg" alt="Kantor Desa Windusengkahan" class="img-fluid rounded-5 shadow-lg" style="width: 100%; height: 350px; object-fit: cover;">
                    </div>
                </div>
            </div>
        </section>

        <!-- Alur Layanan -->
        <section id="alur-layanan" class="py-5 bg-white" data-aos="fade-up">
            <div class="container py-5">
                <div class="text-center mb-5">
                    <h2 class="fw-bold">Alur Pelayanan</h2>
                    <p class="text-secondary">4 Langkah mudah pengajuan surat.</p>
                </div>

                <div class="row g-4 text-center">
                    <div class="col-md-6 col-lg-3 step-arrow" data-aos="zoom-in" data-aos-delay="100">
                        <div class="card h-100 border-0 shadow-sm bg-light p-4 rounded-4 position-relative z-1">
                            <div class="d-flex align-items-center justify-content-center bg-success-subtle text-success rounded-circle mb-4 mx-auto"
                                style="width: 60px; height: 60px;">
                                <span class="material-symbols-outlined fs-3 d-block">person</span>
                            </div>
                            <h5 class="card-title fw-bold">1. Warga</h5>
                            <p class="card-text text-secondary small">Upload berkas dari rumah.</p>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3 step-arrow" data-aos="zoom-in" data-aos-delay="200">
                        <div class="card h-100 border-0 shadow-sm bg-light p-4 rounded-4 position-relative z-1">
                            <div class="d-flex align-items-center justify-content-center bg-success-subtle text-success rounded-circle mb-4 mx-auto"
                                style="width: 60px; height: 60px;">
                                <span class="material-symbols-outlined fs-3 d-block">support_agent</span>
                            </div>
                            <h5 class="card-title fw-bold">2. Verifikasi</h5>
                            <p class="card-text text-secondary small">Staff cek kelengkapan data.</p>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3 step-arrow" data-aos="zoom-in" data-aos-delay="300">
                        <div class="card h-100 border-0 shadow-sm bg-light p-4 rounded-4 position-relative z-1">
                            <div class="d-flex align-items-center justify-content-center bg-success-subtle text-success rounded-circle mb-4 mx-auto"
                                style="width: 60px; height: 60px;">
                                <span class="material-symbols-outlined fs-3 d-block">verified_user</span>
                            </div>
                            <h5 class="card-title fw-bold">3. Setujui</h5>
                            <p class="card-text text-secondary small">Kepala Desa menyetujui digital.</p>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="400">
                        <div class="card h-100 border-0 shadow-sm bg-light p-4 rounded-4 position-relative z-1">
                            <div class="d-flex align-items-center justify-content-center bg-success-subtle text-success rounded-circle mb-4 mx-auto"
                                style="width: 60px; height: 60px;">
                                <span class="material-symbols-outlined fs-3 d-block">task_alt</span>
                            </div>
                            <h5 class="card-title fw-bold">4. Selesai</h5>
                            <p class="card-text text-secondary small">Surat siap dicetak/diunduh.</p>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- Fitur Utama -->
        <section id="fitur" class="py-5" data-aos="fade-up">
            <div class="container py-5">
                <div class="text-center mb-5">
                    <h2 class="fw-bold">Fitur Utama</h2>
                    <p class="text-secondary">Memudahkan Warga, Staff, dan Admin.</p>
                </div>

                <div class="row g-5">
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="text-center p-4">
                            <div class="text-success mb-3">
                                <span class="material-symbols-outlined fs-2 d-block fs-1">groups</span>
                            </div>
                            <h4 class="h5 fw-bold">Akses Warga</h4>
                            <p class="text-secondary">Pengajuan surat kapan saja tanpa antri.</p>
                        </div>
                    </div>
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="text-center p-4">
                            <div class="text-success mb-3">
                                <span class="material-symbols-outlined fs-3 d-block fs-1">database</span>
                            </div>
                            <h4 class="h5 fw-bold">Database Rapi</h4>
                            <p class="text-secondary">Penyimpanan data aman dan terpusat.</p>
                        </div>
                    </div>
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                        <div class="text-center p-4">
                            <div class="text-success mb-3">
                                <span class="material-symbols-outlined fs-3 d-block fs-1">admin_panel_settings</span>
                            </div>
                            <h4 class="h5 fw-bold">Dashboard Admin</h4>
                            <p class="text-secondary">Monitoring kinerja pelayanan desa.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <!-- Footer -->
    <footer id="contact" class="text-white pt-5 pb-4 mt-5 border-top border-4 border-warning"
        style="background-color: #0f5233;" data-aos="fade-up">
        <div class="container">

            <div class="row justify-content-center text-center text-md-start ms-5" style="gap: 20rem;">

                <div class="col-md-6 col-lg-3 mb-4 mb-md-0">
                    <h5 class="text-uppercase mb-3 fw-bold text-warning">Desa Windusengkahan</h5>
                    <p class="small text-white-50 mb-1">
                        Kecamatan Kuningan, Kabupaten Kuningan<br>
                        Jawa Barat
                    </p>
                    <p class="small text-white-50">Kode Pos 45511</p>
                </div>

                <div class="col-md-6 col-lg-3 mb-4 mb-md-0">
                    <h5 class="text-uppercase mb-3 fw-bold text-warning">Hubungi Kami</h5>
                    <p class="small text-white-50 mb-1">
                        <i class="bi bi-envelope-fill me-2"></i> info@windusengkahan.go.id
                    </p>
                    <p class="small text-white-50">
                        <i class="bi bi-telephone-fill me-2"></i> (0232) 123-4567
                    </p>
                </div>


            </div>

            <hr class="mb-4 mt-4 opacity-25">

            <div class="text-center">
                <p class="small text-white-50 mb-0">
                    &copy; 2025 <strong>Balai Desa Windusengkahan</strong>. <a href="https://www.instagram.com/haqilabd/"
                        class="text-white-50 text-decoration-none">Created By @haqilabd.</a>
                </p>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
</body>

</html>