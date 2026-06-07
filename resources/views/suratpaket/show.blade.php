@extends('Crovex.baseFile', ['title' => 'Detail Data Surat Paket'])

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card" style="border-radius: 16px; border: 1px solid #e1eeff; box-shadow: 0 10px 30px rgba(13, 110, 253, 0.03);">
            <div class="card-body p-4">

                <div class="text-center p-3 mb-4 rounded-3 text-white" style="background: linear-gradient(135deg, #0d6efd, #0a58ca);">
                    <h5 class="m-0 text-uppercase text-white" style="font-weight: 800; font-size: 1.1rem; letter-spacing: 0.5px;">
                        Data {{ $suratPaket->Jenis }}
                    </h5>
                    <span class="badge bg-white bg-opacity-20 mt-2 px-3 py-1.5 font-monospace rounded-pill text-white">
                        RESI: {{ $suratPaket->Resi }}
                    </span>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <h5 class="text-primary fw-bold mb-3 d-flex align-items-center">
                            <i class="ti ti-user me-2 text-primary"></i> Data Pemilik
                        </h5>
                        <div class="p-3 bg-light rounded-3 border h-100">
                            <div class="row g-2 small">
                                <div class="col-4 fw-bold text-secondary">Nomor Induk</div>
                                <div class="col-8 text-dark font-monospace fw-bold">: {{ $suratPaket->Pemilik->NomorInduk }}</div>

                                <div class="col-4 fw-bold text-secondary">Nama</div>
                                <div class="col-8 text-dark fw-bold">: {{ $suratPaket->Pemilik->Nama }}</div>

                                <div class="col-4 fw-bold text-secondary">Pekerjaan</div>
                                <div class="col-8 text-dark fw-medium">: {{ $suratPaket->Pemilik->Pekerjaan }}</div>

                                <div class="col-4 fw-bold text-secondary">No HP</div>
                                <div class="col-8 text-dark font-monospace">: {{ $suratPaket->Pemilik->Whatsapp }}</div>

                                <div class="col-4 fw-bold text-secondary">Email</div>
                                <div class="col-8 text-secondary text-truncate">: {{ $suratPaket->Pemilik->Email }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <h5 class="text-primary fw-bold mb-3 d-flex align-items-center">
                            <i class="ti ti-package me-2 text-primary"></i> Informasi {{ $suratPaket->Jenis }} Terbaru
                        </h5>
                        <div class="p-3 bg-light rounded-3 border h-100">
                            <div class="row g-2 small align-items-center">
                                <div class="col-4 fw-bold text-secondary">Nomor Resi</div>
                                <div class="col-8 text-primary font-monospace fw-bold">: {{ $suratPaket->Resi }}</div>

                                <div class="col-4 fw-bold text-secondary">Jenis Barang</div>
                                <div class="col-8 text-dark fw-semibold">: {{ $suratPaket->Jenis }}</div>

                                <div class="col-4 fw-bold text-secondary">No HP Log</div>
                                <div class="col-8 text-dark font-monospace">: {{ $suratPaket->NoHP }}</div>

                                <div class="col-4 fw-bold text-secondary">Berat Paket</div>
                                <div class="col-8 text-dark fw-medium">: {{ $suratPaket->Berat }} Gram</div>

                                <div class="col-4 fw-bold text-secondary">Status Log</div>
                                <div class="col-8">
                                    <span class="badge px-2.5 py-1.5 rounded-pill small fw-bold
                                        {{ $suratPaket->status_daftar === 'DiterimaSecurity' ? 'bg-primary bg-opacity-10 text-primary border border-primary border-opacity-10' : 'bg-warning bg-opacity-10 text-warning border border-warning border-opacity-10' }}">
                                        {{ ucfirst($suratPaket->status_daftar) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="border-dashed my-4">

                <div>
                    <h5 class="text-primary fw-bold mb-3 d-flex align-items-center">
                        <i class="ti ti-camera me-2 text-primary"></i> Proses Serah Terima {{ $suratPaket->Jenis }}
                    </h5>

                    <form action="/suratPaket/{{ $suratPaket->id }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3 text-start">
                                    <label for="Penjemput" class="form-label text-primary fw-bold small">Penjemput <span class="text-danger">*</span></label>
                                    <select class="form-control select2 @error('Penjemput') is-invalid @enderror" name="Penjemput" id="Penjemput" style="width: 100%;">
                                        <option value="" disabled selected>Pilih Penjemput</option>
                                        <option value="YBS" {{ old('Penjemput', $suratPaket->Penjemput ?? '') === 'YBS' ? 'selected' : '' }}>YBS (Yang Bersangkutan)</option>
                                        <option value="Teman" {{ old('Penjemput', $suratPaket->Penjemput ?? '') === 'Teman' ? 'selected' : '' }}>Teman</option>
                                        <option value="Keluarga" {{ old('Penjemput', $suratPaket->Penjemput ?? '') === 'Keluarga' ? 'selected' : '' }}>Keluarga</option>
                                    </select>
                                    @error('Penjemput')
                                        <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="mb-3 text-start">
                                    <label for="WaktuJemput" class="form-label text-primary fw-bold small">Waktu Jemput <span class="text-danger">*</span></label>
                                    <input type="datetime-local" name="WaktuJemput" id="WaktuJemput" class="form-control @error('WaktuJemput') is-invalid @enderror"
                                        value="{{ old('WaktuJemput', $suratPaket->WaktuJemput ? \Carbon\Carbon::parse($suratPaket->WaktuJemput)->format('Y-m-d\TH:i') : '') }}"
                                        style="border: 2px solid #cbdfff; border-radius: 12px; padding: 12px 16px;">
                                    @error('WaktuJemput')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-4 text-start">
                                    <label for="FotoST" class="form-label text-primary fw-bold small">Upload Bukti Foto Serah Terima</label>
                                    <input type="file" class="form-control @error('FotoST') is-invalid @enderror" id="FotoST" name="FotoST" style="border: 2px solid #cbdfff; border-radius: 12px; padding: 12px 16px;">
                                    @error('FotoST')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror

                                    <div class="mt-3 p-2 border rounded-3 bg-light d-inline-block text-center">
                                        <span class="d-block small text-muted mb-1 fw-bold">Bukti Saat Ini:</span>
                                        @if ($suratPaket->FotoST)
                                            <img src="{{ Storage::url($suratPaket->FotoST) }}" alt="Foto Serah Terima" class="img-thumbnail" style="width: 150px; height: 100px; object-fit: cover; border-radius: 8px;">
                                        @else
                                            <span class="badge bg-secondary text-white">Belum Ada Berkas</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row g-2 mt-2">
                            <div class="col-6">
                                <button type="button" class="btn btn-outline-secondary w-100" onclick="window.history.back()" style="border-radius: 12px; padding: 12px; font-weight: bold; border: 2px solid #cbdfff; color: #475569;">
                                    Kembali
                                </button>
                            </div>
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary w-100 shadow-sm" style="border-radius: 12px; padding: 12px; font-weight: bold; background-color: #3475FE; border: none;">
                                    Update Serah Terima
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

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

@if (session('error') || $errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal Menyimpan!',
            text: '{{ session("error") ?? "Silakan periksa kembali validasi isian form Anda." }}',
            confirmButtonColor: '#d33',
            confirmButtonText: 'OK'
        });
    </script>
@endif

<script>
    $(document).ready(function() {
        $('#Penjemput').select2({
            placeholder: "Pilih Penjemput",
            minimumResultsForSearch: -1
        });
    });
</script>
@endsection
