```html
@extends('dashboardLayout', ['title' => 'Tambah Data Surat Paket'])

@section('content')
<div class="row">
    <div class="col-12 max-w-lg mx-auto">
        <div class="card" style="border-radius: 16px; border: 1px solid #e1eeff; box-shadow: 0 10px 30px rgba(13, 110, 253, 0.03);">
            <div class="card-body p-4">

                <div class="text-center p-3 mb-4 rounded-3 text-white" style="background: linear-gradient(135deg, #0d6efd, #0a58ca);">
                    <h5 class="m-0" style="font-weight: 800; font-size: 1.15rem; letter-spacing: 0.5px;">
                        <i class="ti ti-package me-2"></i>Tambah Data Surat & Paket
                    </h5>
                </div>

                <form action="/suratPaket" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3 text-start">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <label for="pemilik_id" class="form-label text-primary fw-bold small m-0">Nama Pemilik <span class="text-danger">*</span></label>
                            <a href="{{ url('/pemilik/create') }}" class="text-primary fw-bold small text-decoration-none" target="_blank">
                                <i class="ti ti-plus small"></i> Tambah Pemilik
                            </a>
                        </div>
                        <select class="form-control select2 @error('pemilik_id') is-invalid @enderror" id="pemilik_id" name="pemilik_id" style="width: 100%;">
                            <option value="">Cari nama pemilik...</option>
                            @foreach ($Pemilik as $pe)
                                <option value="{{ $pe->id }}" {{ old('pemilik_id') == $pe->id ? 'selected' : '' }}>
                                    {{ $pe->Nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('pemilik_id')
                            <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="mb-3 text-start">
                        <label for="Jenis" class="form-label text-primary fw-bold small">Jenis <span class="text-danger">*</span></label>
                        <select class="form-control select2 @error('Jenis') is-invalid @enderror" name="Jenis" id="Jenis" style="width: 100%;">
                            <option value="" disabled {{ old('Jenis') === null ? 'selected' : '' }}>Pilih Jenis</option>
                            <option value="Surat" {{ old('Jenis') === 'Surat' ? 'selected' : '' }}>Surat</option>
                            <option value="Paket" {{ old('Jenis') === 'Paket' ? 'selected' : '' }}>Paket</option>
                        </select>
                        @error('Jenis')
                            <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="mb-3 text-start">
                        <label for="Resi" class="form-label text-primary fw-bold small">Nomor Resi <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('Resi') is-invalid @enderror" id="Resi" name="Resi" value="{{ old('Resi') }}" placeholder="Contoh: 00012312" style="border: 2px solid #cbdfff; border-radius: 12px; padding: 12px 16px;">
                        @error('Resi')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="mb-3 text-start">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <label for="kurir_id" class="form-label text-primary fw-bold small m-0">Ekspedisi Kurir <span class="text-danger">*</span></label>
                            <a href="{{ url('/kurir/create') }}" class="text-primary fw-bold small text-decoration-none" target="_blank">
                                <i class="ti ti-plus small"></i> Tambah Kurir
                            </a>
                        </div>
                        <select class="form-control select2 @error('kurir_id') is-invalid @enderror" id="kurir_id" name="kurir_id" style="width: 100%;">
                            <option value="">Pilih Ekspedisi Kurir</option>
                            @foreach ($Kurir as $ku)
                                <option value="{{ $ku->id }}" {{ old('kurir_id') == $ku->id ? 'selected' : '' }}>
                                    {{ $ku->Ekspedisi }}
                                </option>
                            @endforeach
                        </select>
                        @error('kurir_id')
                            <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="mb-3 text-start">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <label for="ruang_id" class="form-label text-primary fw-bold small m-0">Lokasi Ruang Penyimpanan <span class="text-danger">*</span></label>
                            <a href="{{ url('/ruang/create') }}" class="text-primary fw-bold small text-decoration-none" target="_blank">
                                <i class="ti ti-plus small"></i> Tambah Ruang
                            </a>
                        </div>
                        <select class="form-control select2 @error('ruang_id') is-invalid @enderror" id="ruang_id" name="ruang_id" style="width: 100%;">
                            <option value="">Pilih Nama Ruang</option>
                            @foreach ($Ruang as $ru)
                                <option value="{{ $ru->id }}" {{ old('ruang_id') == $ru->id ? 'selected' : '' }}>
                                    {{ $ru->Nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('ruang_id')
                            <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="mb-3 text-start">
                        <label for="NoHP" class="form-label text-primary fw-bold small">No HP / Penerima <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('NoHP') is-invalid @enderror" id="NoHP" name="NoHP" value="{{ old('NoHP') }}" placeholder="+6281211110000" style="border: 2px solid #cbdfff; border-radius: 12px; padding: 12px 16px;">
                        @error('NoHP')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="mb-3 text-start">
                        <label for="Berat" class="form-label text-primary fw-bold small">Berat Paket</label>
                        <input type="text" class="form-control @error('Berat') is-invalid @enderror" id="Berat" name="Berat" value="{{ old('Berat') }}" placeholder="Contoh: 100 gr" style="border: 2px solid #cbdfff; border-radius: 12px; padding: 12px 16px;">
                        @error('Berat')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="mb-4 text-start">
                        <label for="Foto" class="form-label text-primary fw-bold small">Foto Paket / Surat <span class="text-danger">*</span></label>
                        <input type="file" class="form-control @error('Foto') is-invalid @enderror" id="Foto" name="Foto" style="border: 2px solid #cbdfff; border-radius: 12px; padding: 12px 16px;">
                        @error('Foto')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="row g-2">
                        <div class="col-6">
                            <button type="button" class="btn btn-outline-secondary w-100" onclick="window.history.back()" style="border-radius: 12px; padding: 12px; font-weight: bold; border: 2px solid #cbdfff; color: #475569;">
                                Batal
                            </button>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary w-100 shadow-sm" style="border-radius: 12px; padding: 12px; font-weight: bold; background-color: #3475FE; border: none;">
                                Simpan
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            confirmButtonColor: '#3475FE',
            confirmButtonText: 'OK'
        });
    </script>
@endif

<script>
    $(document).ready(function() {
        $('#pemilik_id').select2({
            placeholder: "Pilih Nama Pemilik",
            allowClear: true
        });
        $('#Jenis').select2({
            placeholder: "Pilih Jenis",
            minimumResultsForSearch: -1
        });
        $('#kurir_id').select2({
            placeholder: "Pilih Nama Kurir",
            allowClear: true
        });
        $('#ruang_id').select2({
            placeholder: "Pilih Nama Ruang",
            allowClear: true
        });
    });
</script>
@endsection

```
