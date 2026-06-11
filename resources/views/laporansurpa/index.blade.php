@extends('Crovex.baseFile', ['title' => 'Data Surat Paket'])

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card" style="border-radius: 16px; border: 1px solid #e1eeff; box-shadow: 0 10px 30px rgba(13, 110, 253, 0.03);">
            <div class="card-body p-4">

                <div class="text-center p-4 mb-4 rounded-3 text-white" style="background: linear-gradient(135deg, #0d6efd, #0a58ca);">
                    <h3 class="text-white mb-3" style="font-weight: 800; font-size: 1.6rem; letter-spacing: 0.5px; color: #ffffff !important;">
                        <i class="ti ti-package me-2 text-white"></i>Laporan Data Surat & Paket {{ $models->first()->Pemilik->Nama ?? '' }}
                    </h3>

                    <div style="max-width: 200px; margin: 0 auto;" class="px-3">
                        <button class="btn btn-light w-100 shadow-sm text-nowrap d-flex align-items-center justify-content-center text-primary" onclick="window.history.back()" style="border-radius: 12px; border: none; padding: 10px 16px; font-weight: 700; height: 45px;">
                            <i class="ti ti-arrow-left me-1" style="font-size: 15px; stroke-width: 2.5;"></i> Kembali
                        </button>
                    </div>
                </div>

                <div class="p-3 mb-4 rounded-3 d-flex justify-content-center" style="background-color: #f8faff; border: 1px solid #e1eeff;">
                    <div class="w-100" style="max-width: 700px;">
                        <form action="/laporansurpa" method="GET" class="row g-3 align-items-end justify-content-center">
                            <input type="hidden" name="tanggal_mulai" value="{{ request('tanggal_mulai') }}">
                            <input type="hidden" name="tanggal_akhir" value="{{ request('tanggal_akhir') }}">
                            <input type="hidden" name="pemilik_id" value="{{ request('pemilik_id') }}">

                            <div class="col-md-6 col-12 text-center text-md-start">
                                <label for="status_daftar" class="form-label text-primary fw-bold small mb-1">Filter Status</label>
                                <select name="status_daftar" class="form-control" style="border: 2px solid #cbdfff; border-radius: 10px; padding: 8px 12px; height: 42px;">
                                    <option value="">-- Semua Status --</option>
                                    <option value="diterimasecurity" @selected(request('status_daftar') == 'diterimasecurity')>Diterima Security</option>
                                    <option value="sudah dijemput" @selected(request('status_daftar') == 'sudah dijemput')>Sudah Dijemput</option>
                                </select>
                            </div>
                            <div class="col-md-3 col-6">
                                <button type="submit" class="btn btn-primary w-100 fw-bold d-flex align-items-center justify-content-center" style="border-radius: 10px; height: 42px; background-color: #3475FE; border: none;">
                                    <i class="ti ti-filter me-1"></i> Filter
                                </button>
                            </div>
                            <div class="col-md-3 col-6">
                                <a href="/laporansurpa/cetak?{{ http_build_query(request()->all()) }}" target="_blank" class="btn btn-success w-100 fw-bold d-flex align-items-center justify-content-center" style="border-radius: 10px; height: 42px; border: none; background-color: #198754;">
                                    <i class="ti ti-printer me-1"></i> Cetak
                                </a>
                            </div>
                        </form>
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
                                <th class="py-3 fw-bold text-secondary">Status</th>
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

                                    <td class="py-3">
                                        @if (strtolower($item->status_daftar) == 'sudah dijemput')
                                            <span class="badge bg-success px-3 py-2 fw-bold rounded-pill" style="color: #ffffff !important;">
                                                Sudah Dijemput
                                            </span>
                                        @else
                                            <span class="badge bg-warning px-3 py-2 fw-bold rounded-pill" style="color: #000000 !important;">
                                                Diterima Security
                                            </span>
                                        @endif
                                    </td>

                                    <td class="py-3 fw-medium text-dark">
                                        {{ strtolower($item->status_daftar) == 'sudah dijemput' ? ($item->Penjemput ?? '-') : '-' }}
                                    </td>

                                    <td class="py-3">
                                        @if (strtolower($item->status_daftar) == 'sudah dijemput' && $item->FotoST)
                                            <a href="{{ \Storage::url($item->FotoST) }}" target="_blank" class="d-inline-block">
                                                <img src="{{ \Storage::url($item->FotoST) }}" class="img-thumbnail" style="width: 100px; height: 70px; object-fit: cover; border-radius: 8px;" />
                                            </a>
                                        @else
                                            <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-20 px-2 py-1 small rounded-pill">No Image</span>
                                        @endif
                                    </td>

                                    <td class="py-3 text-muted small fw-medium">
                                        {{ strtolower($item->status_daftar) == 'sudah dijemput' ? ($item->WaktuJemput ?? '-') : '-' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center py-5 text-muted fw-medium">
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
