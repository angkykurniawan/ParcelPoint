@extends('Crovex/baseFile', ['title' => 'Tambah Data Pemilik Surat Paket'])
@section('content')
<div class="card">
    <div class="card-body">
        <center><h5 class="card-title btn-primary" style="font-weight: bolder; font-size: 20px; height: 20%; border-radius: 5px;" >Tambah Data Pemilik</h5></center><br>
        <form action="/pemilik" method="POST" enctype="multipart/form-data"> <!-- enctype untuk foto -->
            @csrf
            <div class="form-group mt-1 mb-3">
                <label for="NomorInduk" class="text-primary" style="font-weight: bolder;">Nomor Induk</label>
                <input type="text" class="form-control @error('NomorInduk') is-invalid @enderror" id="NomorInduk" name="NomorInduk"
                    value="{{ old('NomorInduk') }}" placeholder="2355300000" >
                <span class="text-danger">{{ $errors->first('NomorInduk') }}</span>
            </div>
            <div class="form-group mt-1 mb-3">
                <label for="Nama" class="text-primary" style="font-weight: bolder;">Nama</label>
                <input type="text" class="form-control @error('Nama') is-invalid @enderror" id="Nama"
                    name="Nama" value="{{ old('Nama') }}" placeholder="Serwin">
                <span class="text-danger">{{ $errors->first('Nama') }}</span>
            </div>
            <div class="form-group mt-1 mb-3">
                <label for="Umur" class="text-primary" style="font-weight: bolder;">Umur</label>
                <input type="text" class="form-control @error('Umur') is-invalid @enderror" id="Umur" name="Umur"
                    value="{{ old('Umur') }}" placeholder="25">
                <span class="text-danger">{{ $errors->first('Umur') }}</span>
            </div>
            <div class="form-group mt-1 mb-3">
                <label for="Pekerjaan" class="text-primary" style="font-weight: bolder;">Pekerjaan</label>
                <select class="form-control" name="Pekerjaan" id="Pekerjaan">
                    <option value="" disabled {{ old('Pekerjaan') === null ? 'selected' : '' }}>Pilih Pekerjaan</option>
                    <option value="Mahasiswa" {{ old('Pekerjaan') === 'Mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                    <option value="Dosen" {{ old('Pekerjaan') === 'Dosen' ? 'selected' : '' }}>Dosen</option>
                    <option value="Staff" {{ old('Pekerjaan') === 'Staff' ? 'selected' : '' }}>Staff</option>
                </select>
                <span class="text-danger">{{ $errors->first('Pekerjaan') }}</span>
            </div>
            <div class="form-group mt-1 mb-3">
                <label for="Whatsapp" class="text-primary" style="font-weight: bolder;">No Whatsapp</label>
                <input type="text" class="form-control @error('Whatsapp') is-invalid @enderror" id="Whatsapp"
                    name="Whatsapp" value="{{ old('Whatsapp') }}" placeholder="+6281365184956">
                <span class="text-danger">{{ $errors->first('Whatsapp') }}</span>
            </div>
            <div class="form-group mt-1 mb-3">
                <label for="Email" class="text-primary" style="font-weight: bolder;">Email</label>
                <input type="text" class="form-control @error('Email') is-invalid @enderror" id="Email"
                    name="Email" value="{{ old('Email') }}" placeholder="mhs@pcr.ac.id">
                <span class="text-danger">{{ $errors->first('Email') }}</span>
            </div>
            <div class="form-group mt-1 mb-3">
                <label for="JenisKelamin" class="text-primary" style="font-weight: bolder;">Jenis Kelamin</label>
                <select class="form-control" name="JenisKelamin" id="JenisKelamin">
                    <option value="" disabled {{ old('JenisKelamin') === null ? 'selected' : '' }}>Pilih Jenis Kelamin</option>
                    <option value="LakiLaki" {{ old('JenisKelamin') === 'LakiLaki' ? 'selected' : '' }}>Laki-Laki</option>
                    <option value="Perempuan" {{ old('JenisKelamin') === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
                <span class="text-danger">{{ $errors->first('JenisKelamin') }}</span>
            </div>
            <div class="form-group mt-1 mb-3">
                <label for="Foto" class="text-primary" style="font-weight: bolder;">Foto</label>
                <input type="file" class="form-control @error('Foto') is-invalid @enderror" id="Foto" name="Foto">
                <span class="text-danger">{{ $errors->first('Foto') }}</span>
            </div>
            <div class="form-group mt-1 mb-3">
                <label for="Jalan" class="text-primary" style="font-weight: bolder;">Jalan</label>
                <input type="text" class="form-control @error('Jalan') is-invalid @enderror" id="Jalan"
                    name="Jalan" value="{{ old('Jalan') }}" placeholder="Jl. Kembang Sari">
                <span class="text-danger">{{ $errors->first('Jalan') }}</span>
            </div>
            <div class="form-group mt-1 mb-3">
                <label for="Kecamatan" class="text-primary" style="font-weight: bolder;">Kecamatan</label>
                <input type="text" class="form-control @error('Kecamatan') is-invalid @enderror" id="Kecamatan"
                    name="Kecamatan" value="{{ old('Kecamatan') }}" placeholder="Umban Sari">
                <span class="text-danger">{{ $errors->first('Kecamatan') }}</span>
            </div>
            <div class="form-group mt-1 mb-3">
                <label for="KabupatenKota" class="text-primary" style="font-weight: bolder;">Kabupaten / Kota</label>
                <input type="text" class="form-control @error('KabupatenKota') is-invalid @enderror" id="KabupatenKota"
                    name="KabupatenKota" value="{{ old('KabupatenKota') }}" placeholder="Rumbai">
                <span class="text-danger">{{ $errors->first('KabupatenKota') }}</span>
            </div>
            <div class="form-group mt-1 mb-3">
                <label for="Pronvinsi" class="text-primary" style="font-weight: bolder;">Provinsi</label>
                <input type="text" class="form-control @error('Provinsi') is-invalid @enderror" id="Provinsi"
                    name="Provinsi" value="{{ old('Provinsi') }}" placeholder="Riau">
                <span class="text-danger">{{ $errors->first('Provinsi') }}</span>
            </div>
            <button type="submit" class="btn btn-primary">SIMPAN</button>
        </form>
    </div>
</div>
@endsection
