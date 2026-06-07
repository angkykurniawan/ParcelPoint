@extends('Crovex.baseFile', ['title' => 'Edit Data Ruang Surat Paket'])

@section('content')
<div class="row">
    <div class="col-12 max-w-lg mx-auto">
        <div class="card" style="border-radius: 16px; border: 1px solid #e1eeff; box-shadow: 0 10px 30px rgba(13, 110, 253, 0.03);">
            <div class="card-body p-4">

                <div class="text-center p-3 mb-4 rounded-3 text-white" style="background: linear-gradient(135deg, #0d6efd, #0a58ca);">
                    <h5 class="m-0" style="font-weight: 800; font-size: 1.15rem; letter-spacing: 0.5px;">
                        <i class="ti ti-folder me-2"></i>Edit Ruang: {{ strtoupper($ruang->Nama) }}
                    </h5>
                </div>

                <form action="/ruang/{{ $ruang->id }}" method="POST" enctype="multipart/form-data">
                    @method('put')
                    @csrf

                    <div class="mb-3 text-start">
                        <label for="Nama" class="form-label text-primary fw-bold small">Nama Ruang <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('Nama') is-invalid @enderror" id="Nama" name="Nama" value="{{ old('Nama') ?? $ruang->Nama }}" required style="border: 2px solid #cbdfff; border-radius: 12px; padding: 12px 16px;">
                        @error('Nama')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="mb-3 text-start">
                        <label for="Lantai" class="form-label text-primary fw-bold small">Lantai</label>
                        <input type="text" class="form-control @error('Lantai') is-invalid @enderror" id="Lantai" name="Lantai" value="{{ old('Lantai') ?? $ruang->Lantai }}" style="border: 2px solid #cbdfff; border-radius: 12px; padding: 12px 16px;">
                        @error('Lantai')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="mb-3 text-start">
                        <label for="Lokasi" class="form-label text-primary fw-bold small">Lokasi Gedung</label>
                        <input type="text" class="form-control @error('Lokasi') is-invalid @enderror" id="Lokasi" name="Lokasi" value="{{ old('Lokasi') ?? $ruang->Lokasi }}" style="border: 2px solid #cbdfff; border-radius: 12px; padding: 12px 16px;">
                        @error('Lokasi')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="mb-4 text-start">
                        <label for="PIC" class="form-label text-primary fw-bold small">Penanggung Jawab (PIC)</label>
                        <input type="text" class="form-control @error('PIC') is-invalid @enderror" id="PIC" name="PIC" value="{{ old('PIC') ?? $ruang->PIC }}" style="border: 2px solid #cbdfff; border-radius: 12px; padding: 12px 16px;">
                        @error('PIC')
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
                                Update
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
            text: '{{ session("success") }}',
            confirmButtonColor: '#3475FE',
            confirmButtonText: 'OK'
        });
    </script>
@elseif (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '{{ session("error") }}',
            confirmButtonColor: '#3475FE',
            confirmButtonText: 'OK'
        });
    </script>
@endif
@endsection
