@extends('Crovex/baseFile', ['title' => 'Dashboard Surat Paket'])

@section('content')
<div class="card">
    <div class="card-body">
        <h1 style="font-weight: bolder; text-align: center;" class="text-primary">Dashboard</h1><br><br>

        <!-- Grafik Row: Semua Grafik dalam Satu Baris -->
        <div class="row text-center justify-content-center">
            <!-- Grafik 1: Jumlah Surat dan Paket -->
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4" style="padding: 10px;">
                <canvas id="chart1" width="200" height="200"></canvas>
                <div id="label1" class="mt-2"></div>
            </div>

            <!-- Grafik 2: Surat dan Paket yang Diterima Hari Ini -->
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4" style="padding: 10px;">
                <canvas id="chart2" width="200" height="200"></canvas>
                <div id="label2" class="mt-2"></div>
            </div>

            <!-- Grafik 3: Serah Terima Surat Paket Hari Ini -->
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4" style="padding: 10px;">
                <canvas id="chart3" width="200" height="200"></canvas>
                <div id="label3" class="mt-2"></div>
            </div>

            <!-- Grafik 4: Total Serah Terima Surat dan Paket -->
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4" style="padding: 10px;">
                <canvas id="chart4" width="200" height="200"></canvas>
                <div id="label4" class="mt-2"></div>
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
                labels: ['Surat', 'Paket'],
                datasets: [{
                    label: 'Jumlah Surat dan Paket',
                    data: [{{ $jumlahSurat }}, {{ $jumlahPaket }}],
                    backgroundColor: ['rgba(54, 162, 235, 0.2)', 'rgba(255, 159, 64, 0.2)'],
                    borderColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 159, 64, 1)'],
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Jumlah Surat dan Paket',
                        font: { size: 16 },
                        align: 'center' // Menempatkan judul di tengah
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            callback: function(value) {
                                return Number.isInteger(value) ? value : '';
                            }
                        }
                    }
                },
                responsive: true
            }
        });
        document.getElementById('label1').innerText = 'Jumlah Surat: {{ $jumlahSurat }} | Jumlah Paket: {{ $jumlahPaket }}';

        // Grafik 2: Surat dan Paket yang Diterima Hari Ini
        var ctx2 = document.getElementById('chart2').getContext('2d');
        var chart2 = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: ['Surat', 'Paket'],
                datasets: [{
                    label: 'Diterima Hari Ini',
                    data: [{{ $suratHariIni }}, {{ $paketHariIni }}],
                    backgroundColor: ['rgba(75, 192, 192, 0.2)', 'rgba(255, 99, 132, 0.2)'],
                    borderColor: ['rgba(75, 192, 192, 1)', 'rgba(255, 99, 132, 1)'],
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Surat dan Paket yang Diterima Hari Ini',
                        font: { size: 16 },
                        align: 'center' // Menempatkan judul di tengah
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            callback: function(value) {
                                return Number.isInteger(value) ? value : '';
                            }
                        }
                    }
                },
                responsive: true
            }
        });
        document.getElementById('label2').innerText = 'Surat: {{ $suratHariIni }} | Paket: {{ $paketHariIni }}';

        // Grafik 3: Serah Terima Surat Paket Hari Ini
        var ctx3 = document.getElementById('chart3').getContext('2d');
        var chart3 = new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: ['Surat Dijemput', 'Paket Dijemput'],
                datasets: [{
                    label: 'Serah Terima Hari Ini',
                    data: [{{ $suratDijemputHariIni }}, {{ $paketDijemputHariIni }}],
                    backgroundColor: ['rgba(153, 102, 255, 0.2)', 'rgba(255, 205, 86, 0.2)'],
                    borderColor: ['rgba(153, 102, 255, 1)', 'rgba(255, 205, 86, 1)'],
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Serah Terima Surat Paket Hari Ini',
                        font: { size: 16 },
                        align: 'center' // Menempatkan judul di tengah
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            callback: function(value) {
                                return Number.isInteger(value) ? value : '';
                            }
                        }
                    }
                },
                responsive: true
            }
        });
        document.getElementById('label3').innerText = 'Surat Dijemput: {{ $suratDijemputHariIni }} | Paket Dijemput: {{ $paketDijemputHariIni }}';

        // Grafik 4: Total Serah Terima Surat dan Paket
        var ctx4 = document.getElementById('chart4').getContext('2d');
        var chart4 = new Chart(ctx4, {
            type: 'bar',
            data: {
                labels: ['Surat', 'Paket'],
                datasets: [{
                    label: 'Total Serah Terima',
                    data: [{{ $totalSuratDijemput }}, {{ $totalPaketDijemput }}],
                    backgroundColor: ['rgba(201, 203, 207, 0.2)', 'rgba(54, 162, 235, 0.2)'],
                    borderColor: ['rgba(201, 203, 207, 1)', 'rgba(54, 162, 235, 1)'],
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Total Serah Terima Surat dan Paket',
                        font: { size: 16 },
                        align: 'center' // Menempatkan judul di tengah
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            callback: function(value) {
                                return Number.isInteger(value) ? value : '';
                            }
                        }
                    }
                },
                responsive: true
            }
        });
        document.getElementById('label4').innerText = 'Total Surat: {{ $totalSuratDijemput }} | Total Paket: {{ $totalPaketDijemput }}';
    </script>
</div>
@endsection
