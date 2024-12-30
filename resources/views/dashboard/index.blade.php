@extends('Crovex/baseFile', ['title' => 'Dashboard Surat Paket'])

@section('content')
<div class="card">
    <div class="card-body">
        <h1>Dashboard</h1>

        <!-- Grafik Row 1 -->
        <div class="row">
            <!-- Grafik 1: Surat Hari Ini -->
            <div class="col-md-6 mb-4">
                <canvas id="chart2" width="400" height="400"></canvas>
                <div id="label2" class="mt-2 text-center"></div> <!-- Label keterangan -->
            </div>

            <!-- Grafik 2: Paket Hari Ini -->
            <div class="col-md-6 mb-4">
                <canvas id="chart3" width="400" height="400"></canvas>
                <div id="label3" class="mt-2 text-center"></div> <!-- Label keterangan -->
            </div>
        </div>

        <!-- Grafik Row 2 -->
        <div class="row">
            <!-- Grafik 3: Jumlah Surat dan Paket -->
            <div class="col-md-6 mb-4">
                <canvas id="chart1" width="400" height="400"></canvas>
                <div id="label1" class="mt-2 text-center"></div> <!-- Label keterangan -->
            </div>

            <!-- Grafik 4: Surat dan Paket Dijemput Hari Ini -->
            <div class="col-md-6 mb-4">
                <canvas id="chart4" width="400" height="400"></canvas>
                <div id="label4" class="mt-2 text-center"></div> <!-- Label keterangan -->
            </div>
        </div>

        <!-- Total di bawah grafik -->
        <div class="row">
            <div class="col-md-12 text-center mt-4">
                <h4><strong>Total</strong></h4>
                <p>Jumlah Surat: {{ $jumlahSurat }} | Jumlah Paket: {{ $jumlahPaket }} | Surat Hari Ini: {{ $suratHariIni }} | Paket Hari Ini: {{ $paketHariIni }} | Surat Dijemput: {{ $suratDijemputHariIni }} | Paket Dijemput: {{ $paketDijemputHariIni }}</p>
            </div>
        </div>
    </div>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Grafik 1: Jumlah Surat dan Paket
        var ctx1 = document.getElementById('chart1').getContext('2d');
        var chart1 = new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: ['Jumlah Surat', 'Jumlah Paket'],  // Label untuk jumlah surat dan paket
                datasets: [{
                    label: 'Jumlah Surat dan Paket',
                    data: [{{ $jumlahSurat }}, {{ $jumlahPaket }}],  // Data jumlah surat dan paket yang dikirim dari controller
                    backgroundColor: ['rgba(54, 162, 235, 0.2)', 'rgba(255, 159, 64, 0.2)'],  // Warna biru muda untuk surat dan oranye muda untuk paket
                    borderColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 159, 64, 1)'],  // Warna biru dan oranye untuk border
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Grafik Jumlah Surat dan Paket',
                        font: {
                            size: 18
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1, // Menentukan interval angka pada sumbu Y
                            callback: function(value) {
                                return value; // Menampilkan angka sesuai pada sumbu Y
                            }
                        }
                    }
                },
                responsive: true
            }
        });

        // Menampilkan jumlah surat dan paket pada bagian bawah
        document.getElementById('label1').innerText = 'Jumlah Surat: {{ $jumlahSurat }} | Jumlah Paket: {{ $jumlahPaket }}';

        // Grafik 2: Surat Hari Ini
        var ctx2 = document.getElementById('chart2').getContext('2d');
        var chart2 = new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: ['Surat Hari Ini'],  // Hanya ada satu label untuk surat hari ini
                datasets: [{
                    label: 'Surat Hari Ini',
                    data: [{{ $suratHariIni }}],  // Data surat yang diterima hari ini dari controller
                    backgroundColor: ['rgba(54, 162, 235, 0.2)'],  // Warna biru muda
                    borderColor: ['rgba(54, 162, 235, 1)'],  // Warna biru
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Grafik Surat Hari Ini',
                        font: {
                            size: 18
                        }
                    }
                },
                responsive: true
            }
        });

        // Menampilkan jumlah surat hari ini pada bagian bawah
        document.getElementById('label2').innerText = 'Surat Hari Ini: {{ $suratHariIni }}';

        // Grafik 3: Paket Hari Ini
        var ctx3 = document.getElementById('chart3').getContext('2d');
        var chart3 = new Chart(ctx3, {
            type: 'doughnut',
            data: {
                labels: ['Paket Hari Ini'],  // Hanya ada satu label untuk paket hari ini
                datasets: [{
                    label: 'Paket Hari Ini',
                    data: [{{ $paketHariIni }}],  // Data paket yang diterima hari ini dari controller
                    backgroundColor: ['rgba(255, 159, 64, 0.2)'],  // Warna oranye muda
                    borderColor: ['rgba(255, 159, 64, 1)'],  // Warna oranye
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Grafik Paket Hari Ini',
                        font: {
                            size: 18
                        }
                    }
                },
                responsive: true
            }
        });

        // Menampilkan jumlah paket hari ini pada bagian bawah
        document.getElementById('label3').innerText = 'Paket Hari Ini: {{ $paketHariIni }}';

        // Grafik 4: Surat dan Paket Dijemput Hari Ini
        var ctx4 = document.getElementById('chart4').getContext('2d');
        var chart4 = new Chart(ctx4, {
            type: 'bar',
            data: {
                labels: ['Surat Dijemput', 'Paket Dijemput'],  // Label untuk surat dan paket dijemput
                datasets: [{
                    label: 'Surat dan Paket Dijemput Hari Ini',
                    data: [{{ $suratDijemputHariIni }}, {{ $paketDijemputHariIni }}],  // Data surat dan paket dijemput hari ini
                    backgroundColor: ['rgba(54, 162, 235, 0.2)', 'rgba(255, 159, 64, 0.2)'],  // Warna biru muda dan oranye muda
                    borderColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 159, 64, 1)'],  // Warna biru dan oranye
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Grafik Surat dan Paket Dijemput Hari Ini',
                        font: {
                            size: 18
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1, // Menentukan interval angka pada sumbu Y
                            callback: function(value) {
                                return value; // Menampilkan angka sesuai pada sumbu Y
                            }
                        }
                    }
                },
                responsive: true
            }
        });

        // Menampilkan jumlah surat dan paket dijemput pada bagian bawah
        document.getElementById('label4').innerText = 'Surat Dijemput: {{ $suratDijemputHariIni }} | Paket Dijemput: {{ $paketDijemputHariIni }}';
    </script>
</div>
@endsection
