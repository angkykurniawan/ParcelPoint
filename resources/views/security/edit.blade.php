@extends('Crovex/baseFile', ['title' => 'Edit Data Security'])
@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-header">Edit Data Security : <b>{{ strtoupper($security->Nama) }}</b></h5>
        <form action="/security/{{ $security->id }}" method="POST" enctype="multipart/form-data"> <!-- enctype untuk foto -->
            @method('put')
            @csrf
            <div class="form-group mt-1 mb-3">
                <label for="NIP" class="text-primary" style="font-weight: bolder;">NIP *</label>
                <input type="text" class="form-control @error('NIP') is-invalid @enderror" id="NIP" name="NIP"
                    value="{{ old('NIP') ?? $security->NIP }}">
                <span class="text-danger">{{ $errors->first('NIP') }}</span>
            </div>
            <div class="form-group mt-1 mb-3">
                <label for="foto" class="text-primary" style="font-weight: bolder;">Foto</label>
                <input type="file" class="form-control @error('Foto') is-invalid @enderror" id="Foto" name="Foto">
                <span class="text-danger">{{ $errors->first('Foto') }}</span>
                <img src="{{  Storage::url($security->Foto) }}" alt="Foto Security" class="img-thumbnail mt-2"
                    style="width: 100px">
            </div>
            <div class="form-group mt-1 mb-3">
                <label for="Nama" class="text-primary" style="font-weight: bolder;">Nama *</label>
                <input type="text" class="form-control @error('Nama') is-invalid @enderror" id="Nama" name="Nama"
                    value="{{ old('Nama') ?? $security->Nama }}">
                <span class="text-danger">{{ $errors->first('Nama') }}</span>
            </div>
            <div class="form-group mt-1 mb-3">
                <label for="NoHP" class="text-primary" style="font-weight: bolder;">Nomor HP *</label>
                <input type="text" class="form-control @error('NoHP') is-invalid @enderror" id="NoHP" name="NoHP"
                    value="{{ old('NoHP') ?? $security->NoHP }}">
                <span class="text-danger">{{ $errors->first('NoHP') }}</span>
            </div>
            <div class="form-group mt-1 mb-3">
                <label for="Email" class="text-primary" style="font-weight: bolder;">Email *</label>
                <input type="text" class="form-control @error('Email') is-invalid @enderror" id="Email" name="Email"
                    value="{{ old('Email') ?? $security->Email }}">
                <span class="text-danger">{{ $errors->first('Email') }}</span>
            </div>
            <button type="submit" class="btn btn-primary">UPDATE</button>
        </form>
    </div>
</div>
@endsection
