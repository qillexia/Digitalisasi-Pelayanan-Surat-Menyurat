function tampilkanModalProses(idSurat, aksi) {
    // Ambil elemen modal
    var modalEl = document.getElementById('modalProsesSurat');
    var modal = new bootstrap.Modal(modalEl);

    // Ambil elemen-elemen di dalam modal
    var idInput = document.getElementById('idSuratProses');
    var aksiInput = document.getElementById('aksiProses');
    var judul = document.getElementById('judulProses');
    var pesan = document.getElementById('pesanProses');
    var iconBox = document.getElementById('iconProses');
    var iconSymbol = document.getElementById('iconSymbol');
    var btnSubmit = document.getElementById('btnSubmitProses');
    var formAlasan = document.getElementById('formAlasanTolak');
    var inputAlasan = document.getElementById('alasanTolak');

    // Set nilai input hidden
    idInput.value = idSurat;
    aksiInput.value = aksi;

    // Reset tampilan awal
    formAlasan.classList.add('d-none');
    inputAlasan.required = false;
    inputAlasan.value = '';

    // Logika Tampilan Berdasarkan Aksi
    if (aksi === 'verifikasi') {
        judul.innerText = "Verifikasi Surat?";
        pesan.innerText = "Pastikan data surat sudah valid sebelum diverifikasi.";
        
        iconBox.className = "rounded-circle bg-success d-inline-flex align-items-center justify-content-center mb-3";
        iconSymbol.innerText = "check_circle";
        
        btnSubmit.className = "btn btn-success px-4 fw-medium rounded-3 shadow-sm";
        btnSubmit.innerText = "Ya, Verifikasi";

    } else if (aksi === 'acc') {
        judul.innerText = "Setujui Surat?";
        pesan.innerText = "Surat akan ditandatangani secara digital dan status menjadi Selesai.";
        
        iconBox.className = "rounded-circle bg-primary d-inline-flex align-items-center justify-content-center mb-3";
        iconSymbol.innerText = "draw";
        
        btnSubmit.className = "btn btn-primary px-4 fw-medium rounded-3 shadow-sm";
        btnSubmit.innerText = "Ya, Tanda Tangan";

    } else if (aksi === 'tolak') {
        judul.innerText = "Tolak Pengajuan?";
        pesan.innerText = "Silakan isi alasan penolakan agar pemohon dapat memperbaikinya.";
        
        iconBox.className = "rounded-circle bg-danger d-inline-flex align-items-center justify-content-center mb-3";
        iconSymbol.innerText = "block";
        
        btnSubmit.className = "btn btn-danger px-4 fw-medium rounded-3 shadow-sm";
        btnSubmit.innerText = "Tolak Surat";

        // Tampilkan Form Alasan
        formAlasan.classList.remove('d-none');
        inputAlasan.required = true;

    } else if (aksi === 'kirim_email') {
        // --- TAMBAHAN LOGIKA EMAIL ---
        judul.innerText = "Kirim Notifikasi Email?";
        pesan.innerText = "Sistem akan mengirimkan email pemberitahuan ke pemohon bahwa surat telah selesai.";
        
        iconBox.className = "rounded-circle bg-primary d-inline-flex align-items-center justify-content-center mb-3";
        iconSymbol.innerText = "mail"; // Icon amplop
        
        btnSubmit.className = "btn btn-primary text-white px-4 fw-medium rounded-3 shadow-sm";
        btnSubmit.innerText = "Kirim Email";
    }

    // Tampilkan Modal
    modal.show();
}

// Validasi form sebelum submit (khusus untuk tolak)
document.getElementById('formProsesSurat').addEventListener('submit', function(e) {
    const aksi = document.getElementById('aksiSuratProses').value;
    const alasan = document.getElementById('alasanPenolakan').value;

    if (aksi === 'tolak' && !alasan.trim()) {
        e.preventDefault();
        alert('Alasan penolakan wajib diisi!');
    }
});
