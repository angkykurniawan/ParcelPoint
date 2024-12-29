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
                    <th>No</th>
                    <th>Nomor Induk</th>
                    <th>Nama</th>
                    <th>Umur</th>
                    <th>Pekerjaan</th>
                    <th>Whatsapp</th>
                    <th>Email</th>
                    <th>Jenis Kelamin</th>
                    <th>Jalan</th>
                    <th>Kecamatan</th>
                    <th>KabupatenKota</th>
                    <th>Provinsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pemilik as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->NomorInduk }}</td>
                    <td>
                        @if($item->Foto)
                            <a href="{{ \Storage::url($item->Foto) }}" target="blank">
                                <img src="{{  \Storage::url($item->Foto) }}" width="50" />
                            </a>
                        @endif
                        {{ $item->Nama }}
                    </td>
                    <td>{{ $item->Umur }}</td>
                    <td>{{ $item->Pekerjaan }}</td>
                    <td>{{ $item->Whatsapp }}</td>
                    <td>{{ $item->Email }}</td>
                    <td>{{ $item->JenisKelamin }}</td>
                    <td>{{ $item->Jalan }}</td>
                    <td>{{ $item->Kecamatan }}</td>
                    <td>{{ $item->KabupatenKota }}</td>
                    <td>{{ $item->Provinsi }}</td>
                    <td>
                        <a href="/kurir/{{ $item->id }}/edit" class="btn btn-warning btn-sm m-1 ti ti-pencil"></a>
                        <form action="/kurir/{{ $item->id }}" method="POST" class="d-inline">
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
