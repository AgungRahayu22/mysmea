<div class="row">
    <!-- Ucapan Selamat Datang -->
    <div class="col-12">
        <div class="card w-100 ">
            <div class="card-body">
                <h1 class="fw-bold text-primary">Selamat Datang {{ Auth::user()->nama }}!</h1>
                <p class="text-muted fs-4 mt-3">
                    Selamat datang, Admin! Kelola data pengguna, buku, dan peminjaman dengan mudah di sini.
                </p>
            </div>
        </div>
    </div>

    <!-- Statistik -->
    <div class="row mt-4">
        <!-- Total Pengguna -->
        <div class="col-lg-4 col-md-6">
            <div class="card text-center">
                <div class="card-body">
                    <div
                        class="text-white bg-primary rounded-circle p-4 d-flex align-items-center justify-content-center mx-auto"
                        style="width: 70px; height: 70px;">
                        <i class="ti ti-user fs-8"></i>
                    </div>
                    <h5 class="mt-3 fw-semibold">Total Pengguna</h5>
                    <h2 class="fw-bold">{{ $totalPengguna }}</h2>
                </div>
            </div>
        </div>

        <!-- Total Buku -->
        <div class="col-lg-4 col-md-6">
            <div class="card text-center">
                <div class="card-body">
                    <div
                        class="text-white bg-success rounded-circle p-4 d-flex align-items-center justify-content-center mx-auto"
                        style="width: 70px; height: 70px;">
                        <i class="ti ti-book fs-8"></i>
                    </div>
                    <h5 class="mt-3 fw-semibold">Total Buku</h5>
                    <h2 class="fw-bold">{{ $totalBuku  }}</h2>
                </div>
            </div>
        </div>

        <!-- Total Peminjam -->
        <div class="col-lg-4 col-md-6">
            <div class="card text-center">
                <div class="card-body">
                    <div
                        class="text-white bg-warning rounded-circle p-4 d-flex align-items-center justify-content-center mx-auto"
                        style="width: 70px; height: 70px;">
                        <i class="ti ti-credit-card fs-8"></i>
                    </div>
                    <h5 class="mt-3 fw-semibold">Total Peminjam</h5>
                    <h2 class="fw-bold">{{ $totalPeminjaman }}</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="card-title fw-semibold">
                        <i class="ti ti-chart-line text-primary me-2"></i>
                        Grafik Peminjaman Buku
                    </h5>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-outline-primary btn-sm active" data-filter="daily">Harian</button>
                        <button type="button" class="btn btn-outline-primary btn-sm" data-filter="weekly">Mingguan</button>
                    </div>
                </div>
                <div class="chart-container" style="position: relative; height:400px;">
                    <canvas id="borrowingChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('borrowingChart').getContext('2d');

    const chartData = {
        daily: {
            labels: {!! json_encode($dailyData->pluck('date')) !!},
            datasets: [
                {
                    label: 'Jumlah Peminjaman Harian',
                    data: {!! json_encode($dailyData->pluck('total')) !!},
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true
                }
            ]
        },
        weekly: {
            labels: {!! json_encode($weeklyData->pluck('week')->map(function($week) { return "Minggu " . $week; })) !!},
            datasets: [
                {
                    label: 'Total Peminjaman Mingguan',
                    data: {!! json_encode($weeklyData->pluck('total')) !!},
                    backgroundColor: 'rgba(75, 192, 192, 0.5)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true
                }
            ]
        }
    };

    let currentChart = new Chart(ctx, {
        type: 'line',
        data: chartData.daily,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                },
                tooltip: {
                    mode: 'index',
                    intersect: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Jumlah Peminjaman'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Periode'
                    }
                }
            }
        }
    });

    // Fungsi filter grafik
    const filterButtons = document.querySelectorAll('[data-filter]');
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Hapus kelas active dari semua tombol
            filterButtons.forEach(btn => btn.classList.remove('active'));

            // Tambahkan kelas active ke tombol yang diklik
            this.classList.add('active');

            // Update grafik
            const filter = this.getAttribute('data-filter');
            currentChart.data = chartData[filter];
            currentChart.update();
        });
    });
});
</script>

<style>
.chart-container {
    width: 100%;
    max-height: 400px;
}
</style>

