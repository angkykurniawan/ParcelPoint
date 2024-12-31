@extends('Crovex/baseFile', ['title' => 'Kurir Surat Paket'])
@section('content')
<div class="card">
    <div class="card-body">
        <div class="row mb-3 mt-3">
            <div class="col-md-6">
                <a href="/kurir/create" class="btn btn-primary btn-sm">Tambah Data Kurir</a>
            </div>
        </div>
        <h3>Data Kurir</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <center><th>No</th></center>
                    <center><th>Ekspedisi</th></center>
                    <center><th>Aksi</th></center>
                </tr>
            </thead>
            <tbody>
                @foreach ($kurir as $item)
                <tr>
                    <center><td>{{ $loop->iteration }}</td></center>
                    <center><td>{{ $item->Ekspedisi }}</td></center>
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
        {!! $kurir->links() !!}
    </div>
</div>
@endsection
