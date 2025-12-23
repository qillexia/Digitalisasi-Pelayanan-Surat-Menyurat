<div class="modal fade" id="modalProsesSurat" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-body p-4">
                
                <div class="text-center mb-4">
                    <!-- Icon Dinamis -->
                    <div id="iconProses" class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                         style="width: 64px; height: 64px;">
                        <span class="material-symbols-outlined fs-1 text-white" id="iconSymbol">check</span>
                    </div>
                    
                    <h5 class="fw-bold mb-2 text-dark" id="judulProses">Judul Modal</h5>
                    <p class="text-secondary mb-0" id="pesanProses">Pesan konfirmasi akan muncul di sini.</p>
                </div>

                <form action="../config/ProsesSurat.php" method="GET">
                    <input type="hidden" name="id" id="idSuratProses">
                    <input type="hidden" name="aksi" id="aksiProses">

                    <!-- Input Alasan Penolakan (Hanya Muncul Jika Ditolak) -->
                    <div id="formAlasanTolak" class="mb-3 d-none">
                        <label for="alasanTolak" class="form-label fw-medium small">Alasan Penolakan <span class="text-danger">*</span></label>
                        <textarea class="form-control bg-light" name="alasan" id="alasanTolak" rows="3" placeholder="Contoh: Data KTP buram, Nama tidak sesuai..."></textarea>
                    </div>

                    <div class="d-flex justify-content-center gap-2 mt-4">
                        <button type="button" class="btn btn-light border px-4 fw-medium rounded-3" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn px-4 fw-medium rounded-3 shadow-sm text-white" id="btnSubmitProses">
                            Ya, Lanjutkan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
