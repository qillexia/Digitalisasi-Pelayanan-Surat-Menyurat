<?php
session_start();

$page = 'layanan_surat';

// Tangkap Notifikasi
$status = isset($_GET['status']) ? $_GET['status'] : '';
$pesan  = isset($_GET['pesan']) ? $_GET['pesan'] : '';

?>

<?php include '../config/Inisial.php'; ?>
<?php include '../config/RoleSession.php'; ?>

<!DOCTYPE html>
<html lang="id">

<?php include 'header.php'; ?>

<body>

    <div class="d-flex" id="wrapper">
        <!-- SIDEBAR -->
        <aside id="sidebar-wrapper">
            <?php include 'sidebar.php'; ?>
        </aside>

        <!-- PAGE CONTENT -->
        <main id="page-content-wrapper">
            <!-- HEADER / NAVBAR -->
            <header class="sticky-top">
                <nav class="navbar navbar-expand-lg bg-white border-bottom px-4 py-3">
                    <div class="d-flex align-items-center justify-content-between w-100">
                        <div class="d-flex align-items-center gap-3">
                            <button class="btn btn-light d-md-none border" id="menu-toggle">
                                <span class="material-symbols-outlined">menu</span>
                            </button>
                            <h2 class="h5 fw-bold mb-0 text-dark">Layanan Surat</h2>
                        </div>
                        <div class="d-flex align-items-center gap-4">
                            <!-- User Info Desktop & Avatar -->
                            <div class="text-end d-none d-md-block">
                                <span class="d-block fw-bold text-dark small"><?= htmlspecialchars($nama_user) ?></span>
                                <span class="d-block text-secondary x-small" style="font-size: 0.75rem;">
                                    <?= $label_role ?>
                                </span>
                            </div>
                            <!-- Avatar Inisial -->
                            <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center fw-bold shadow-sm"
                                style="width: 40px; height: 40px; font-size: 16px; user-select: none;">
                                <?= $inisial ?>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>

            <!-- MAIN CONTENT -->
            <div class="container-fluid p-4 p-lg-4" style="max-width: 1150px;">

                <!-- Notifikasi -->
                <?php if ($status == 'sukses'): ?>
                    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                        <div class="d-flex align-items-center">
                            <span class="material-symbols-outlined me-2">check_circle</span>
                            <div><strong>Berhasil!</strong> Pengajuan surat Anda telah dikirim.</div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php elseif ($status == 'gagal'): ?>
                    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                        <div class="d-flex align-items-center">
                            <span class="material-symbols-outlined me-2">error</span>
                            <div><strong>Gagal!</strong> <?= htmlspecialchars($pesan) ?></div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>
                
                <!-- Breadcrumb & Title -->
                <section class="mb-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-2">
                            <li class="breadcrumb-item"><a href="Dashboard.php" class="text-decoration-none text-muted small">Beranda</a></li>
                            <li class="breadcrumb-item active text-dark small fw-medium" aria-current="page">Pengajuan Surat</li>
                        </ol>
                    </nav>
                    <h1 class="fw-bold display-6 fs-3 text-dark mb-2">Pengajuan Surat Online</h1>
                    <p class="text-muted mb-0 small">Isi formulir di bawah dengan data yang valid untuk mempercepat proses verifikasi.</p>
                </section>
                
                <!-- Form Pengajuan Surat -->
                <form class="card-custom mb-4" action="../config/proses_pengajuan.php" method="POST" enctype="multipart/form-data">
                    <div class="card-body p-4 p-md-5">
                        <section class="mb-5">
                            <h5 class="fw-bold text-dark d-flex align-items-center gap-3 mb-4 border-bottom pb-3">
                                <span class="material-symbols-outlined text-success">article</span> Jenis Layanan
                            </h5>
                            <div class="mb-3">
                                <label for="jenisSurat" class="form-label fw-medium text-secondary">Pilih Jenis Surat <span class="text-danger">*</span></label>
                                <select class="form-select py-2" id="jenisSurat" name="jenis_surat" required>
                                    <option selected disabled value="">-- Pilih jenis surat --</option>
                                    <option value="SKD">Surat Keterangan Domisili</option>
                                    <option value="SKU">Surat Keterangan Usaha</option>
                                    <option value="SKTM">Surat Keterangan Tidak Mampu</option>
                                    <option value="SKBM">Surat Keterangan Belum Menikah</option>
                                    <option value="SPN">Surat Pengantar Nikah</option>
                                    <option value="SKK">Surat Keterangan Kehilangan</option>
                                </select>
                            </div>
                        </section>

                        <section class="mb-5">
                            <h5 class="fw-bold text-dark d-flex align-items-center gap-3 mb-4 border-bottom pb-3">
                                <span class="material-symbols-outlined text-success">person</span> Data Pemohon
                            </h5>

                            <div class="row g-4 mb-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-medium text-secondary">NIK <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="nik" placeholder="16 digit angka" maxlength="16" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-medium text-secondary">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="nama_lengkap" placeholder="Sesuai KTP" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-medium text-secondary">Tempat Lahir <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="tempat_lahir" placeholder="Contoh: Kuningan" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-medium text-secondary">Tanggal Lahir <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="tanggal_lahir" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-medium text-secondary">WhatsApp <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light text-muted fw-medium">+62</span>
                                        <input type="tel" class="form-control" name="whatsapp" placeholder="812-3456-7890" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-medium text-secondary">Pekerjaan</label>
                                    <input type="text" class="form-control" name="pekerjaan" placeholder="Contoh: Wiraswasta">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-medium text-secondary">Agama <span class="text-danger">*</span></label>
                                    <select class="form-select py-2" name="agama" required>
                                        <option selected disabled value="">-- Pilih Agama --</option>
                                        <option value="islam">Islam</option>
                                        <option value="kristen">Kristen</option>
                                        <option value="katolik">Katolik</option>
                                        <option value="hindu">Hindu</option>
                                        <option value="budha">Budha</option>
                                        <option value="konghucu">Konghucu</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-medium text-secondary">Lingkungan <span class="text-danger">*</span></label>
                                    <select class="form-select py-2" name="lingkungan" required>
                                        <option selected disabled value="">-- Pilih Lingkungan --</option>
                                        <option value="lingk_subur">LINGK. SUBUR</option>
                                        <option value="lingk_mukti">LINGK. MUKTI</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-medium text-secondary">Jenis Kelamin <span class="text-danger">*</span></label>
                                    <select class="form-select py-2" name="jenis_kelamin" required>
                                        <option selected disabled value="">-- Pilih Jenis Kelamin --</option>
                                        <option value="laki_laki">Laki-laki</option>
                                        <option value="perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-medium text-secondary">Status Perkawinan <span class="text-danger">*</span></label>
                                    <select class="form-select py-2" name="status_perkawinan" required>
                                        <option selected disabled value="">-- Pilih Status --</option>
                                        <option value="belum_kawin">Belum Kawin</option>
                                        <option value="kawin">Kawin</option>
                                        <option value="cerai_hidup">Cerai Hidup</option>
                                        <option value="cerai_mati">Cerai Mati</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-medium text-secondary">Nama Orang Tua <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="nama_orang_tua" placeholder="Nama Ayah Kandung/Ibu Kandung" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-medium text-secondary">Alamat Lengkap</label>
                                <textarea class="form-control" name="alamat" rows="2" placeholder="Nama Jalan, RT/RW..."></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-medium text-secondary">Keperluan Surat <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="keperluan" rows="3" placeholder="Jelaskan tujuan surat..." required></textarea>
                            </div>
                        </section>

                        <!-- Upload Dokumen Pendukung -->
                        <section class="mb-4">
                            <h5 class="fw-bold text-dark d-flex align-items-center gap-3 mb-2 border-bottom pb-3">
                                <span class="material-symbols-outlined text-success">upload_file</span> Dokumen Pendukung
                            </h5>
                            <p class="text-muted small mb-4">Format: JPG, PNG, atau PDF. Maks 2MB.</p>

                            <div class="row g-4">
                                <div class="col-12 col-md-6">
                                    <label class="form-label fw-medium text-secondary">Foto KTP <span class="text-danger">*</span></label>
                                    <label class="upload-box p-5 text-center d-flex flex-column align-items-center justify-content-center w-100" style="min-height: 120px; cursor: pointer;">
                                        <span class="material-symbols-outlined fs-1 text-muted mb-2" id="icon-ktp">add_photo_alternate</span>
                                        <p class="small text-muted mb-0 fw-medium" id="text-ktp">Klik atau Drag file ke sini</p>
                                        <input type="file" name="file_ktp" class="d-none" accept="image/*,.pdf" required
                                            onchange="updateFileName(this, 'text-ktp', 'icon-ktp')">
                                    </label>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label fw-medium text-secondary">Foto KK <span class="text-danger">*</span></label>
                                    <label class="upload-box p-5 text-center d-flex flex-column align-items-center justify-content-center w-100" style="min-height: 120px; cursor: pointer;">
                                        <span class="material-symbols-outlined fs-1 text-muted mb-2" id="icon-kk">add_photo_alternate</span>
                                        <p class="small text-muted mb-0 fw-medium" id="text-kk">Klik atau Drag file ke sini</p>
                                        <input type="file" name="file_kk" class="d-none" accept="image/*,.pdf" required
                                            onchange="updateFileName(this, 'text-kk', 'icon-kk')">
                                    </label>
                                </div>
                            </div>
                        </section>

                        <!-- Submit Button -->
                        <div class="d-flex justify-content-end gap-3 mt-5 pt-3 border-top">
                            <button type="submit" class="btn btn-brand px-4 py-2 fw-medium shadow-sm d-flex align-items-center gap-2">
                                <span class="material-symbols-outlined fs-5">send</span> Ajukan Permohonan
                            </button>
                        </div>

                    </div>
                </form>
                
                <!-- Info Penting -->
                <div class="alert bg-success-subtle text-success border-0 d-flex align-items-start gap-3 rounded-3" role="alert">
                    <span class="material-symbols-outlined mt-1">info</span>
                    <div class="small text-dark">
                        <p class="fw-bold mb-1">Catatan Penting:</p>
                        <p class="mb-0">Layanan surat online beroperasi pada jam kerja (Senin - Jumat, 08:00 - 15:00 WIB).</p>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script Upload File -->
    <script>
        // Script Penting agar UX Upload berjalan
        function updateFileName(input, textId, iconId) {
            if (input.files && input.files[0]) {
                var fileName = input.files[0].name;
                var textElement = document.getElementById(textId);
                textElement.innerText = fileName;
                textElement.classList.remove('text-muted');
                textElement.classList.add('text-success', 'fw-bold');

                var iconElement = document.getElementById(iconId);
                iconElement.innerText = 'check_circle';
                iconElement.classList.remove('text-muted');
                iconElement.classList.add('text-success');
            }
        }
    </script>

    <!-- Menu Toggle Script -->
    <script src="../js/MenuToggleResponsive.js"></script>

</body>

</html>