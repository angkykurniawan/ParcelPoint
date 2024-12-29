@extends('Crovex/baseFile', ['title' => 'Edit Data Ruang Surat Paket'])
@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-header">Edit Data Ruang : <b>{{ strtoupper($ruang->Nama) }}</b></h5>
        <form action="/ruang/{{ $ruang->id }}" method="POST" enctype="multipart/form-data"> <!-- enctype untuk foto -->
            @method('put')
            @csrf
            <div class="form-group mt-1 mb-3">
                <label for="Nama">Nama *</label>
                <input type="text" class="form-control @error('Nama') is-invalid @enderror" id="Nama" name="Nama"
                    value="{{ old('Nama') ?? $ruang->Nama }}">
                <span class="text-danger">{{ $errors->first('Nama') }}</span>
            </div>
            <div class="form-group mt-1 mb-3">
                <label for="Lantai">Lantai</label>
                <input type="text" class="form-control @error('Lantai') is-invalid @enderror" id="Lantai" name="Lantai"
                    value="{{ old('Lantai') ?? $ruang->Lantai }}">
                <span class="text-danger">{{ $errors->first('Lantai') }}</span>
            </div>
            <div class="form-group mt-1 mb-3">
                <label for="Lokasi">Lokasi</label>
                <input type="text" class="form-control @error('Lokasi') is-invalid @enderror" id="Lokasi" name="Lokasi"
                    value="{{ old('Lokasi') ?? $ruang->Lokasi }}">
                <span class="text-danger">{{ $errors->first('Lokasi') }}</span>
            </div>
            <div class="form-group mt-1 mb-3">
                <label for="PIC">PIC</label>
                <input type="text" class="form-control @error('PIC') is-invalid @enderror" id="PIC" name="PIC"
                    value="{{ old('PIC') ?? $ruang->PIC }}">
                <span class="text-danger">{{ $errors->first('PIC') }}</span>
            </div>
            <button type="submit" class="btn btn-primary">UPDATE</button>
        </form>
    </div>
</div>
@endsection
