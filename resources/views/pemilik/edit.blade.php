@extends('Crovex/baseFile', ['title' => 'Edit Data Pemilik Surat Paket'])
@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-header">Edit Data Pemilik : <b>{{ strtoupper($pemilik->Nama) }}</b></h5>
        <form action="/pemilik/{{ $pemilik->id }}" method="POST" enctype="multipart/form-data"> <!-- enctype untuk foto -->
            @method('put')
            @csrf
            <div class="form-group mt-1 mb-3">
                <label for="NomorInduk">Nomor Induk</label>
                <input type="text" class="form-control @error('NomorInduk') is-invalid @enderror" id="NomorInduk" name="NomorInduk"
                    value="{{ old('NomorInduk') ?? $pemilik->NomorInduk }}">
                <span class="text-danger">{{ $errors->first('NomorInduk') }}</span>
            </div>
            <div class="form-group mt-1 mb-3">
                <label for="foto">Foto</label>
                <input type="file" class="form-control @error('Foto') is-invalid @enderror" id="Foto" name="Foto">
                <span class="text-danger">{{ $errors->first('Foto') }}</span>
                <img src="{{  Storage::url($pemilik->Foto) }}" alt="Foto Pemilik" class="img-thumbnail mt-2"
                    style="width: 100px">
            </div>
            <div class="form-group mt-1 mb-3">
                <label for="Nama">Nama</label>
                <input type="text" class="form-control @error('Nama') is-invalid @enderror" id="Nama" name="Nama"
                    value="{{ old('Nama') ?? $pemilik->Nama }}">
                <span class="text-danger">{{ $errors->first('Nama') }}</span>
            </div>
            <div class="form-group mt-1 mb-3">
                <label for="Umur">Umur</label>
                <input type="text" class="form-control @error('Umur') is-invalid @enderror" id="Umur" name="Umur"
                    value="{{ old('Umur') ?? $pemilik->Umur }}">
                <span class="text-danger">{{ $errors->first('Umur') }}</span>
            </div>
            <div class="form-group mt-1 mb-3">
                <label for="Pekerjaan">Pekerjaan</label>
                <select class="form-control" name="Pekerjaan" id="Pekerjaan">
                    <option value="" disabled selected>Pilih Pekerjaan</option>
                    <option value="Mahasiswa" {{ old('Pekerjaan', $pemilik->Pekerjaan ?? '') === 'Mahasiswa' ? 'selected' : '' }}>
                        Mahasiswa
                    </option>
                    <option value="Dosen" {{ old('', $pemilik->Pekerjaan ?? '') === 'Dosen' ? 'selected' : '' }}>
                        Dosen
                    </option>
                    <option value="Staff" {{ old('', $pemilik->Pekerjaan ?? '') === 'Staff' ? 'selected' : '' }}>
                        Staff
                    </option>
                </select>
                <span class="text-danger">{{ $errors->first('Pekerjaan') }}</span>
            </div>
            <div class="form-group mt-1 mb-3">
                <label for="Whatsapp">Whatsapp</label>
                <input type="text" class="form-control @error('Whatsapp') is-invalid @enderror" id="Whatsapp" name="Whatsapp"
                    value="{{ old('Whatsapp') ?? $pemilik->Whatsapp }}">
                <span class="text-danger">{{ $errors->first('Whatsapp') }}</span>
            </div>
            <div class="form-group mt-1 mb-3">
                <label for="Email">Email</label>
                <input type="text" class="form-control @error('Email') is-invalid @enderror" id="Email" name="Email"
                    value="{{ old('Email') ?? $pemilik->Email }}">
                <span class="text-danger">{{ $errors->first('Email') }}</span>
            </div>
            <div class="form-group mt-1 mb-3">
                <label for="JenisKelamin">Jenis Kelamin</label>
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
                <label for="Jalan">Jalan</label>
                <input type="text" class="form-control @error('Jalan') is-invalid @enderror" id="Jalan" name="Jalan"
                    value="{{ old('Jalan') ?? $pemilik->Jalan }}">
                <span class="text-danger">{{ $errors->first('Jalan') }}</span>
            </div>
            <div class="form-group mt-1 mb-3">
                <label for="Kecamatan">Kecamatan</label>
                <input type="text" class="form-control @error('Kecamatan') is-invalid @enderror" id="Kecamatan" name="Kecamatan"
                    value="{{ old('Kecamatan') ?? $pemilik->Kecamatan }}">
                <span class="text-danger">{{ $errors->first('Kecamatan') }}</span>
            </div>
            <div class="form-group mt-1 mb-3">
                <label for="KabupatenKota">Kabupaten / Kota</label>
                <input type="text" class="form-control @error('KabupatenKota') is-invalid @enderror" id="KabupatenKota" name="KabupatenKota"
                    value="{{ old('KabupatenKota') ?? $pemilik->KabupatenKota }}">
                <span class="text-danger">{{ $errors->first('KabupatenKota') }}</span>
            </div>
            <div class="form-group mt-1 mb-3">
                <label for="Provinsi">Provinsi</label>
                <input type="text" class="form-control @error('Provinsi') is-invalid @enderror" id="Provinsi" name="Provinsi"
                    value="{{ old('Provinsi') ?? $pemilik->Provinsi }}">
                <span class="text-danger">{{ $errors->first('Provinsi') }}</span>
            </div>
            <button type="submit" class="btn btn-primary">UPDATE</button>
        </form>
    </div>
</div>
@endsection
