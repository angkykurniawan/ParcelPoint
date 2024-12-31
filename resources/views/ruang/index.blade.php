@extends('Crovex/baseFile', ['title' => 'Data Ruang Surat Paket'])
@section('content')
<div class="card">
    <div class="card-body">
        <div class="row mb-3 mt-3">
            <div class="col-md-6">
                <a href="/ruang/create" class="btn btn-primary btn-sm">Tambah Data Ruang</a>
            </div>
        </div>
        <h3>Data Ruang</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <center><th>No</th></center>
                    <center><th>Nama</th></center>
                    <center><th>Lantai</th></center>
                    <center><th>Lokasi</th></center>
                    <center><th>PIC</th></center>
                    <center><th>Aksi</th></center>
                </tr>
            </thead>
            <tbody>
                @foreach ($ruang as $item)
                <tr>
                    <center><td>{{ $loop->iteration }}</td></center>
                    <center><td>{{ $item->Nama }}</td></center>
                    <center><td>{{ $item->Lantai }}</td></center>
                    <center><td>{{ $item->Lokasi }}</td></center>
                    <center><td>{{ $item->PIC }}</td></center>
                    <td>
                        <a href="/ruang/{{ $item->id }}/edit" class="btn btn-warning btn-sm m-1 ti ti-pencil"></a>
                        <form action="/ruang/{{ $item->id }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm ml-2 ti ti-trash" onclick="return confirm('Yakin ingin menghapus data?')"></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {!! $ruang->links() !!}
    </div>
</div>
@endsection
