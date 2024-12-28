@extends('Crovex/baseFile', ['title' => 'Data Pemilik Surat Paket'])
@section('content')
<div class="card">
    <div class="card-body">
        <div class="row mb-3 mt-3">
            <div class="col-md-6">
                <a href="/pemilik/create" class="btn btn-primary btn-sm">Tambah Data Pemilik</a>
            </div>
        </div>
        <h3>Data Poli</h3>
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
                    <th>Foto</th>
                    <th>Jalan</th>
                    <th>Kecamatan</th>
                    <th>KabupatenKota</th>
                    <th>Provinsi</th>
                    <th>AKSI</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pemilik as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->NomorInduk }}</td>
                    <td>{{ $item->Nama }}</td>
                    <td>{{ $item->Umur }}</td>
                    <td>{{ $item->Pekerjaan }}</td>
                    <td>{{ $item->Whatsapp }}</td>
                    <td>{{ $item->Email }}</td>
                    <td>{{ $item->Foto }}</td>
                    <td>{{ $item->Jalan }}</td>
                    <td>{{ $item->Kecamatan }}</td>
                    <td>{{ $item->KabupatenKota }}</td>
                    <td>{{ $item->Provinsi }}</td>
                    <td>
                        <a href="/pemilik/{{ $item->id }}/edit" class="btn btn-warning btn-sm m1-2">Edit</a>
                        <form action="/pemilik/{{ $item->id }}" method="POST" class="d-inline">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger btn-sm ml-2"
                                onclick="return confirm('Yakin ingin menghapus data?')">Hapus</button>
                        </form>
                    </td>
                    <td></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {!! $pemilik->links() !!}
    </div>
</div>
@endsection
