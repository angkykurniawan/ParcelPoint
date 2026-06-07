@extends('dashboardLayout', ['title' => 'Tambah Data Kurir Surat Paket'])

@section('content')
<div class="row">
    <div class="col-12 max-w-lg mx-auto">
        <div class="card" style="border-radius: 16px; border: 1px solid #e1eeff; box-shadow: 0 10px 30px rgba(13, 110, 253, 0.03);">
            <div class="card-body p-4">
                <div class="text-center p-3 mb-4 rounded-3 text-white" style="background: linear-gradient(135deg, #0d6efd, #0a58ca);">
                    <h5 class="m-0" style="font-weight: 800; font-size: 1.15rem; letter-spacing: 0.5px;">
                        <i class="ti ti-map me-2"></i>Tambah Data Kurir
                    </h5>
                </div>

                <form action="/kurir" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4 text-start">
                        <label for="Ekspedisi" class="form-label text-primary fw-bold small">Ekspedisi <span class="text-danger">*</span></label>
                        <input type="text"
                               class="form-control @error('Ekspedisi') is-invalid @enderror"
                               id="Ekspedisi"
                               name="Ekspedisi"
                               value="{{ old('Ekspedisi') }}"
                               placeholder="Contoh: JNT, JNE, SiCepat"
                               required
                               style="border: 2px solid #cbdfff; border-radius: 12px; padding: 12px 16px;">

                        @error('Ekspedisi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
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

@if(session('success'))
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
@endsection
