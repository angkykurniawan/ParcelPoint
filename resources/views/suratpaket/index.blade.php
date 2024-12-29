@extends('Crovex/baseFile', ['title' => 'Data Surat Paket'])
@section('content')
<div class="card">
    <div class="card-body">
        <div class="row mb-3 mt-3">
            <div class="col-md-6">
                <a href="/suratPaket/create" class="btn btn-primary btn-sm">Tambah Data Surat Paket</a>
            </div>
        </div>
        <h3>Data Surat Paket</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pemilik</th>
                    <th>Jenis</th>
                    <th>Foto </th>
                    <th>NoHP</th>
                    <th>Resi</th>
                    <th>Berat (Gram)</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($suratPaket as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->Pemilik->Nama }}</td>
                    <td>{{ $item->Jenis }}</td>
                    <td>
                        @if($item->Foto)
                            <a href="{{ \Storage::url($item->Foto) }}" target="blank">
                            <img src="{{  \Storage::url($item->Foto) }}" width="50" />
                        </a>
                        @endif
                    </td>
                    <td>{{ $item->NoHP }}</td>
                    <td>{{ $item->Resi }}</td>
                    <td>{{ $item->Berat }}</td>
                    <td>
                        <a href="/suratPaket/{{ $item->id }}/edit" class="btn btn-warning btn-sm m-1 ti ti-pencil"></a>
                        <form action="/suratPaket/{{ $item->id }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm ml-2 ti ti-trash" onclick="return confirm('Yakin ingin menghapus data?')"></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {!! $suratPaket->links() !!}
    </div>
</div>
@endsection
