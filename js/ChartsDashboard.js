document.addEventListener("DOMContentLoaded", function() {
    
    // Pastikan data dari PHP sudah ada di window object
    if (typeof dataBulanPHP === 'undefined' || typeof dataStatusPHP === 'undefined') {
        console.error("Data grafik dari PHP tidak ditemukan!");
        return;
    }

    // 1. KONFIGURASI GRAFIK TREN (GARIS)
    const ctxTren = document.getElementById('chartTrenSurat');
    if (ctxTren) {
        let gradient = ctxTren.getContext('2d').createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(13, 110, 253, 0.2)');
        gradient.addColorStop(1, 'rgba(13, 110, 253, 0)');

        new Chart(ctxTren, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Jumlah Surat',
                    data: dataBulanPHP, // Menggunakan data dari variabel global
                    borderColor: '#218d2dff', 
                    backgroundColor: gradient,
                    borderWidth: 1,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#2cac43ff',
                    pointRadius: 5,
                    pointHoverRadius: 6,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { borderDash: [5, 5] },
                        ticks: { stepSize: 1 }
                    },
                    x: { grid: { display: false } }
                }
            }
        });
    }

    // 2. KONFIGURASI GRAFIK STATUS (DONAT)
    const ctxStatus = document.getElementById('chartStatusSurat');
    if (ctxStatus) {
        new Chart(ctxStatus, {
            type: 'doughnut',
            data: {
                labels: ['Selesai', 'Proses', 'Ditolak'],
                datasets: [{
                    data: dataStatusPHP, // Menggunakan data dari variabel global
                    backgroundColor: ['#198754', '#ffc107', '#dc3545'],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { usePointStyle: true, padding: 20 }
                    }
                },
                cutout: '60%'
            }
        });
    }
});