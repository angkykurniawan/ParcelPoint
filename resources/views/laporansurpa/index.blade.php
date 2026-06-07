@extends('Crovex.baseFile', ['title' => 'Data Surat Paket'])

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card" style="border-radius: 16px; border: 1px solid #e1eeff; box-shadow: 0 10px 30px rgba(13, 110, 253, 0.03);">
            <div class="card-body p-4">

                <div class="text-center mb-5 mt-2">
                    <h3 class="text-primary mb-4" style="font-weight: 800; font-size: 1.6rem; letter-spacing: 0.5px;">
                        <i class="ti ti-package me-2"></i>Laporan Data Surat & Paket {{ $models->first()->Pemilik->Nama ?? '' }}
                    </h3>

                    <div style="max-width: 200px; margin: 0 auto;" class="px-3">
                        <button class="btn btn-outline-secondary w-100 shadow-sm" onclick="window.history.back()" style="border-radius: 12px; padding: 10px 16px; font-weight: 600; border: 2px solid #cbdfff; color: #475569; height: 45px;">
                            <i class="ti ti-arrow-left me-1"></i> Kembali
                        </button>
                    </div>
                </div>

                <div class="table-responsive" style="border-radius: 12px; border: 1px solid #edf2f7;">
                    <table class="table table-striped align-middle m-0">
                        <thead style="background-color: #f8faff;">
                            <tr class="text-center" style="border-bottom: 2px solid #e1eeff;">
                                <th width="1%" class="py-3 fw-bold text-secondary">No</th>
                                <th class="py-3 fw-bold text-secondary">Foto Surat Paket</th>
                                <th class="py-3 fw-bold text-secondary">Waktu Antar</th>
                                <th class="py-3 fw-bold text-secondary">Kurir</th>
                                <th class="py-3 fw-bold text-secondary">Resi</th>
                                <th class="py-3 fw-bold text-secondary">Penjemput</th>
                                <th class="py-3 fw-bold text-secondary">Foto Serah Terima</th>
                                <th class="py-3 fw-bold text-secondary">Waktu Jemput</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($models as $item)
                                <tr class="text-center" style="border-bottom: 1px solid #edf2f7;">
                                    <td class="py-3 fw-semibold text-dark">{{ $loop->iteration }}</td>
                                    <td class="py-3">
                                        @if ($item->Foto)
                                            <a href="{{ \Storage::url($item->Foto) }}" target="_blank" class="d-inline-block">
                                                <img src="{{ \Storage::url($item->Foto) }}" class="img-thumbnail" style="width: 100px; height: 70px; object-fit: cover; border-radius: 8px;" />
                                            </a>
                                        @else
                                            <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-20 px-2 py-1 small rounded-pill">No Image</span>
                                        @endif
                                    </td>
                                    <td class="py-3 text-muted small fw-medium">{{ $item->created_at }}</td>
                                    <td class="py-3 fw-semibold text-dark">{{ $item->Kurir->Ekspedisi ?? 'Unknown' }}</td>
                                    <td class="py-3 font-monospace fw-bold text-primary small">{{ $item->Resi }}</td>
                                    <td class="py-3 fw-medium text-dark">{{ $item->Penjemput ?? '-' }}</td>
                                    <td class="py-3">
                                        @if ($item->FotoST)
                                            <a href="{{ \Storage::url($item->FotoST) }}" target="_blank" class="d-inline-block">
                                                <img src="{{ \Storage::url($item->FotoST) }}" class="img-thumbnail" style="width: 100px; height: 70px; object-fit: cover; border-radius: 8px;" />
                                            </a>
                                        @else
                                            <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-20 px-2 py-1 small rounded-pill">No Image</span>
                                        @endif
                                    </td>
                                    <td class="py-3 text-muted small fw-medium">{{ $item->WaktuJemput ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5 text-muted fw-medium">
                                        <i class="ti ti-alert-circle fs-3 d-block mb-2"></i> Tidak ada data surat atau paket.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $models->appends(request()->query())->links('pagination::bootstrap-4') }}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
