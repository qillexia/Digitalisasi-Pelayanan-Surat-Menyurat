<div class="modal fade" id="modalLogout" tabindex="-1" aria-labelledby="modalLogoutLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-body p-4 text-center">
                <div class="mb-3">
                    <div class="rounded-circle bg-danger-subtle text-danger d-inline-flex align-items-center justify-content-center" style="width: 64px; height: 64px;">
                        <span class="material-symbols-outlined fs-1">logout</span>
                    </div>
                </div>
                <h5 class="fw-bold mb-2 text-dark">Konfirmasi Logout</h5>
                <p class="text-secondary mb-4">Apakah Anda yakin ingin keluar dari aplikasi?</p>
                <div class="d-flex justify-content-center gap-2">
                    <button type="button" class="btn btn-light border px-4 fw-medium rounded-3" data-bs-dismiss="modal">Batal</button>
                    <!-- Pastikan href ini mengarah ke script logout atau halaman landing page Anda -->
                    <a href="../Pages/LandingPage.php" class="btn btn-danger px-4 fw-medium rounded-3 shadow-sm">Ya, Keluar</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script untuk memindahkan modal ke body agar tidak tertutup backdrop -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var modalLogout = document.getElementById('modalLogout');
        if (modalLogout) {
            document.body.appendChild(modalLogout);
        }
    });
</script>