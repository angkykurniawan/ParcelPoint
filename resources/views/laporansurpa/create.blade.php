@extends('Crovex/baseFile', ['title' => 'Laporan Serah Terima Surat Paket'])

@section('content')
<div class="card">
    <div class="card-body">
        <center>
            <h5 class="card-title btn-primary" style="font-weight: bolder; font-size: 20px; height: 20%; border-radius: 5px;">
                Laporan Serah Terima Surat & Paket
            </h5>
        </center>
        <br>
        <form action="/laporansurpa" method="GET" target="_blank">
            <div class="form-group mt-1 mb-3">
                <label for="tanggal_mulai" class="text-primary" style="font-weight: bolder;">Tanggal Awal</label>
                <input type="date" name="tanggal_mulai" class="form-control" value="{{ old('tanggal_mulai') }}">
            </div>

            <div class="form-group mt-1 mb-3">
                <label for="tanggal_akhir" class="text-primary" style="font-weight: bolder;">Tanggal Akhir</label>
                <input type="date" name="tanggal_akhir" class="form-control" value="{{ old('tanggal_akhir') }}">
            </div>

            <div class="form-group mt-1 mb-3">
                <label for="pemilik_id" class="text-primary" style="font-weight: bolder;">Pilih Pemilik</label>
                <select name="pemilik_id" class="form-control">
                    <option value="">-- Semua Data --</option>
                    @foreach ($listPemilik as $key => $val)
                        <option value="{{ $key }}" @selected(old('pemilik_id') == $key)>{{ $val }}</option>
                    @endforeach
                </select>
            </div>

            <center><button type="submit" class="btn btn-primary">Cetak</button></center>
        </form>
    </div>
</div>
@endsection
