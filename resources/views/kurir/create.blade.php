@extends('Crovex/baseFile', ['title' => 'Tambah Data Kurir Surat Paket'])
@section('content')
<div class="card">
    <div class="card-body">
        <center><h5 class="card-title btn-primary" style="font-weight: bolder; font-size: 20px; height: 20%; border-radius: 5px;" >Tambah Data Kurir</h5></center><br>
        <form action="/kurir" method="POST" enctype="multipart/form-data"> <!-- enctype untuk foto -->
            @csrf
            <div class="form-group mt-1 mb-3">
                <label for="Ekspedisi" class="text-primary" style="font-weight: bolder;">Ekspedisi</label>
                <input type="text" class="form-control @error('Ekspedisi') is-invalid @enderror" id="Ekspedisi" name="Ekspedisi"
                    value="{{ old('Ekspedisi') }}" placeholder="JNT" >
                <span class="text-danger">{{ $errors->first('Ekspedisi') }}</span>
            </div>
            <button type="submit" class="btn btn-primary">SIMPAN</button>
        </form>
    </div>
</div>
@endsection
