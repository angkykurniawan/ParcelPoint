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
                    <th>Foto Surat Paket </th>
                    <th>NoHP</th>
                    <th>Waktu Antar</th>
                    <th>Kurir</th>
                    <th>Resi</th>
                    <th>Penjemput</th>
                    <th>Foto Serah Terima</th>
                    <th>Waktu Jemput</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($suratPaket as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->Pemilik->Nama }}</td>
                    <td>
                        @if($item->Foto)
                            <a href="{{ \Storage::url($item->Foto) }}" target="blank">
                            <img src="{{  \Storage::url($item->Foto) }}" width="50" />
                        </a>
                        @endif
                    </td>
                    <td>{{ $item->NoHP }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>{{ $item->Kurir->Ekspedisi }}</td>
                    <td>{{ $item->Resi }}</td>
                    <td>{{ $item->Penjemput }}</td>
                    <td>
                        @if($item->FotoST)
                            <a href="{{ \Storage::url($item->FotoST) }}" target="blank">
                            <img src="{{  \Storage::url($item->FotoST) }}" width="50" />
                        </a>
                        @endif
                    </td>
                    <td>{{ $item->WaktuJemput }}</td>
                    <td>
                        <div style="display: flex; flex-direction: column; align-items: center; gap: 10px;">
                            <div style="display: flex; gap: 10px;">
                                <a href="/suratPaket/{{ $item->id }}" class="btn btn-primary btn-sm ti-info"></a>
                                <form action="/suratPaket/{{ $item->id }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm ti-trash" onclick="return confirm('Yakin ingin menghapus data?')"></button>
                                </form>
                            </div>
                            <div style="display: flex; gap: 10px;">
                                <!-- Notification WA -->
                                <a href="{{ route('notification.send', $item->id) }}" class="btn btn-success btn-sm ti-comment"></a>
                                <!-- Notification Email -->
                                <a href="{{ route('notification.sendEmail', $item->id) }}" class="btn btn-info btn-sm ti-email"></a>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {!! $suratPaket->links() !!}
    </div>
</div>
@endsection
