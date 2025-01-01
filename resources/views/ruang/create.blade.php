@extends('Crovex/baseFile', ['title' => 'Tambah Data Ruang Surat Paket'])

@section('content')
<div class="card">
    <div class="card-body">
        <center>
            <h5 class="card-title btn-primary" style="font-weight: bolder; font-size: 20px; height: 20%; border-radius: 5px;">
                Tambah Data Ruang Surat Paket
            </h5>
        </center><br>

        <form action="/ruang" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Nama Input -->
            <div class="form-group mt-1 mb-3">
                <label for="Nama" class="text-primary" style="font-weight: bolder;">Nama *</label>
                <input type="text" class="form-control @error('Nama') is-invalid @enderror" id="Nama" name="Nama"
                    value="{{ old('Nama') }}" placeholder="Sarana Prasarana">
                <span class="text-danger">{{ $errors->first('Nama') }}</span>
            </div>

            <!-- Lantai Input -->
            <div class="form-group mt-1 mb-3">
                <label for="Lantai" class="text-primary" style="font-weight: bolder;">Lantai</label>
                <input type="text" class="form-control @error('Lantai') is-invalid @enderror" id="Lantai" name="Lantai"
                    value="{{ old('Lantai') }}" placeholder="3">
                <span class="text-danger">{{ $errors->first('Lantai') }}</span>
            </div>

            <!-- Lokasi Input -->
            <div class="form-group mt-1 mb-3">
                <label for="Lokasi" class="text-primary" style="font-weight: bolder;">Lokasi</label>
                <input type="text" class="form-control @error('Lokasi') is-invalid @enderror" id="Lokasi" name="Lokasi"
                    value="{{ old('Lokasi') }}" placeholder="Gedung Utama">
                <span class="text-danger">{{ $errors->first('Lokasi') }}</span>
            </div>

            <!-- PIC Input -->
            <div class="form-group mt-1 mb-3">
                <label for="PIC" class="text-primary" style="font-weight: bolder;">PIC</label>
                <input type="text" class="form-control @error('PIC') is-invalid @enderror" id="PIC" name="PIC"
                    value="{{ old('PIC') }}" placeholder="Nama PIC">
                <span class="text-danger">{{ $errors->first('PIC') }}</span>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">SIMPAN</button>
        </form>
    </div>
</div>

@endsection

<!-- Success Message -->
@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            confirmButtonText: 'OK'
        });
    </script>
@endif
