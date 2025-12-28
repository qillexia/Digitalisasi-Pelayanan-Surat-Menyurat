<div class="modal fade" id="modalDetailSurat" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content rounded-4 border-0 shadow-lg">

            <!-- HEADER -->
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title d-flex align-items-center gap-3">
                    <span class="material-symbols-outlined">description</span>
                    <span class="fw-bold fs-6">Detail Pengajuan Surat</span>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- BODY -->
            <div class="modal-body p-4">

                <!-- NOMOR & STATUS -->
                <div class="d-flex justify-content-between align-items-center mb-4 py-3 px-4 bg-light rounded-3 border">
                    <div>
                        <small class="text-secondary text-uppercase fw-bold" style="font-size: 0.7rem;">Nomor Pengajuan</small>
                        <h6 class="fw-bold text-dark mb-0 small" id="detailId">REQ-0000</h6>
                    </div>
                    <div id="detailStatusBadge"></div>
                </div>

                <!-- ALASAN DITOLAK (Hidden by default) -->
                <div id="containerAlasanDitolak" class="alert alert-danger d-none mb-4" role="alert">
                    <h6 class="alert-heading fw-bold mb-1 d-flex align-items-center gap-2">
                        <span class="material-symbols-outlined">error</span>
                        Alasan Ditolak
                    </h6>
                    <p class="mb-0 small" id="detailAlasanDitolak"></p>
                </div>

                <div class="row g-4">

                    <!-- DATA PEMOHON -->
                    <div class="col-lg-6 small">
                        <h6 class="fw-bold text-success mb-3 d-flex align-items-center gap-2">
                            <span class="material-symbols-outlined fs-5">person</span>
                            Data Pemohon
                        </h6>

                        <table class="table table-sm table-borderless">
                            <tr>
                                <td class="text-secondary">Nama Lengkap</td>
                                <td class="fw-medium text-dark" id="detailNama">-</td>
                            </tr>
                            <tr>
                                <td class="text-secondary">NIK</td>
                                <td class="fw-medium text-dark" id="detailNik">-</td>
                            </tr>
                            <tr>
                                <td class="text-secondary">TTL</td>
                                <td class="fw-medium text-dark" id="detailTtl">-</td>
                            </tr>
                            <tr>
                                <td class="text-secondary">Jenis Kelamin</td>
                                <td class="fw-medium text-dark text-capitalize" id="detailJk">-</td>
                            </tr>
                            <tr>
                                <td class="text-secondary">Agama</td>
                                <td class="fw-medium text-dark text-capitalize" id="detailAgama">-</td>
                            </tr>
                            <tr>
                                <td class="text-secondary">Pekerjaan</td>
                                <td class="fw-medium text-dark text-capitalize" id="detailPekerjaan">-</td>
                            </tr>
                            
                            <!-- TAMBAHKAN INI -->
                            <tr>
                                <td class="text-secondary">Nama Orang Tua</td>
                                <td class="fw-medium text-dark text-capitalize" id="detailOrtu">-</td>
                            </tr>

                            <!-- TAMBAHKAN INI -->
                            <tr>
                                <td class="text-secondary">Lingkungan</td>
                                <td class="fw-medium text-dark text-capitalize" id="detailLingkungan">-</td>
                            </tr>

                            <tr>
                                <td class="text-secondary">Alamat</td>
                                <td class="fw-medium text-dark" id="detailAlamat">-</td>
                            </tr>
                        </table>
                    </div>

                    <!-- INFORMASI SURAT -->
                    <div class="col-lg-6 small">
                        <h6 class="fw-bold text-success mb-3 d-flex align-items-center gap-2">
                            <span class="material-symbols-outlined fs-5">article</span>
                            Informasi Surat
                        </h6>

                        <div class="mb-3">
                            <label class="small text-secondary fw-bold">Jenis Surat</label>
                            <!-- Hapus class text-capitalize dan biarkan kosong, nanti diisi JS -->
                            <div id="detailJenis" class="mt-1">-</div>
                        </div>

                        <div class="mb-3">
                            <label class="small text-secondary fw-bold">Keperluan</label>
                            <p class="p-2 bg-light rounded border text-dark mb-0" id="detailKeperluan">-</p>
                        </div>

                        <div class="mb-3">
                            <label class="small text-secondary fw-bold">Tanggal Pengajuan</label>
                            <p class="fw-medium text-dark mb-0" id="detailTanggal">-</p>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <!-- DOKUMEN -->
                <h6 class="fw-bold text-success mb-3 d-flex align-items-center gap-2">
                    <span class="material-symbols-outlined fs-5">image</span>
                    Dokumen Pendukung
                </h6>

                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="card h-100 border shadow-sm">
                            <div class="card-header bg-success py-2 small fw-bold text-center text-white">
                                Kartu Tanda Penduduk
                            </div>
                            <div class="card-body p-2 text-center bg-dark rounded-bottom">
                                <img id="imgKTP" src="" class="img-fluid rounded" style="max-height:200px;object-fit:contain" alt="KTP">
                                <a id="linkKTP" href="#" target="_blank" class="btn btn-sm btn-outline-light mt-2 w-100">
                                    <span class="material-symbols-outlined fs-6">open_in_new</span> Buka Full
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card h-100 border shadow-sm">
                            <div class="card-header bg-success py-2 small fw-bold text-center text-white">
                                Kartu Keluarga
                            </div>
                            <div class="card-body p-2 text-center bg-dark rounded-bottom">
                                <img id="imgKK" src="" class="img-fluid rounded" style="max-height:200px;object-fit:contain" alt="KK">
                                <a id="linkKK" href="#" target="_blank" class="btn btn-sm btn-outline-light mt-2 w-100">
                                    <span class="material-symbols-outlined fs-6">open_in_new</span> Buka Full
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- FOOTER -->
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Tutup</button>
            </div>

        </div>
    </div>
</div>