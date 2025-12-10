<?php $page = 'laporan'; ?>

<!DOCTYPE html>
<html lang="id">
<?php include 'header.php'; ?>
<body>

    <div class="d-flex" id="wrapper">
        
        <aside id="sidebar-wrapper">
            <?php include 'sidebar.php'; ?>
        </aside>

        <main id="page-content-wrapper">
            
            <header>
                <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom border-custom px-4 py-3 sticky-top" aria-label="Top Navigation">
                    <div class="d-flex align-items-center justify-content-between w-100">
                        <div class="d-flex align-items-center gap-3">
                            <button class="btn btn-sm btn-light d-md-none border-custom" id="menu-toggle" aria-label="Toggle Sidebar">
                                <span class="material-symbols-outlined">menu</span>
                            </button>
                            <h1 class="h5 fw-bold mb-0 text-dark">Laporan</h1>
                        </div>
                        
                        <div class="d-flex align-items-center gap-4">
                            <button class="btn btn-light rounded-2 d-flex align-items-center justify-content-center p-2" style="width: 40px; height: 40px; background-color: var(--bg-light);" aria-label="Notifikasi">
                                <span class="material-symbols-outlined fs-5">notifications</span>
                            </button>
                            <div class="rounded-circle bg-secondary" role="img" aria-label="Foto Profil Admin" style="width: 40px; height: 40px; background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAmaOaIrgfrGa1cIF5A2A1jN8K9UEM4QialjEXgGja7e6tCzFzBqnMvSJBKeMki2v8-bZBYGls7t_gvzia5Mqw4o0efYU-No1ALJbd5nPIq9eCze70Mur1qIWLefIrkT6MP_fsoe0lRK5WaQxj0a7X_SXIRrF-l73DnUnRpvtencE8AyFDjbXo8thvkm4I4jYXIDZXs3tslNd-_iHFoXjRKpvGKnws-SAHz7gE5HKof6L-abelzj01nkjGI_Ps56xGEiIo6asY2xpqe'); background-size: cover; background-position: center;"></div>
                        </div>
                    </div>
                </nav>
            </header>

            <div class="container-fluid p-4 p-lg-5">
                
                <section class="mb-5" aria-labelledby="page-title">
                    <h2 id="page-title" class="display-6 fw-bold text-dark mb-0 fs-3">Laporan Sistem Desa</h2>
                </section>

                <section class="card-custom p-4 shadow-sm mb-5" aria-label="Filter Laporan">
                    <form>
                        <div class="row g-4 align-items-end">
                            
                            <div class="col-md-4">
                                <label for="jenisLaporan" class="form-label fw-medium text-dark">Jenis Laporan</label>
                                <select class="form-select" id="jenisLaporan">
                                    <option selected>Laporan Surat Masuk</option>
                                    <option>Laporan Surat Keluar</option>
                                    <option>Statistik Persetujuan Surat</option>
                                </select>
                            </div>

                            <div class="col-md-5">
                                <label class="form-label fw-medium text-dark">Pilih Rentang Tanggal</label>
                                <div class="input-group">
                                    <input type="date" class="form-control" aria-label="Tanggal Mulai">
                                    <span class="input-group-text bg-light text-secondary border-start-0 border-end-0">s/d</span>
                                    <input type="date" class="form-control" aria-label="Tanggal Selesai">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <button type="button" class="btn btn-brand w-100 py-2 fw-bold d-flex align-items-center justify-content-center gap-2">
                                    <span class="material-symbols-outlined fs-5">description</span>
                                    Hasilkan Laporan
                                </button>
                            </div>

                        </div>
                    </form>
                </section>

                <section aria-live="polite" aria-label="Hasil Laporan">
                    <div class="d-flex flex-col flex-column align-items-center justify-content-center text-center p-5 bg-white border border-2 border-dashed rounded-4" style="border-color: #dbe6dc; min-height: 300px;">
                        <span class="material-symbols-outlined display-1 text-secondary mb-3" style="font-size: 4rem;">description</span>
                        <h3 class="h6 fw-bold text-dark">Hasil Laporan Akan Tampil Disini</h3>
                        <p class="text-secondary mb-0 small" style="max-width: 400px;">
                            Pilih jenis laporan dan tentukan rentang tanggal di atas, lalu klik tombol 'Hasilkan Laporan' untuk melihat data.
                        </p>
                    </div>
                </section>

            </div>
        </main>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        var menuToggle = document.getElementById("menu-toggle");
        var wrapper = document.getElementById("wrapper");

        menuToggle.addEventListener("click", function(e) {
            e.preventDefault();
            wrapper.classList.toggle("sidebar-toggled");
        });
    </script>
</body>
</html>