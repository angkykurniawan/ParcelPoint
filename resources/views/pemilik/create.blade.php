@extends('Crovex.baseFile', ['title' => 'Tambah Data Pemilik Surat Paket'])

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card" style="border-radius: 16px; border: 1px solid #e1eeff; box-shadow: 0 10px 30px rgba(13, 110, 253, 0.03);">
            <div class="card-body p-4">

                <div class="d-flex justify-content-center align-items-center p-3 mb-4 rounded-3 text-white" style="background: linear-gradient(135deg, #0d6efd, #0a58ca);">
                    <h5 class="m-0 text-center text-white" style="font-weight: 800; font-size: 1.15rem; letter-spacing: 0.5px;">
                        <i class="ti ti-crown me-2 text-white"></i>Tambah Data Pemilik
                    </h5>
                </div>

                <form action="/pemilik" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">

                        <div class="col-md-6">
                            <div class="mb-3 text-start">
                                <label for="NomorInduk" class="form-label text-primary fw-bold small">Nomor Induk <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('NomorInduk') is-invalid @enderror" id="NomorInduk" name="NomorInduk" value="{{ old('NomorInduk') }}" placeholder="2355300000" required style="border: 2px solid #cbdfff; border-radius: 12px; padding: 12px 16px;">
                                @error('NomorInduk')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="mb-3 text-start">
                                <label for="Nama" class="form-label text-primary fw-bold small">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('Nama') is-invalid @enderror" id="Nama" name="Nama" value="{{ old('Nama') }}" placeholder="Serwin" required style="border: 2px solid #cbdfff; border-radius: 12px; padding: 12px 16px;">
                                @error('Nama')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="mb-3 text-start">
                                <label for="Pekerjaan" class="form-label text-primary fw-bold small">Pekerjaan <span class="text-danger">*</span></label>
                                <select class="form-control select2" name="Pekerjaan" id="Pekerjaan" required style="border: 2px solid #cbdfff; border-radius: 12px; padding: 12px 16px;">
                                    <option value="" disabled {{ old('Pekerjaan') === null ? 'selected' : '' }}>Pilih Pekerjaan</option>
                                    <option value="Mahasiswa" {{ old('Pekerjaan') === 'Mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                                    <option value="Dosen" {{ old('Pekerjaan') === 'Dosen' ? 'selected' : '' }}>Dosen</option>
                                    <option value="Staff" {{ old('Pekerjaan') === 'Staff' ? 'selected' : '' }}>Staff</option>
                                </select>
                                @error('Pekerjaan')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="mb-3 text-start">
                                <label for="JenisKelamin" class="form-label text-primary fw-bold small">Jenis Kelamin <span class="text-danger">*</span></label>
                                <select class="form-control select2" name="JenisKelamin" id="JenisKelamin" required style="border: 2px solid #cbdfff; border-radius: 12px; padding: 12px 16px;">
                                    <option value="" disabled {{ old('JenisKelamin') === null ? 'selected' : '' }}>Pilih Jenis Kelamin</option>
                                    <option value="LakiLaki" {{ old('JenisKelamin') === 'LakiLaki' ? 'selected' : '' }}>Laki-Laki</option>
                                    <option value="Perempuan" {{ old('JenisKelamin') === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('JenisKelamin')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3 text-start">
                                <label for="Whatsapp" class="form-label text-primary fw-bold small">No Whatsapp <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('Whatsapp') is-invalid @enderror" id="Whatsapp" name="Whatsapp" value="{{ old('Whatsapp') }}" placeholder="+6281365184956" required style="border: 2px solid #cbdfff; border-radius: 12px; padding: 12px 16px;">
                                @error('Whatsapp')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="mb-3 text-start">
                                <label for="Email" class="form-label text-primary fw-bold small">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('Email') is-invalid @enderror" id="Email" name="Email" value="{{ old('Email') }}" placeholder="mhs@pcr.ac.id" required style="border: 2px solid #cbdfff; border-radius: 12px; padding: 12px 16px;">
                                @error('Email')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="mb-3 text-start">
                                <label for="Umur" class="form-label text-primary fw-bold small">Umur</label>
                                <input type="text" class="form-control @error('Umur') is-invalid @enderror" id="Umur" name="Umur" value="{{ old('Umur') }}" placeholder="25" style="border: 2px solid #cbdfff; border-radius: 12px; padding: 12px 16px;">
                                @error('Umur')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="mb-3 text-start">
                                <label for="Alamat" class="form-label text-primary fw-bold small">Alamat</label>
                                <input type="text" class="form-control @error('Alamat') is-invalid @enderror" id="Alamat" name="Alamat" value="{{ old('Alamat') }}" placeholder="Jl. Kembang Sari" style="border: 2px solid #cbdfff; border-radius: 12px; padding: 12px 16px;">
                                @error('Alamat')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-4 text-start">
                                <label for="Foto" class="form-label text-primary fw-bold small">Foto Profil</label>
                                <input type="file" class="form-control @error('Foto') is-invalid @enderror" id="Foto" name="Foto" style="border: 2px solid #cbdfff; border-radius: 12px; padding: 12px 16px;">
                                @error('Foto')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="row g-2 mt-2">
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
            text: "{{ session('success') }}",
            confirmButtonColor: '#3475FE',
            confirmButtonText: 'OK'
        });
    </script>
@endif
@endsection
