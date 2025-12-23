<?php include 'header.php';

    if (!isset($currentPage)) {
        $currentPage = basename($_SERVER['PHP_SELF']);
    }

    // Pastikan variabel role_session tersedia
    if (!isset($role_session)) {
        if (file_exists('../config/RoleSession.php')) {
            include '../config/RoleSession.php';
        } else {
            $role_session = 'user'; // Default fallback
        }
    }
    ?>

    <aside id="sidebar-wrapper" class="bg-white border-end d-flex flex-column p-3 shadow-sm">
        <div class="d-flex align-items-center gap-3 p-2 mb-4">
            <!-- Ganti Gambar dengan Icon Material Symbols agar pasti muncul -->
            <div class="rounded-circle bg-success d-flex align-items-center justify-content-center text-white shadow-sm"
                style="width: 40px; height: 40px;">
                <span class="material-symbols-outlined fs-4">account_balance</span>
            </div>
            <div class="d-flex flex-column">
                <h1 class="h6 fw-bold mb-0 text-dark">Kelurahan</h1>
                <small class="text-secondary">Windusengkahan</small>
            </div>
        </div>

        <nav class="nav flex-column flex-grow-1 gap-2">
            <a href="Dashboard.php" class="sidebar-link d-flex align-items-center gap-3 px-3 py-2 rounded-3 <?php echo ($currentPage == 'Dashboard.php') ? 'active' : ''; ?>">
                <span class="material-symbols-outlined">dashboard</span>
                Dashboard
            </a>

            <?php if ($role_session != 'user'): ?>
                <a href="ManajemenSurat.php" class="sidebar-link d-flex align-items-center gap-3 px-3 py-2 rounded-3 <?php echo ($currentPage == 'ManajemenSurat.php') ? 'active' : ''; ?>">
                    <span class="material-symbols-outlined ">mail</span>
                    Manajemen Surat
                </a>
                <a href="ManajemenPengguna.php" class="sidebar-link d-flex align-items-center gap-3 px-3 py-2 rounded-3 <?php echo ($currentPage == 'ManajemenPengguna.php') ? 'active' : ''; ?>">
                    <span class="material-symbols-outlined ">group</span>
                    Manajemen Pengguna
                </a>
            <?php endif; ?>

            <a href="PengajuanSurat.php" class="sidebar-link d-flex align-items-center gap-3 px-3 py-2 rounded-3 <?php echo ($currentPage == 'PengajuanSurat.php') ? 'active' : ''; ?>">
                <span class="material-symbols-outlined ">arrow_upward</span>
                Pengajuan Surat
            </a>

            <?php if ($role_session != 'user'): ?>
                <a href="Laporan.php" class="sidebar-link d-flex align-items-center gap-3 px-3 py-2 rounded-3 <?php echo ($currentPage == 'Laporan.php') ? 'active' : ''; ?>">
                    <span class="material-symbols-outlined ">monitoring</span>
                    Laporan
                </a>
            <?php endif; ?>

            <a href="Pengaturan.php" class="sidebar-link d-flex align-items-center gap-3 px-3 py-2 rounded-3 <?php echo ($currentPage == 'Pengaturan.php') ? 'active' : ''; ?>">
                <span class="material-symbols-outlined ">settings</span>
                Pengaturan
            </a>
        </nav>

        <div class="mt-auto pt-3 border-top">
            <a href="#" class="sidebar-link d-flex align-items-center gap-3 px-3 py-2 rounded-3 text-danger" data-bs-toggle="modal" data-bs-target="#modalLogout">
                <span class="material-symbols-outlined">logout</span>
                Logout
            </a>
        </div>
    </aside>

    <!-- Include Modal Logout DI LUAR tag ASIDE -->
    <?php include 'modals/ModalLogout.php'; ?>