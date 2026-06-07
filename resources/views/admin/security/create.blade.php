@extends('Crovex.baseFile', ['title' => 'Tambah Akun Security'])

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card" style="border-radius: 16px; border: 1px solid #e1eeff; box-shadow: 0 10px 30px rgba(13, 110, 253, 0.03);">
            <div class="card-body p-4">

                <div class="d-flex justify-content-center align-items-center p-3 mb-4 rounded-3 text-white" style="background: linear-gradient(135deg, #0d6efd, #0a58ca);">
                    <h5 class="m-0 text-center text-white" style="font-weight: 800; font-size: 1.15rem; letter-spacing: 0.5px;">
                        <i class="ti ti-shield me-2 text-white"></i>Tambah Akun Security Baru
                    </h5>
                </div>

                <form action="{{ route('admin.security.store') }}" method="POST">
                    @csrf

                    <div class="mb-3 text-start">
                        <label for="name" class="form-label text-primary fw-bold small">Nama Petugas <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Masukkan nama lengkap petugas..." required style="border: 2px solid #cbdfff; border-radius: 12px; padding: 12px 16px;">
                        @error('name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="mb-3 text-start">
                        <label for="email" class="form-label text-primary fw-bold small">Email / Username <span class="text-danger">*</span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="contoh: security@pcr.ac.id" required style="border: 2px solid #cbdfff; border-radius: 12px; padding: 12px 16px;">
                        @error('email')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="mb-3 text-start">
                        <label for="password" class="form-label text-primary fw-bold small">Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Minimal 6 atau 8 karakter..." required style="border: 2px solid #cbdfff; border-radius: 12px; padding: 12px 16px;">
                        @error('password')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="mb-4 text-start">
                        <label for="password_confirmation" class="form-label text-primary fw-bold small">Konfirmasi Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password di atas..." required style="border: 2px solid #cbdfff; border-radius: 12px; padding: 12px 16px;">
                    </div>

                    <input type="hidden" name="role" value="security">

                    <div class="row g-2 mt-2">
                        <div class="col-6">
                            <button type="button" class="btn btn-outline-secondary w-100" onclick="window.history.back()" style="border-radius: 12px; padding: 12px; font-weight: bold; border: 2px solid #cbdfff; color: #475569;">
                                Batal
                            </button>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary w-100 shadow-sm" style="border-radius: 12px; padding: 12px; font-weight: bold; background-color: #3475FE; border: none;">
                                Simpan Akun
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
