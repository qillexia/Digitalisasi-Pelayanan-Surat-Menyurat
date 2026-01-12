function konfirmasiHapus(id, nama) {
    // Set nama di dalam modal
    document.getElementById('namaPenggunaHapus').innerText = nama;
    // Set link tujuan pada tombol "Ya, Hapus"
    document.getElementById('btnConfirmHapus').href = '../config/Hapus_pengguna.php?id=' + id;

    // Tampilkan Modal
    var myModal = new bootstrap.Modal(document.getElementById('modalHapus'));
    myModal.show();
}
