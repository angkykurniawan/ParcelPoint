@extends('Crovex/baseFile', ['title' => 'Data Security'])
@section('content')
<div class="card">
    <div class="card-body">
        <div class="row mb-3 mt-3">
            <div class="col-md-6">
                <a href="/security/create" class="btn btn-primary btn-sm">Tambah Data Security</a>
            </div>
        </div>
        <h3>Data Security</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>NoHP</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($security as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->NIP }}</td>
                    <td>
                        @if($item->Foto)
                            <a href="{{ \Storage::url($item->Foto) }}" target="blank">
                            <img src="{{  \Storage::url($item->Foto) }}" width="50" />
                        </a>
                        @endif
                        {{ $item->Nama }}
                    </td>
                    <td>{{ $item->NoHP }}</td>
                    <td>{{ $item->Email }}</td>
                    <td>
                        <a href="/security/{{ $item->id }}/edit" class="btn btn-warning btn-sm m-1 ti ti-pencil"></a>
                        <form action="/security/{{ $item->id }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm ml-2 ti ti-trash" onclick="return confirm('Yakin ingin menghapus data?')"></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {!! $security->links() !!}
    </div>
</div>
@endsection
