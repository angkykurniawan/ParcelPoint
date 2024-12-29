@extends('Crovex/baseFile', ['title' => 'Tambah Data Security'])
@section('content')
<div class="card">
    <div class="card-body">
        <center><h5 class="card-title btn-primary" style="font-weight: bolder; font-size: 20px; height: 20%; border-radius: 5px;" >Tambah Data Security</h5></center><br>
        <form action="/security" method="POST" enctype="multipart/form-data"> <!-- enctype untuk foto -->
            @csrf
            <div class="form-group mt-1 mb-3">
                <label for="NIP" class="text-primary" style="font-weight: bolder;">NIP *</label>
                <input type="text" class="form-control @error('NIP') is-invalid @enderror" id="NIP" name="NIP"
                    value="{{ old('NIP') }}" placeholder="00123131" >
                <span class="text-danger">{{ $errors->first('NIP') }}</span>
            </div>
            <div class="form-group mt-1 mb-3">
                <label for="Foto" class="text-primary" style="font-weight: bolder;">Foto</label>
                <input type="file" class="form-control @error('Foto') is-invalid @enderror" id="Foto" name="Foto">
                <span class="text-danger">{{ $errors->first('Foto') }}</span>
            </div>
            <div class="form-group mt-1 mb-3">
                <label for="Nama" class="text-primary" style="font-weight: bolder;">Nama *</label>
                <input type="text" class="form-control @error('Nama') is-invalid @enderror" id="Nama" name="Nama"
                    value="{{ old('Nama') }}" placeholder="Serwin" >
                <span class="text-danger">{{ $errors->first('Nama') }}</span>
            </div>
            <div class="form-group mt-1 mb-3">
                <label for="NoHP" class="text-primary" style="font-weight: bolder;">Nomor HP *</label>
                <input type="text" class="form-control @error('NoHP') is-invalid @enderror" id="NoHP" name="NoHP"
                    value="{{ old('NoHP') }}" placeholder="+62727270000012" >
                <span class="text-danger">{{ $errors->first('NoHP') }}</span>
            </div>
            <div class="form-group mt-1 mb-3">
                <label for="Email" class="text-primary" style="font-weight: bolder;">Email *</label>
                <input type="text" class="form-control @error('Email') is-invalid @enderror" id="Email" name="Email"
                    value="{{ old('Email') }}" placeholder="security@pcr.ac.id">
                <span class="text-danger">{{ $errors->first('Email') }}</span>
            </div>
            <button type="submit" class="btn btn-primary">SIMPAN</button>
        </form>
    </div>
</div>
@endsection
