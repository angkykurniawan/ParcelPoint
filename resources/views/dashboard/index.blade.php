@extends('Crovex.baseFile', ['title' => 'Dashboard Surat Paket'])

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card" style="border-radius: 16px; border: 1px solid #e1eeff; box-shadow: 0 10px 30px rgba(13, 110, 253, 0.03);">
            <div class="card-body p-4">
                <h3 style="font-weight: 800; margin: 0;" class="text-primary text-center">
                    <i class="ti-bar-chart me-2"></i>Dashboard Analitik
                </h3>

                <div class="row g-4 justify-content-center">
                    <div class="col-xl-3 col-md-6">
                        <div class="p-3 text-center" style="background-color: #f8faff; border: 1px solid #edf2f7; border-radius: 16px;">
                            <div style="max-width: 220px; margin: 0 auto;">
                                <canvas id="chart1" width="200" height="200"></canvas>
                            </div>
                            <div id="label1" class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill mt-3 fw-bold w-100 text-wrap"></div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="p-3 text-center" style="background-color: #f8faff; border: 1px solid #edf2f7; border-radius: 16px;">
                            <div style="max-width: 220px; margin: 0 auto;">
                                <canvas id="chart2" width="200" height="200"></canvas>
                            </div>
                            <div id="label2" class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill mt-3 fw-bold w-100 text-wrap"></div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="p-3 text-center" style="background-color: #f8faff; border: 1px solid #edf2f7; border-radius: 16px;">
                            <div style="max-width: 220px; margin: 0 auto;">
                                <canvas id="chart3" width="200" height="200"></canvas>
                            </div>
                            <div id="label3" class="badge bg-purple bg-opacity-10 style-badge-purple px-3 py-2 rounded-pill mt-3 fw-bold w-100 text-wrap" style="color: #6f42c1; background-color: rgba(111, 66, 193, 0.1);"></div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="p-3 text-center" style="background-color: #f8faff; border: 1px solid #edf2f7; border-radius: 16px;">
                            <div style="max-width: 220px; margin: 0 auto;">
                                <canvas id="chart4" width="200" height="200"></canvas>
                            </div>
                            <div id="label4" class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2 rounded-pill mt-3 fw-bold w-100 text-wrap"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const commonOptions = {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
            legend: {
                display: false
            },
            title: {
                display: true,
                font: { size: 14, weight: '700', family: 'system-ui' },
                color: '#2d3748',
                padding: { bottom: 15 }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    color: '#f1f5f9'
                },
                ticks: {
                    stepSize: 1,
                    color: '#94a3b8',
                    callback: function(value) {
                        return Number.isInteger(value) ? value : '';
                    }
                }
            },
            x: {
                grid: {
                    display: false
                },
                ticks: {
                    color: '#64748b',
                    font: { weight: '600' }
                }
            }
        }
    };

    var ctx1 = document.getElementById('chart1').getContext('2d');
    var chart1 = new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: ['Surat', 'Paket'],
            datasets: [{
                data: [{{ $jumlahSurat }}, {{ $jumlahPaket }}],
                backgroundColor: ['rgba(52, 117, 254, 0.2)', 'rgba(255, 159, 64, 0.2)'],
                borderColor: ['rgba(52, 117, 254, 1)', 'rgba(255, 159, 64, 1)'],
                borderWidth: 2,
                borderRadius: 6
            }]
        },
        options: {
            ...commonOptions,
            plugins: {
                ...commonOptions.plugins,
                title: { ...commonOptions.plugins.title, text: 'Stok Gudang Aktif' }
            }
        }
    });
    document.getElementById('label1').innerText = 'Surat: {{ $jumlahSurat }} | Paket: {{ $jumlahPaket }}';

    var ctx2 = document.getElementById('chart2').getContext('2d');
    var chart2 = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: ['Surat', 'Paket'],
            datasets: [{
                data: [{{ $suratHariIni }}, {{ $paketHariIni }}],
                backgroundColor: ['rgba(46, 204, 113, 0.2)', 'rgba(231, 76, 60, 0.2)'],
                borderColor: ['rgba(46, 204, 113, 1)', 'rgba(231, 76, 60, 1)'],
                borderWidth: 2,
                borderRadius: 6
            }]
        },
        options: {
            ...commonOptions,
            plugins: {
                ...commonOptions.plugins,
                title: { ...commonOptions.plugins.title, text: 'Masuk Hari Ini' }
            }
        }
    });
    document.getElementById('label2').innerText = 'Surat: {{ $suratHariIni }} | Paket: {{ $paketHariIni }}';

    var ctx3 = document.getElementById('chart3').getContext('2d');
    var chart3 = new Chart(ctx3, {
        type: 'bar',
        data: {
            labels: ['Surat', 'Paket'],
            datasets: [{
                data: [{{ $suratDijemputHariIni }}, {{ $paketDijemputHariIni }}],
                backgroundColor: ['rgba(111, 66, 193, 0.2)', 'rgba(241, 196, 15, 0.2)'],
                borderColor: ['rgba(111, 66, 193, 1)', 'rgba(241, 196, 15, 1)'],
                borderWidth: 2,
                borderRadius: 6
            }]
        },
        options: {
            ...commonOptions,
            plugins: {
                ...commonOptions.plugins,
                title: { ...commonOptions.plugins.title, text: 'Selesai Hari Ini' }
            }
        }
    });
    document.getElementById('label3').innerText = 'Surat: {{ $suratDijemputHariIni }} | Paket: {{ $paketDijemputHariIni }}';

    var ctx4 = document.getElementById('chart4').getContext('2d');
    var chart4 = new Chart(ctx4, {
        type: 'bar',
        data: {
            labels: ['Surat', 'Paket'],
            datasets: [{
                data: [{{ $totalSuratDijemput }}, {{ $totalPaketDijemput }}],
                backgroundColor: ['rgba(148, 163, 184, 0.2)', 'rgba(52, 117, 254, 0.2)'],
                borderColor: ['rgba(148, 163, 184, 1)', 'rgba(52, 117, 254, 1)'],
                borderWidth: 2,
                borderRadius: 6
            }]
        },
        options: {
            ...commonOptions,
            plugins: {
                ...commonOptions.plugins,
                title: { ...commonOptions.plugins.title, text: 'Total Keseluruhan Selesai' }
            }
        }
    });
    document.getElementById('label4').innerText = 'Surat: {{ $totalSuratDijemput }} | Paket: {{ $totalPaketDijemput }}';
</script>
@endsection
