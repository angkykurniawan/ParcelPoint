@extends('Crovex/baseFile', ['title' => 'Edit Data Ruang Surat Paket'])
@section('content')
    <div class="card">
        <div class="card-body">
            <h3 class="text-primary" style="font-weight: bolder; text-align: center;">Edit Data Ruang     <center><b>{{ strtoupper($ruang->Nama) }}</b></center><br></h3>
            <form action="/ruang/{{ $ruang->id }}" method="POST" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="form-group mt-1 mb-3">
                    <label for="Nama" class="text-primary" style="font-weight: bolder;">Nama *</label>
                    <input type="text" class="form-control @error('Nama') is-invalid @enderror" id="Nama" name="Nama"
                        value="{{ old('Nama') ?? $ruang->Nama }}">
                    <span class="text-danger">{{ $errors->first('Nama') }}</span>
                </div>
                <div class="form-group mt-1 mb-3">
                    <label for="Lantai" class="text-primary" style="font-weight: bolder;">Lantai</label>
                    <input type="text" class="form-control @error('Lantai') is-invalid @enderror" id="Lantai" name="Lantai"
                        value="{{ old('Lantai') ?? $ruang->Lantai }}">
                    <span class="text-danger">{{ $errors->first('Lantai') }}</span>
                </div>
                <div class="form-group mt-1 mb-3">
                    <label for="Lokasi" class="text-primary" style="font-weight: bolder;">Lokasi</label>
                    <input type="text" class="form-control @error('Lokasi') is-invalid @enderror" id="Lokasi" name="Lokasi"
                        value="{{ old('Lokasi') ?? $ruang->Lokasi }}">
                    <span class="text-danger">{{ $errors->first('Lokasi') }}</span>
                </div>
                <div class="form-group mt-1 mb-3">
                    <label for="PIC" class="text-primary" style="font-weight: bolder;">PIC</label>
                    <input type="text" class="form-control @error('PIC') is-invalid @enderror" id="PIC" name="PIC"
                        value="{{ old('PIC') ?? $ruang->PIC }}">
                    <span class="text-danger">{{ $errors->first('PIC') }}</span>
                </div>
                <center><button type="submit" class="btn btn-primary">UPDATE</button></center>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session("success") }}',
                confirmButtonText: 'OK'
            });
        </script>
    @elseif (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session("error") }}',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
@endsection
