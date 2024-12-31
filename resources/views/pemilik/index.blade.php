@extends('Crovex/baseFile', ['title' => 'Data Pemilik Surat Paket'])
@section('content')
<div class="card">
    <div class="card-body">
        <div class="row mb-3 mt-3">
            <div class="col-md-6">
                <a href="/pemilik/create" class="btn btn-primary btn-sm">Tambah Data Pemilik</a>
            </div>
        </div>
        <h3>Data Pemilik</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <center><th>No</th></center>
                    <center><th>Nomor Induk</th></center>
                    <center><th>Nama</th></center>
                    <center><th>Umur</th></center>
                    <center><th>Pekerjaan</th></center>
                    <center><th>Whatsapp</th></center>
                    <center><th>Email</th></center>
                    <center><th>Jenis Kelamin</th></center>
                    <center><th>Jalan</th></center>
                    <center><th>Kecamatan</th></center>
                    <center><th>KabupatenKota</th></center>
                    <center><th>Provinsi</th></center>
                    <center><th>Aksi</th></center>
                </tr>
            </thead>
            <tbody>
                @foreach ($pemilik as $item)
                <tr>
                    <center><td>{{ $loop->iteration }}</td></center>
                    <center><td>{{ $item->NomorInduk }}</td></center>
                    <center>
                        <td>
                            @if($item->Foto)
                                <a href="{{ \Storage::url($item->Foto) }}" target="blank">
                                    <img src="{{  \Storage::url($item->Foto) }}" width="50" />
                                </a>
                            @endif
                            {{ $item->Nama }}
                        </td>
                    </center>
                    <center><td>{{ $item->Umur }}</td></center>
                    <center><td>{{ $item->Pekerjaan }}</td></center>
                    <center><td>{{ $item->Whatsapp }}</td></center>
                    <center><td>{{ $item->Email }}</td></center>
                    <center><td>{{ $item->JenisKelamin }}</td></center>
                    <center><td>{{ $item->Jalan }}</td></center>
                    <center><td>{{ $item->Kecamatan }}</td></center>
                    <center><td>{{ $item->KabupatenKota }}</td></center>
                    <center><td>{{ $item->Provinsi }}</td></center>
                    <td>
                        <a href="/pemilik/{{ $item->id }}/edit" class="btn btn-warning btn-sm m-1 ti ti-pencil"></a>
                        <form action="/pemilik/{{ $item->id }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm ml-2 ti ti-trash" onclick="return confirm('Yakin ingin menghapus data?')"></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {!! $pemilik->links() !!}
    </div>
</div>
@endsection
