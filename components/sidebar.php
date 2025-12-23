    <?php include 'header.php';

    if (!isset($currentPage)) {
        $currentPage = basename($_SERVER['PHP_SELF']);
    }
    ?>

    <aside id="sidebar-wrapper" class="bg-white border-end d-flex flex-column p-3 shadow-sm">
        <div class="d-flex align-items-center gap-3 p-2 mb-4">
            <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center text-white fw-bold shadow-sm"
                style="width: 40px; height: 40px; background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuClKZFvLe1umLIfCevuACEReiZlktS-SUtwr9KiyfWTSipcF5gCiuz4PRJpHDGEW6PyqTYqglENpFrL4g0WYPjSpWlRgqiD1ddtZpkXnAQtruPkXWjQCriAL0nzIWbpfFCj61OV6h46DK0C01QFy9-uz7nttHIV9IDuw337hX6AgmnYHOoKKL_privaNBFvMm_vWKdbZzrGVMsN6uBYeg7rj9D7zHcFWAF5oYBErO-7tmt-co5B88T76x7qW3Q1bCdU_A62vsAM7JVz'); background-size: cover;">
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
            <a href="ManajemenSurat.php" class="sidebar-link d-flex align-items-center gap-3 px-3 py-2 rounded-3 <?php echo ($currentPage == 'ManajemenSurat.php') ? 'active' : ''; ?>">
                <span class="material-symbols-outlined ">mail</span>
                Manajemen Surat
            </a>
            <a href="ManajemenPengguna.php" class="sidebar-link d-flex align-items-center gap-3 px-3 py-2 rounded-3 <?php echo ($currentPage == 'ManajemenPengguna.php') ? 'active' : ''; ?>">
                <span class="material-symbols-outlined ">group</span>
                Manajemen Pengguna
            </a>
            <a href="PengajuanSurat.php" class="sidebar-link d-flex align-item   s-center gap-3 px-3 py-2 rounded-3 <?php echo ($currentPage == 'PengajuanSurat.php') ? 'active' : ''; ?>">
                <span class="material-symbols-outlined ">arrow_upward</span>
                Pengajuan Surat
            </a>
            <a href="Laporan.php" class="sidebar-link d-flex align-items-center gap-3 px-3 py-2 rounded-3 <?php echo ($currentPage == 'Laporan.php') ? 'active' : ''; ?>">
                <span class="material-symbols-outlined ">monitoring</span>
                Laporan
            </a>
            <a href="Pengaturan.php" class="sidebar-link d-flex align-items-center gap-3 px-3 py-2 rounded-3 <?php echo ($currentPage == 'Pengaturan.php') ? 'active' : ''; ?>">
                <span class="material-symbols-outlined ">settings</span>
                Pengaturan
            </a>
        </nav>

        <div class="mt-auto pt-3 border-top">
            <a href="../Pages/LandingPage.php" class="sidebar-link d-flex align-items-center gap-3 px-3 py-2 rounded-3 text-danger">
                <span class="material-symbols-outlined">logout</span>
                Logout
            </a>
        </div>
    </aside>