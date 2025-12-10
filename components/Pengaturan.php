
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
                            <h1 class="h5 fw-bold mb-0 text-dark">Pengaturan</h1>
                        </div>
                        <div class="rounded-circle bg-secondary" role="img" aria-label="Foto Profil Admin" style="width: 40px; height: 40px; background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDxOfUIc8MMzObd8fzLuG-GsBZhBMvY0FXpl0RjW4lNCziBxgX3dRQmcGVj5YRTMu0fNt9ezoQwn6Mt6-vyXJJ7QaufWaVt1fp5ZDFiYw225by-1V1Kd4VnrWLu1iKXD8u1LYv52CBFG4HyJJQgMKHRLxH_ggk2CAwZl9Q2D84MFkwmTaL7LcGjwvTH3YzyFZf60pXinhsPoz-zig1L7T5u3PottgUyhpqFgvMxYrKVTplJmCAWKHBncYWdN4aQjGKGqoSjBD_a18n7'); background-size: cover; background-position: center;"></div>
                    </div>
                </nav>
            </header>

            <div class="container-fluid p-4 p-lg-5">
                
                <nav aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb mb-1">
                        <li class="breadcrumb-item"><a href="Dashboard.php" class="text-decoration-none text-secondary">Dashboard</a></li>
                        <li class="breadcrumb-item active text-dark" aria-current="page">Pengaturan</li>
                    </ol>
                    <h2 class="display-6 fw-bold text-dark fs-2">Pengaturan Akun</h2>
                </nav>

                <section class="mb-4">
                    <ul class="nav nav-tabs nav-tabs-custom border-bottom" id="settingsTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active text-dark fw-bold border-0 border-bottom border-3 border-dark px-4 py-2 bg-transparent" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="true">Profil Pengguna</button>
                        </li>
                    </ul>
                </section>

                <section class="tab-content" id="settingsTabContent">
                    <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        
                        <form class="card-custom p-4 p-lg-5 shadow-sm">
                            <div class="row g-4">
                                
                                <div class="col-md-6">
                                    <label for="namaLengkap" class="form-label fw-medium text-dark">Nama Lengkap</label>
                                    <input type="text" class="form-control form-control-lg fs-6" id="namaLengkap" placeholder="Masukkan nama lengkap Anda" value="Admin Desa">
                                </div>

                                <div class="col-md-6">
                                    <label for="email" class="form-label fw-medium text-dark">Alamat Email</label>
                                    <input type="email" class="form-control form-control-lg fs-6" id="email" placeholder="Masukkan alamat email Anda" value="admin.desa@windusengkahan.go.id">
                                </div>

                                <div class="col-md-6">
                                    <label for="passwordLama" class="form-label fw-medium text-dark">Password Lama</label>
                                    <input type="password" class="form-control form-control-lg fs-6" id="passwordLama" placeholder="Masukkan password lama">
                                </div>

                                <div class="col-md-6">
                                    <label for="passwordBaru" class="form-label fw-medium text-dark">Password Baru</label>
                                    <input type="password" class="form-control form-control-lg fs-6" id="passwordBaru" placeholder="Masukkan password baru">
                                </div>

                            </div>

                            <div class="d-flex justify-content-end gap-3 mt-5 pt-4 border-top">
                                <button type="button" class="btn btn-light border px-3 fw-semibold text-secondary">Batal</button>
                                <button type="submit" class="btn btn-brand px-3 fw-semibold">Simpan Perubahan</button>
                            </div>
                        </form>

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