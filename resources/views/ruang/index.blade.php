@extends('Crovex/baseFile', ['title' => 'Data Ruang Surat Paket'])
@section('content')
<div class="card">
    <div class="card-body">
        <h3 class="text-primary" style="font-weight: bolder; text-align: center;">Data Ruang</h3>
        <center><a href="/ruang/create" class="btn btn-primary btn-sm">Tambah Data Ruang</a><br></center><br>
        <table class="table table-striped">
            <thead>
                <tr style="text-align: center;">
                    <th>No</th>
                    <th>Nama</th>
                    <th>Lantai</th>
                    <th>Lokasi</th>
                    <th>PIC</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ruang as $item)
                <tr style="text-align: center;">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->Nama }}</td>
                    <td>{{ $item->Lantai }}</td>
                    <td>{{ $item->Lokasi }}</td>
                    <td>{{ $item->PIC }}</td>
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
