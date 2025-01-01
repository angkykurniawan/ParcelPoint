@extends('Crovex/baseFile', ['title' => 'Kurir Surat Paket'])
@section('content')
<div class="card">
    <div class="card-body">
        <h3 class="text-primary" style="font-weight: bolder; text-align: center;">Data Kurir</h3>
        <center><a href="/kurir/create" class="btn btn-primary btn-sm">Tambah Data Kurir</a></center><br>
        <table class="table table-striped">
            <thead>
                <tr style="text-align: center;">
                    <th>No</th>
                    <th>Ekspedisi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kurir as $item)
                <tr style="text-align: center;">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->Ekspedisi }}</td>
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
