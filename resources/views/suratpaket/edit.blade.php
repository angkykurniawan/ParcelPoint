@extends('Crovex/baseFile', ['title' => 'Edit Data Surat Paket'])
@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-header">Edit Data Surat Paket : <b>{{ strtoupper($suratPaket->Resi) }}</b></h5>
        <form action="/suratPaket/{{ $suratPaket->id }}" method="POST" enctype="multipart/form-data"> <!-- enctype untuk foto -->
            @method('put')
            @csrf
            <div class="form-group mt-1 mb-3">
                <label for="pemilik_id">Pilih Nama Pemilik</label>
                <select class="form-control @error('pemilik_id') is-invalid @enderror" id="pemilik_id" name="pemilik_id">
                    @foreach($Pemilik as $pe)
                        <option value="{{ $pe->id }}" {{ old('pemilik_id') == $pe->id ? 'selected' : '' }}>
                            {{ $pe->Nama }}
                    @endforeach
                </select>
                <span class="text-danger">{{ $errors->first('pemilik_id') }}</span>
            </div>
            <div class="form-group mt-1 mb-3">
                <label for="Jenis" class="text-primary" style="font-weight: bolder;">Jenis *</label>
                <select class="form-control" name="Jenis" id="Jenis">
                    <option value="" disabled selected>Pilih Jenis</option>
                    <option value="Surat" {{ old('Surat', $suratPaket->Jenis ?? '') === 'Surat' ? 'selected' : '' }}>
                        Surat
                    </option>
                    <option value="Paket" {{ old('', $suratPaket->Jenis ?? '') === 'Paket' ? 'selected' : '' }}>
                        Paket
                    </option>
                </select>
                <span class="text-danger">{{ $errors->first('Jenis') }}</span>
            </div>
            <div class="form-group mt-1 mb-3">
                <label for="foto" class="text-primary" style="font-weight: bolder;">Foto</label>
                <input type="file" class="form-control @error('Foto') is-invalid @enderror" id="Foto" name="Foto">
                <span class="text-danger">{{ $errors->first('Foto') }}</span>
                <img src="{{  Storage::url($suratPaket->Foto) }}" alt="Foto SuratPaket" class="img-thumbnail mt-2"
                    style="width: 100px">
            </div>
            <div class="form-group mt-1 mb-3">
                <label for="NoHP" class="text-primary" style="font-weight: bolder;">No HP *</label>
                <input type="text" class="form-control @error('NoHP') is-invalid @enderror" id="NoHP" name="NoHP"
                    value="{{ old('NoHP') ?? $suratPaket->NoHP }}">
                <span class="text-danger">{{ $errors->first('NoHP') }}</span>
            </div>
            <div class="form-group mt-1 mb-3">
                <label for="Resi" class="text-primary" style="font-weight: bolder;">Resi</label>
                <input type="text" class="form-control @error('Resi') is-invalid @enderror" id="Resi" name="Resi"
                    value="{{ old('Resi') ?? $suratPaket->Resi }}">
                <span class="text-danger">{{ $errors->first('Resi') }}</span>
            </div>
            <div class="form-group mt-1 mb-3">
                <label for="Berat" class="text-primary" style="font-weight: bolder;">Berat *</label>
                <input type="text" class="form-control @error('Berat') is-invalid @enderror" id="Berat" name="Berat"
                    value="{{ old('Berat') ?? $suratPaket->Berat }}">
                <span class="text-danger">{{ $errors->first('Berat') }}</span>
            </div>
            <button type="submit" class="btn btn-primary">UPDATE</button>
        </form>
    </div>
</div>
@endsection
