@extends('Crovex/baseFile', ['title' => 'Edit Data Kurir Surat Paket'])
@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-header">Edit Data Kurir : <b>{{ strtoupper($kurir->Ekspedisi) }}</b></h5>
        <form action="/kurir/{{ $kurir->id }}" method="POST" enctype="multipart/form-data"> <!-- enctype untuk foto -->
            @method('put')
            @csrf
            <div class="form-group mt-1 mb-3">
                <label for="Ekspedisi" class="text-primary" style="font-weight: bolder;">Ekspedisi *</label>
                <input type="text" class="form-control @error('Ekspedisi') is-invalid @enderror" id="Ekspedisi" name="Ekspedisi"
                    value="{{ old('Ekspedisi') ?? $kurir->Ekspedisi }}">
                <span class="text-danger">{{ $errors->first('Ekspedisi') }}</span>
            </div>
            <button type="submit" class="btn btn-primary">UPDATE</button>
        </form>
    </div>
</div>
@endsection
