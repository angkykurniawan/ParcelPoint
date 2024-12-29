@extends('Crovex/baseFile', ['title' => 'Tambah Data Surat Paket'])
@section('content')
<div class="card">
    <div class="card-body">
        <center><h5 class="card-title btn-primary" style="font-weight: bolder; font-size: 20px; height: 20%; border-radius: 5px;" >Tambah Data Surat Paket</h5></center><br>
        <form action="/suratPaket" method="POST" enctype="multipart/form-data"> <!-- enctype untuk foto -->
            @csrf
            <div class="form-group mt-1 mb-3">
                <label for="pasien_id" class="text-primary" style="font-weight: bolder;">Nama Pemilik |
                    <a href="/pemilik/create" target="blank" class="text-primary" style="font-weight: bolder;">Pemilik Baru</a>
                </label>
                <select class="form-control select2 @error('pemilik_id') is-invalid @enderror" id="pemilik_id" name="pemilik_id">
                    <option value="">Pilih Nama Pemilik</option>
                    @foreach($Pemilik as $pe)
                        <option value="{{ $pe->id }}" {{ old('pemilik_id') == $pe->id ? 'selected' : '' }}>
                            {{ $pe->Nama }}
                        </option>
                    @endforeach
                    </select>
                <span class="text-danger">{{ $errors->first('pemilik_id') }}</span>
            </div>
            <div class="form-group mt-1 mb-3">
                <label for="Jenis" class="text-primary" style="font-weight: bolder;">Jenis *</label>
                <select class="form-control" name="Jenis" id="Jenis">
                    <option value="" disabled {{ old('Jenis') === null ? 'selected' : '' }}>Pilih Jenis</option>
                    <option value="Surat" {{ old('Jenis') === 'Surat' ? 'selected' : '' }}>Surat</option>
                    <option value="Paket" {{ old('Jenis') === 'Paket' ? 'selected' : '' }}>Paket</option>
                </select>
                <span class="text-danger">{{ $errors->first('Jenis') }}</span>
            </div>
            <div class="form-group mt-1 mb-3">
                <label for="Foto" class="text-primary" style="font-weight: bolder;">Foto *</label>
                <input type="file" class="form-control @error('Foto') is-invalid @enderror" id="Foto" name="Foto">
                <span class="text-danger">{{ $errors->first('Foto') }}</span>
            </div>
            <div class="form-group mt-1 mb-3">
                <label for="NoHP" class="text-primary" style="font-weight: bolder;">No HP *</label>
                <input type="text" class="form-control @error('NoHP') is-invalid @enderror" id="NoHP" name="NoHP"
                    value="{{ old('NoHP') }}" placeholder="+6281211110000" >
                <span class="text-danger">{{ $errors->first('NoHP') }}</span>
            </div>
            <div class="form-group mt-1 mb-3">
                <label for="Resi" class="text-primary" style="font-weight: bolder;">Resi *</label>
                <input type="text" class="form-control @error('Resi') is-invalid @enderror" id="Resi" name="Resi"
                    value="{{ old('Resi') }}" placeholder="00012312" >
                <span class="text-danger">{{ $errors->first('Resi') }}</span>
            </div>
            <div class="form-group mt-1 mb-3">
                <label for="Berat" class="text-primary" style="font-weight: bolder;">Berat </label>
                <input type="text" class="form-control @error('Berat') is-invalid @enderror" id="Berat" name="Berat"
                    value="{{ old('Berat') }}" placeholder="100 gr" >
                <span class="text-danger">{{ $errors->first('Berat') }}</span>
            </div>
            <button type="submit" class="btn btn-primary">SIMPAN</button>
        </form>
    </div>
</div>
@endsection
