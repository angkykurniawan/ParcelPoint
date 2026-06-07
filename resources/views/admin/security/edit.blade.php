@extends('Crovex.baseFile', ['title' => 'Edit Akun Security'])

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card" style="border-radius: 16px; border: 1px solid #e1eeff; box-shadow: 0 10px 30px rgba(13, 110, 253, 0.03);">
            <div class="card-body p-4">

                <div class="d-flex justify-content-center align-items-center p-3 mb-4 rounded-3 text-white" style="background: linear-gradient(135deg, #ffc107, #ff9800);">
                    <h5 class="m-0 text-center text-white" style="font-weight: 800; font-size: 1.15rem; letter-spacing: 0.5px;">
                        <i class="ti ti-edit me-2 text-white"></i>Edit Data Akun Security
                    </h5>
                </div>

                <form action="{{ route('admin.security.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3 text-start">
                        <label class="form-label text-primary fw-bold small">Nama Lengkap Petugas *</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required style="border: 2px solid #cbdfff; border-radius: 12px; padding: 12px 16px;">
                        @error('name') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
                    </div>

                    <div class="mb-3 text-start">
                        <label class="form-label text-primary fw-bold small">Email / Username Login *</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required style="border: 2px solid #cbdfff; border-radius: 12px; padding: 12px 16px;">
                        @error('email') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
                    </div>

                    <div class="mb-3 text-start bg-light p-3 rounded-3" style="border: 1px dashed #ff9800;">
                        <p class="text-muted small mb-2">💡 <strong>Informasi:</strong> Biarkan kolom di bawah ini <strong>kosong</strong> jika petugas tidak ingin mengganti password lamanya.</p>

                        <label class="form-label text-primary fw-bold small">Password Baru (Opsional)</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" style="border: 2px solid #cbdfff; border-radius: 12px; padding: 12px 16px;">
                        @error('password') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
                    </div>

                    <div class="mb-4 text-start">
                        <label class="form-label text-primary fw-bold small">Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation" class="form-control" style="border: 2px solid #cbdfff; border-radius: 12px; padding: 12px 16px;">
                    </div>

                    <div class="row g-2">
                        <div class="col-6">
                            <a href="{{ route('admin.security.index') }}" class="btn btn-outline-secondary w-100" style="border-radius: 12px; padding: 12px; font-weight: bold; border: 2px solid #cbdfff; color: #475569;">
                                Batal
                            </a>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-warning w-100 shadow-sm text-white" style="border-radius: 12px; padding: 12px; font-weight: bold; border: none; background-color: #ff9800;">
                                Perbarui Akun
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
