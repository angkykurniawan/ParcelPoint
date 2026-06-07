@extends('Crovex/baseFile', ['title' => 'Edit Data Pemilik Surat Paket'])
@section('content')
    <div class="card">
        <div class="card-body">
            <h3 class="text-primary" style="font-weight: bolder; text-align: center;">Edit Data Pemilik Surat & Paket<center><b>{{ strtoupper($pemilik->Nama) }}</b></center><br></h3>
            <form action="/pemilik/{{ $pemilik->id }}" method="POST" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="form-group mt-1 mb-3">
                    <label for="NomorInduk" class="text-primary" style="font-weight: bolder;">Nomor Induk *</label>
                    <input type="text" class="form-control @error('NomorInduk') is-invalid @enderror" id="NomorInduk" name="NomorInduk"
                        value="{{ old('NomorInduk') ?? $pemilik->NomorInduk }}">
                    <span class="text-danger">{{ $errors->first('NomorInduk') }}</span>
                </div>
                <div class="form-group mt-1 mb-3">
                    <label for="Foto" class="text-primary" style="font-weight: bolder;">Foto</label>
                    <input type="file" class="form-control @error('Foto') is-invalid @enderror" id="Foto" name="Foto">
                    <span class="text-danger">{{ $errors->first('Foto') }}</span>
                    <img src="{{  Storage::url($pemilik->Foto) }}" alt="Foto Pemilik" class="img-thumbnail mt-2"
                        style="width: 100px">
                </div>
                <div class="form-group mt-1 mb-3">
                    <label for="Nama" class="text-primary" style="font-weight: bolder;">Nama *</label>
                    <input type="text" class="form-control @error('Nama') is-invalid @enderror" id="Nama" name="Nama"
                        value="{{ old('Nama') ?? $pemilik->Nama }}">
                    <span class="text-danger">{{ $errors->first('Nama') }}</span>
                </div>
                <div class="form-group mt-1 mb-3">
                    <label for="Umur" class="text-primary" style="font-weight: bolder;">Umur</label>
                    <input type="text" class="form-control @error('Umur') is-invalid @enderror" id="Umur" name="Umur"
                        value="{{ old('Umur') ?? $pemilik->Umur }}">
                    <span class="text-danger">{{ $errors->first('Umur') }}</span>
                </div>
                <div class="form-group mt-1 mb-3">
                    <label for="Pekerjaan" class="text-primary" style="font-weight: bolder;">Pekerjaan *</label>
                    <select class="form-control" name="Pekerjaan" id="Pekerjaan">
                        <option value="" disabled selected>Pilih Pekerjaan</option>
                        <option value="Mahasiswa" {{ old('Pekerjaan', $pemilik->Pekerjaan ?? '') === 'Mahasiswa' ? 'selected' : '' }}>
                            Mahasiswa
                        </option>
                        <option value="Dosen" {{ old('Pekerjaan', $pemilik->Pekerjaan ?? '') === 'Dosen' ? 'selected' : '' }}>
                            Dosen
                        </option>
                        <option value="Staff" {{ old('Pekerjaan', $pemilik->Pekerjaan ?? '') === 'Staff' ? 'selected' : '' }}>
                            Staff
                        </option>
                    </select>
                    <span class="text-danger">{{ $errors->first('Pekerjaan') }}</span>
                </div>
                <div class="form-group mt-1 mb-3">
                    <label for="Whatsapp" class="text-primary" style="font-weight: bolder;">No Whatsapp *</label>
                    <input type="text" class="form-control @error('Whatsapp') is-invalid @enderror" id="Whatsapp" name="Whatsapp"
                        value="{{ old('Whatsapp') ?? $pemilik->Whatsapp }}">
                    <span class="text-danger">{{ $errors->first('Whatsapp') }}</span>
                </div>
                <div class="form-group mt-1 mb-3">
                    <label for="Email" class="text-primary" style="font-weight: bolder;">Email *</label>
                    <input type="text" class="form-control @error('Email') is-invalid @enderror" id="Email" name="Email"
                        value="{{ old('Email') ?? $pemilik->Email }}">
                    <span class="text-danger">{{ $errors->first('Email') }}</span>
                </div>
                <div class="form-group mt-1 mb-3">
                    <label for="JenisKelamin" class="text-primary" style="font-weight: bolder;">Jenis Kelamin *</label>
                    <select class="form-control" name="JenisKelamin" id="JenisKelamin">
                        <option value="" disabled selected>Pilih Jenis Kelamin</option>
                        <option value="LakiLaki" {{ old('JenisKelamin', $pemilik->JenisKelamin ?? '') === 'LakiLaki' ? 'selected' : '' }}>
                            Laki-Laki
                        </option>
                        <option value="Perempuan" {{ old('JenisKelamin', $pemilik->JenisKelamin ?? '') === 'Perempuan' ? 'selected' : '' }}>
                            Perempuan
                        </option>
                    </select>
                    <span class="text-danger">{{ $errors->first('JenisKelamin') }}</span>
                </div>
                <div class="form-group mt-1 mb-3">
                    <label for="Alamat" class="text-primary" style="font-weight: bolder;">Alamat</label>
                    <input type="text" class="form-control @error('Alamat') is-invalid @enderror" id="Alamat" name="Alamat"
                        value="{{ old('Alamat') ?? $pemilik->Alamat }}">
                    <span class="text-danger">{{ $errors->first('Alamat') }}</span>
                </div>
                <center><button type="submit" class="btn btn-primary">UPDATE</button></center>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session("success") }}',
                confirmButtonText: 'OK'
            });
        </script>
    @elseif (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session("error") }}',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
@endsection
