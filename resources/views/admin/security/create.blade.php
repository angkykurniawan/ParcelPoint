@extends('dashboardLayout', ['title' => 'Tambah Akun Security'])

@section('content')
<div class="row">
    <div class="col-12 col-md-6 mx-auto">
        <div class="card" style="border-radius: 16px; border: 1px solid #e1eeff; box-shadow: 0 10px 30px rgba(13, 110, 253, 0.03);">
            <div class="card-body p-4">

                <div class="text-center p-3 mb-4 rounded-3 text-white" style="background: linear-gradient(135deg, #0d6efd, #0a58ca);">
                    <h5 class="m-0" style="font-weight: 800;"><i class="ti ti-shield me-2"></i>Buat Akun Security Baru</h5>
                </div>

                <form action="{{ route('admin.security.store') }}" method="POST">
                    @csrf

                    <div class="mb-3 text-start">
                        <label class="form-label text-primary fw-bold small">Nama Lengkap Petugas *</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required style="border: 2px solid #cbdfff; border-radius: 12px; padding: 12px 16px;">
                        @error('name') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
                    </div>

                    <div class="mb-3 text-start">
                        <label class="form-label text-primary fw-bold small">Email / Username Login *</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required placeholder="security@pcr.ac.id" style="border: 2px solid #cbdfff; border-radius: 12px; padding: 12px 16px;">
                        @error('email') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
                    </div>

                    <div class="mb-3 text-start">
                        <label class="form-label text-primary fw-bold small">Password *</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required style="border: 2px solid #cbdfff; border-radius: 12px; padding: 12px 16px;">
                        @error('password') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
                    </div>

                    <div class="mb-4 text-start">
                        <label class="form-label text-primary fw-bold small">Konfirmasi Password *</label>
                        <input type="password" name="password_confirmation" class="form-control" required style="border: 2px solid #cbdfff; border-radius: 12px; padding: 12px 16px;">
                    </div>

                    <div class="row g-2">
                        <div class="col-6">
                            <a href="{{ route('admin.security.index') }}" class="btn btn-outline-secondary w-100" style="border-radius: 12px; padding: 12px; font-weight: bold; border: 2px solid #cbdfff;">
                                Batal
                            </a>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary w-100 shadow-sm" style="border-radius: 12px; padding: 12px; font-weight: bold; background-color: #3475FE; border: none;">
                                Buat Akun
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
