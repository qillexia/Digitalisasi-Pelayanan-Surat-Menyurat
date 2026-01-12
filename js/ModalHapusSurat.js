 // FUNGSI UNIK: hapusSurat (Bukan konfirmasiHapus)
        function hapusSurat(id, nama) {
            // Debugging: Cek apakah fungsi terpanggil
            console.log("Tombol hapus diklik untuk ID:", id);

            // 1. Ambil elemen modal yang kita hardcode di atas
            var modalEl = document.getElementById('modalHapusSuratIni');

            if (modalEl) {
                // 2. Isi data
                document.getElementById('namaSuratHapus').innerText = nama;
                document.getElementById('linkHapusSurat').href = '../config/HapusSurat.php?id=' + id;

                // 3. Tampilkan Modal
                var myModal = new bootstrap.Modal(modalEl);
                myModal.show();
            } else {
                alert("Modal tidak ditemukan! Pastikan kode HTML modal sudah dicopas.");
            }
        }