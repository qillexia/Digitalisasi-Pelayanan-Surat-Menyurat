<?php
// 1. Wajib ada di baris paling atas
session_start();
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Desa Windusengkahan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/LoginPage.css">
</head>

<body>

    <div class="d-flex min-vh-100 align-items-center justify-content-center p-5">

        <div class="card border-0 shadow-lg overflow-hidden rounded-4 w-100" style="max-width: 1000px;">
            <div class="row g-0">

                <a href="LandingPage.php" class="btn-back-home position-absolute top-0 start-0 p-4 text-decoration-none d-flex align-items-center gap-2 text-white">
                    <span class="material-symbols-outlined fs-5">arrow_back</span>
                    <span class="small fw-bold">Beranda</span>
                </a>

                <div class="col-md-6 bg-desa-dark text-white p-5 d-flex flex-column justify-content-center">
                    <div class="mx-auto" style="max-width: 350px;">
                        <h1 class="fs-2 fw-bold lh-1 mb-0">Selamat Datang</h1>
                        <div class="decoration-line"></div>
                        <p class="fs-6 fw-normal text-light opacity-75">
                            Sistem digitalisasi pelayanan surat menyurat di Balai Desa Windusengkahan. Silakan login untuk melanjutkan.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 bg-white p-5">

                    <div class="mb-4 text-center text-md-start">
                        <h2 class="fw-bold text-dark mb-2">Login Akun Anda</h2>
                        <p class="text-secondary mb-0 small">Masukkan kredensial untuk mengakses sistem.</p>
                    </div>

                    <?php if (isset($_GET['pesan']) && $_GET['pesan'] == "gagal") : ?>
                        <div class="alert alert-danger d-flex align-items-center rounded-3 mb-4 border-0 shadow-sm" role="alert" style="background-color: #ffe5e5; color: #b02a37;">
                            <span class="material-symbols-outlined me-3">error</span>
                            <div class="small fw-medium">Username atau Password salah!</div>
                        </div>
                    <?php endif; ?>

                    <form action="../config/proses_login.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label fw-medium text-dark">Email atau Username</label>
                            <div class="position-relative">
                                <span class="material-symbols-outlined input-icon">person</span>
                                <input type="text" name="username" class="form-control form-control-custom" placeholder="Masukkan username atau email Anda" required>
                            </div>
                        </div>

                        <div class="mb-5">
                            <label class="form-label fw-medium text-dark">Password</label>
                            <div class="position-relative">
                                <span class="material-symbols-outlined input-icon">lock</span>

                                <input type="password" name="password" id="InputPassword" class="form-control form-control-custom pe-5" placeholder="Masukkan password Anda" required>

                                <button type="button" id="togglePassword" class="btn border-0 bg-transparent position-absolute top-50 end-0 translate-middle-y me-3 text-secondary" style="z-index: 10;">
                                    <span class="material-symbols-outlined m-1">visibility_off</span>
                                </button>
                            </div>
                        </div>

                        <button type="submit" name="login" class="btn btn-desa w-100 py-3 rounded-3 shadow-sm">
                            Login
                        </button>
                    </form>
                </div>

            </div>
        </div>

        <footer class="position-absolute bottom-0 w-100 text-center pb-4">
            <p class="small text-secondary mb-0">&copy; 2025 Balai Desa Windusengkahan
                <a href="https://www.instagram.com/haqilabd/" class="text-secondary text-decoration-none">
                    Created By @haqilabd
                </a>
            </p>
        </footer>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/TooglePassword.js"></script>

</body>

</html>