<!DOCTYPE html>
<html lang="id">

<?php include 'header.php'; ?>

<body>

    <div class="d-flex" id="wrapper">

        <?php include 'sidebar.php'; ?>

        <main id="page-content-wrapper">

            <header class="sticky-top">
                <nav class="navbar navbar-expand-lg bg-white border-bottom px-4 py-3" aria-label="Top Navigation">
                    <div class="d-flex align-items-center justify-content-between w-100">
                        <div class="d-flex align-items-center gap-3">
                            <button class="btn btn-light d-md-none border" id="menu-toggle" aria-label="Toggle Sidebar">
                                <span class="material-symbols-outlined">menu</span>
                            </button>
                            <h2 class="h5 fw-bold mb-0 text-dark">Manajemen Surat</h2>
                        </div>

                        <div class="d-flex align-items-center gap-4">
                            <button class="btn btn-light rounded-2 p-2 position-relative">
                                <span class="material-symbols-outlined fs-5">notifications</span>
                            </button>
                            <div class="rounded-circle bg-secondary" style="width: 40px; height: 40px; background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBE3oUjw1tN-87R1nU3IFBBVRXHQ-NrvIHpOzjm0iQSoTAFHwzMqgftPFHxLW5Dp6EkOkV0788wlcmGpqIrTSOK38kTXvy_6oOi5cUD4OzrKm11RykKNoiwtFk3O6DNN5-slsXJdcApbERmrxiASZMDTGDDFL_boluOiphXWtvZsIXqPpTIn7o1h3cIW6iKJTecVPjngS6n_-dnj2gHpp8XeB9tIN5KeMzmWuSGvdcEh8FxyaeogN6N7ODZlvWoj-abzDAEzP_QJaHG'); background-size: cover;" aria-label="Profil User"></div>
                        </div>
                    </div>
                </nav>
            </header>

            <div class="container-fluid p-4 p-lg-5">

                <section class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-3 mb-4">
                    <div>
                        <h1 class="fw-bold mb-1 fs-3">Daftar Semua Surat</h1>
                        <p class="text-secondary mb-0 small">Kelola semua surat yang masuk ke sistem desa.</p>
                    </div>
                    <button class="btn btn-brand d-flex align-items-center gap-2 px-3 py-2 rounded-3 shadow-sm">
                        <span class="material-symbols-outlined fs-6">add</span>
                        <span class="fw-semibold small">Tambah Surat Baru</span>
                    </button>
                </section>

                <section class="row g-3 mb-4" aria-label="Filter Data">
                    <div class="col-md-6">
                        <div class="input-group search-group">
                            <span class="input-group-text bg-white border-end-0 text-secondary">
                                <span class="material-symbols-outlined fs-5">search</span>
                            </span>
                            <input type="search" class="form-control border-start-0 ps-0" placeholder="Cari berdasarkan No. Surat atau Pemohon..." aria-label="Cari surat">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select text-secondary" aria-label="Filter Jenis Surat">
                            <option selected>Semua Jenis Surat</option>
                            <option>Surat Keterangan Tidak Mampu</option>
                            <option>Surat Keterangan Usaha</option>
                            <option>Surat Pengantar</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select text-secondary" aria-label="Filter Status">
                            <option selected>Semua Status</option>
                            <option>Selesai</option>
                            <option>Menunggu</option>
                            <option>Ditolak</option>
                        </select>
                    </div>
                </section>

                <section class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="table-responsive">
                        <table class="table table-hover table-custom align-middle mb-0">
                            <thead class="bg-light border-bottom">
                                <tr>
                                    <th scope="col" class="py-3 px-4">No. Surat</th>
                                    <th scope="col" class="py-3">Jenis Surat</th>
                                    <th scope="col" class="py-3">Pemohon</th>
                                    <th scope="col" class="py-3">Tanggal Pengajuan</th>
                                    <th scope="col" class="py-3">Status</th>
                                    <th scope="col" class="py-3 px-4 text-end">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="px-4 fw-medium">SKTM/021/XI/2023</td>
                                    <td>Surat Keterangan Tidak Mampu</td>
                                    <td>Budi Santoso</td>
                                    <td>28 Nov 2023</td>
                                    <td><span class="badge bg-success-subtle text-success rounded-pill px-3 fw-medium">Selesai</span></td>
                                    <td class="px-4 text-end">
                                        <div class="d-flex justify-content-end gap-2">
                                            <button class="btn btn-sm btn-light text-secondary" title="Lihat"><span class="material-symbols-outlined fs-5">visibility</span></button>
                                            <button class="btn btn-sm btn-light text-secondary" title="Edit"><span class="material-symbols-outlined fs-5">edit</span></button>
                                            <button class="btn btn-sm btn-light text-secondary" title="Hapus"><span class="material-symbols-outlined fs-5">delete</span></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-4 fw-medium">SKU/045/XI/2023</td>
                                    <td>Surat Keterangan Usaha</td>
                                    <td>Siti Aminah</td>
                                    <td>27 Nov 2023</td>
                                    <td><span class="badge bg-warning-subtle text-warning-emphasis rounded-pill px-3 fw-medium">Menunggu</span></td>
                                    <td class="px-4 text-end">
                                        <div class="d-flex justify-content-end gap-2">
                                            <button class="btn btn-sm btn-light text-secondary"><span class="material-symbols-outlined fs-5">visibility</span></button>
                                            <button class="btn btn-sm btn-light text-secondary"><span class="material-symbols-outlined fs-5">edit</span></button>
                                            <button class="btn btn-sm btn-light text-secondary"><span class="material-symbols-outlined fs-5">delete</span></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-4 fw-medium">SP/112/XI/2023</td>
                                    <td>Surat Pengantar</td>
                                    <td>Ahmad Fauzi</td>
                                    <td>26 Nov 2023</td>
                                    <td><span class="badge bg-success-subtle text-success rounded-pill px-3 fw-medium">Selesai</span></td>
                                    <td class="px-4 text-end">
                                        <div class="d-flex justify-content-end gap-2">
                                            <button class="btn btn-sm btn-light text-secondary"><span class="material-symbols-outlined fs-5">visibility</span></button>
                                            <button class="btn btn-sm btn-light text-secondary"><span class="material-symbols-outlined fs-5">edit</span></button>
                                            <button class="btn btn-sm btn-light text-secondary"><span class="material-symbols-outlined fs-5">delete</span></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-4 fw-medium">SKK/015/XI/2023</td>
                                    <td>Surat Keterangan Kematian</td>
                                    <td>Joko Widodo</td>
                                    <td>25 Nov 2023</td>
                                    <td><span class="badge bg-danger-subtle text-danger rounded-pill px-3 fw-medium">Ditolak</span></td>
                                    <td class="px-4 text-end">
                                        <div class="d-flex justify-content-end gap-2">
                                            <button class="btn btn-sm btn-light text-secondary"><span class="material-symbols-outlined fs-5">visibility</span></button>
                                            <button class="btn btn-sm btn-light text-secondary"><span class="material-symbols-outlined fs-5">edit</span></button>
                                            <button class="btn btn-sm btn-light text-secondary"><span class="material-symbols-outlined fs-5">delete</span></button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>

                <nav class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4 gap-3" aria-label="Navigasi Halaman">
                    <p class="text-secondary mb-0 small">Menampilkan 1-5 dari 150 surat</p>
                    <ul class="pagination mb-0">
                        <li class="page-item disabled"><a class="page-link rounded-start-2" href="#">Sebelumnya</a></li>
                        <li class="page-item"><a class="page-link rounded-end-2 text-dark" href="#">Selanjutnya</a></li>
                    </ul>
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