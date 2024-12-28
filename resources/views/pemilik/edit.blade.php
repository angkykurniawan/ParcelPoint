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
                <input type="text" class="form-control @error('Nama') is-invalid @enderror" id="Nama" name="Nama"
                    value="{{ old('Nama') ?? $pemilik->Nama }}">
                <span class="text-danger">{{ $errors->first('Nama') }}</span>
            </div>




            {{-- <div class="form-group mt-1 mb-3">
                <label for="foto">Foto</label>
                <input type="file" class="form-control @error('Foto') is-invalid @enderror" id="Foto" name="Foto">
                <span class="text-danger">{{ $errors->first('Foto') }}</span>
                <img src="{{  Storage::url($pemilik->Foto) }}" alt="Foto Pemilik" class="img-thumbnail mt-2"
                    style="width: 100px">
            </div> --}}
            <div class="form-group mt-1 mb-3">
                <label for="Nama">Nama</label>
                <input type="text" class="form-control @error('Nama') is-invalid @enderror" id="Nama" name="Nama"
                    value="{{ old('Nama') ?? $pemilik->Nama }}">
                <span class="text-danger">{{ $errors->first('Nama') }}</span>
            </div>


            <div class="form-group mt-1 mb-3">
                <label for="JenisKelamin">Jenis Kelamin</label>
                <select class="form-control" name="JenisKelamin" id="JenisKelamin">
                    <option value="" disabled selected>Pilih Jenis Kelamin</option>
                    <option value="LakiLaki" {{ old('JenisKelamin', $pemilik->JenisKelamin ?? '') === 'LakiLaki' ? 'selected' : '' }}>
                        Laki-Laki
                    </option>
                    <option value="Perempuan" {{ old('JenisKekain', $pemilik->JenisKelamin ?? '') === 'Perempuan' ? 'selected' : '' }}>
                        Perempuan
                    </option>
                </select>
                <span class="text-danger">{{ $errors->first('JenisKelamin') }}</span>
            </div>
            {{-- <div class="form-group mt-1 mb-3">
                <label for="alamat">Alamat</label>
                <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat"
                    value="{{ old('alamat') ?? $pasiens->alamat }}">
                <span class="text-danger">{{ $errors->first('alamat') }}</span>
            </div> --}}
            <button type="submit" class="btn btn-primary">UPDATE</button>
        </form>
    </div>
</div>
@endsection
