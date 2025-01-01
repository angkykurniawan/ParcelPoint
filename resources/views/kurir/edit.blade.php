@extends('Crovex/baseFile', ['title' => 'Edit Data Kurir Surat Paket'])
@section('content')
    <div class="card">
        <div class="card-body">
            <h3 class="text-primary" style="font-weight: bolder; text-align: center;">Edit Data Kurir Surat Paket<center><b>{{ strtoupper($kurir->Ekspedisi) }}</b></center><br></h3>
            <form action="/kurir/{{ $kurir->id }}" method="POST" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="form-group mt-1 mb-3">
                    <label for="Ekspedisi" class="text-primary" style="font-weight: bolder;">Ekspedisi *</label>
                    <input type="text" class="form-control @error('Ekspedisi') is-invalid @enderror" id="Ekspedisi" name="Ekspedisi"
                        value="{{ old('Ekspedisi') ?? $kurir->Ekspedisi }}">
                    <span class="text-danger">{{ $errors->first('Ekspedisi') }}</span>
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
