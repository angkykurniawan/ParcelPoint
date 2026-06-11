<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Surat Paket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #fff;
            color: #000;
            padding: 20px;
        }
        .table th {
            background-color: #f8f9fa !important;
            color: #000 !important;
            border-bottom: 2px solid #000 !important;
        }
        .table td, .table th {
            border: 1px solid #dee2e6 !important;
            vertical-align: middle;
            font-size: 12px;
        }
        .img-report {
            width: 80px;
            height: 55px;
            object-fit: cover;
            border-radius: 4px;
        }
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                padding: 0;
            }
        }
    </style>
</head>
<body>

    <div class="text-center mb-4">
        <h4 class="fw-bold text-uppercase">Laporan Serah Terima Surat & Paket</h4>
        @if($models->first() && $models->first()->Pemilik)
            <h5>Pemilik: {{ $models->first()->Pemilik->Nama }}</h5>
        @endif

        @if($tanggal_mulai || $tanggal_akhir)
            <p class="text-muted small">
                Periode:
                {{ $tanggal_mulai ? \Carbon\Carbon::parse($tanggal_mulai)->translatedFormat('d F Y') : 'Awal' }}
                s/d
                {{ $tanggal_akhir ? \Carbon\Carbon::parse($tanggal_akhir)->translatedFormat('d F Y') : 'Akhir' }}
            </p>
        @endif
    </div>

    <table class="table table-bordered table-striped w-100">
        <thead>
            <tr class="text-center">
                <th width="3%">No</th>
                <th>Foto Paket</th>
                <th>Waktu Antar</th>
                <th>Kurir</th>
                <th>Resi</th>
                <th>Status</th>
                <th>Penjemput</th>
                <th>Foto Serah Terima</th>
                <th>Waktu Jemput</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($models as $item)
                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if ($item->Foto)
                            <img src="{{ \Storage::url($item->Foto) }}" class="img-report" />
                        @else
                            <small class="text-muted">No Image</small>
                        @endif
                    </td>
                    <td>{{ $item->created_at }}</td>
                    <td>{{ $item->Kurir->Ekspedisi ?? 'Unknown' }}</td>
                    <td class="font-monospace fw-bold small">{{ $item->Resi }}</td>
                    <td>
                        {{ strtolower($item->status_daftar) == 'sudah dijemput' ? 'Sudah Dijemput' : 'Diterima Security' }}
                    </td>
                    <td>
                        {{ strtolower($item->status_daftar) == 'sudah dijemput' ? ($item->Penjemput ?? '-') : '-' }}
                    </td>
                    <td>
                        @if (strtolower($item->status_daftar) == 'sudah dijemput' && $item->FotoST)
                            <img src="{{ \Storage::url($item->FotoST) }}" class="img-report" />
                        @else
                            <small class="text-muted">No Image</small>
                        @endif
                    </td>
                    <td>
                        {{ strtolower($item->status_daftar) == 'sudah dijemput' ? ($item->WaktuJemput ?? '-') : '-' }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center py-4">Tidak ada data surat atau paket.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <script>
        // Otomatis membuka dialog print bawaan browser
        window.addEventListener('DOMContentLoaded', (event) => {
            window.print();
        });
    </script>
</body>
</html>
