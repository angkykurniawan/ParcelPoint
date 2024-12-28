@extends('Crovex/baseFile', ['title' => 'Tambah Data Pemilik Surat Paket'])
@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Tambah Data Pemilik</h5>
        <form action="/pemilik" method="POST" enctype="multipart/form-data"> <!-- enctype untuk foto -->
            @csrf
            <div class="form-group mt-1 mb-3">
                <label for="NomorInduk">Nomor Induk</label>
                <input type="text" class="form-control @error('NomorInduk') is-invalid @enderror" id="NomorInduk" name="NomorInduk"
                    value="{{ old('NomorInduk') }}">
                <span class="text-danger">{{ $errors->first('NomorInduk') }}</span>
            </div>
            <div class="form-group mt-1 mb-3">
                <label for="Nama">Nama</label>
                <input type="text" class="form-control @error('Nama') is-invalid @enderror" id="Nama"
                    name="Nama" value="{{ old('Nama') }}">
                <span class="text-danger">{{ $errors->first('Nama') }}</span>
            </div>
            <div class="form-group mt-1 mb-3">
                <label for="Umur">Umur</label>
                <input type="text" class="form-control @error('Umur') is-invalid @enderror" id="Umur" name="Umur"
                    value="{{ old('Umur') }}">
                <span class="text-danger">{{ $errors->first('Umur') }}</span>
            </div>
            <button type="submit" class="btn btn-primary">SIMPAN</button>
        </form>
    </div>
</div>
@endsection
