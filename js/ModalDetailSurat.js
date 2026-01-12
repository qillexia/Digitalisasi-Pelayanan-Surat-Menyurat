document.addEventListener('DOMContentLoaded', function() {
    var modalDetail = document.getElementById('modalDetailSurat');

    // Hanya jalankan jika elemen modal detail ditemukan
    if (modalDetail) {
        modalDetail.addEventListener('show.bs.modal', function(event) {
            // Tombol yang memicu modal
            var button = event.relatedTarget;

            // PENGECEKAN KEAMANAN (PENTING!):
            // 1. Jika modal dibuka lewat Javascript (seperti tombol hapus), 'button' biasanya null/undefined.
            // 2. Jika tombol tidak punya atribut 'data-id', berarti bukan tombol detail.
            // Jika salah satu kondisi ini terjadi, HENTIKAN proses agar tidak error.
            if (!button || !button.hasAttribute('data-id')) {
                return; 
            }

            // --- Jika lolos pengecekan, baru ambil data ---
            var id = button.getAttribute('data-id');
            var jenis = button.getAttribute('data-jenis');
            
            // LOGIKA MAPPING NAMA SURAT LENGKAP
            var namaSuratLengkap = '-';
            var jenisKode = jenis ? jenis.toLowerCase() : '';

            switch (jenisKode) {
                case 'sktm':
                    namaSuratLengkap = 'Surat Keterangan Tidak Mampu';
                    break;
                case 'sku':
                    namaSuratLengkap = 'Surat Keterangan Usaha';
                    break;
                case 'skd':
                    namaSuratLengkap = 'Surat Keterangan Domisili';
                    break;
                case 'skbm':
                    namaSuratLengkap = 'Surat Keterangan Belum Menikah';
                    break;
                case 'spn':
                    namaSuratLengkap = 'Surat Pengantar Nikah';
                    break;
                case 'skk':
                    namaSuratLengkap = 'Surat Keterangan Kehilangan';
                    break;
                default:
                    // Fallback: Ganti underscore dengan spasi dan kapitalisasi awal kata
                    namaSuratLengkap = jenisKode.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase());
                    break;
            }

            // Format Tampilan: Kode (Baris 1) + Nama Lengkap (Baris 2)
            // Contoh: SKTM <br> <small>Surat Keterangan Tidak Mampu</small>
            var jenisText = jenis ? jenis.toUpperCase().replace(/_/g, ' ') : '-';
            
            // Update Text Content (Gunakan innerHTML agar bisa pakai tag <br> dan <small>)
            modalDetail.querySelector('#detailJenis').innerHTML = `
                <div class="d-flex flex-column">
                    <span class="fw-bold text-dark">${jenisText}</span>
                    <span class="small text-secondary fw-normal">${namaSuratLengkap}</span>
                </div>
            `;
            
            var pemohon = button.getAttribute('data-pemohon');
            var nik = button.getAttribute('data-nik');
            var ttl = button.getAttribute('data-ttl');
            var jk = button.getAttribute('data-jk');
            var agama = button.getAttribute('data-agama');
            var pekerjaan = button.getAttribute('data-pekerjaan');
            
            // TAMBAHKAN INI
            var ortu = button.getAttribute('data-ortu');
            var lingkungan = button.getAttribute('data-lingkungan');

            var alamat = button.getAttribute('data-alamat');
            var keperluan = button.getAttribute('data-keperluan');
            var tanggal = button.getAttribute('data-tanggal');
            var status = button.getAttribute('data-status-pengajuan');
            var alasan = button.getAttribute('data-alasan'); // Ambil alasan
            var fileKtp = button.getAttribute('data-file-ktp');
            var fileKk = button.getAttribute('data-file-kk');

            // Update Isi Modal
            modalDetail.querySelector('#detailId').textContent = id;
            modalDetail.querySelector('#detailNama').textContent = pemohon;
            modalDetail.querySelector('#detailNik').textContent = nik;
            modalDetail.querySelector('#detailTtl').textContent = ttl;
            modalDetail.querySelector('#detailJk').textContent = jk;
            modalDetail.querySelector('#detailAgama').textContent = agama;
            modalDetail.querySelector('#detailPekerjaan').textContent = pekerjaan;
            
            // TAMBAHKAN INI
            modalDetail.querySelector('#detailOrtu').textContent = ortu || '-';
            modalDetail.querySelector('#detailLingkungan').textContent = lingkungan || '-';

            modalDetail.querySelector('#detailAlamat').textContent = alamat;
            modalDetail.querySelector('#detailKeperluan').textContent = keperluan;
            modalDetail.querySelector('#detailTanggal').textContent = tanggal;

            // Update Alasan Ditolak
            var containerAlasan = modalDetail.querySelector('#containerAlasanDitolak');
            var textAlasan = modalDetail.querySelector('#detailAlasanDitolak');

            if (status === 'Ditolak') {
                containerAlasan.classList.remove('d-none');
                textAlasan.textContent = alasan || 'Tidak ada alasan yang dicantumkan.';
            } else {
                containerAlasan.classList.add('d-none');
            }

            // Update Gambar
            var imgKtpEl = modalDetail.querySelector('#imgKTP');
            var linkKtpEl = modalDetail.querySelector('#linkKTP');
            var imgKkEl = modalDetail.querySelector('#imgKK');
            var linkKkEl = modalDetail.querySelector('#linkKK');

            if(fileKtp) { imgKtpEl.src = fileKtp; linkKtpEl.href = fileKtp; }
            if(fileKk) { imgKkEl.src = fileKk; linkKkEl.href = fileKk; }

            // Update Badge Status
            var badgeDiv = modalDetail.querySelector('#detailStatusBadge');
            var badgeClass = 'bg-secondary';
            if (status === 'Selesai') badgeClass = 'bg-success';
            else if (status === 'Diproses') badgeClass = 'bg-warning text-dark';
            else if (status === 'Ditolak') badgeClass = 'bg-danger';

            badgeDiv.innerHTML = `<span class="badge ${badgeClass} small px-3 py-2 rounded-pill fw-medium">${status}</span>`;
        });
    }
});