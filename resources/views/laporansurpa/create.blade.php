@extends('Crovex.baseFile', ['title' => 'Laporan Serah Terima Surat Paket'])

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card" style="border-radius: 16px; border: 1px solid #e1eeff; box-shadow: 0 10px 30px rgba(13, 110, 253, 0.03);">
            <div class="card-body p-4">

                <div class="d-flex justify-content-center align-items-center p-3 mb-4 rounded-3 text-white" style="background: linear-gradient(135deg, #0d6efd, #0a58ca);">
                    <h5 class="m-0 text-center text-white" style="font-weight: 800; font-size: 1.15rem; letter-spacing: 0.5px;">
                        <i class="ti ti-package me-2 text-white"></i>Laporan Serah Terima Surat & Paket
                    </h5>
                </div>

                <form action="/laporansurpa" method="GET" target="_blank">

                    <div class="mb-3 text-start">
                        <label for="tanggal_mulai" class="form-label text-primary fw-bold small">Tanggal Awal</label>
                        <input type="date" name="tanggal_mulai" class="form-control" value="{{ old('tanggal_mulai') }}" style="border: 2px solid #cbdfff; border-radius: 12px; padding: 12px 16px;">
                    </div>

                    <div class="mb-3 text-start">
                        <label for="tanggal_akhir" class="form-label text-primary fw-bold small">Tanggal Akhir</label>
                        <input type="date" name="tanggal_akhir" class="form-control" value="{{ old('tanggal_akhir') }}" style="border: 2px solid #cbdfff; border-radius: 12px; padding: 12px 16px;">
                    </div>

                    <div class="mb-4 text-start">
                        <label for="pemilik_id" class="form-label text-primary fw-bold small">Pilih Pemilik</label>
                        <select name="pemilik_id" class="form-control select2" style="border: 2px solid #cbdfff; border-radius: 12px; padding: 12px 16px;">
                            <option value="">-- Semua Data --</option>
                            @foreach ($listPemilik as $key => $val)
                                <option value="{{ $key }}" @selected(old('pemilik_id') == $key)>{{ $val }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row g-2">
                        <div class="col-6">
                            <button type="button" class="btn btn-outline-secondary w-100" onclick="window.history.back()" style="border-radius: 12px; padding: 12px; font-weight: bold; border: 2px solid #cbdfff; color: #475569;">
                                Kembali
                            </button>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary w-100 shadow-sm" style="border-radius: 12px; padding: 12px; font-weight: bold; background-color: #3475FE; border: none;">
                                <i class="ti ti-printer me-1"></i> Tampilkan
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
