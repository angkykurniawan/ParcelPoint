@extends('Crovex/baseFile', ['title' => 'Data Surat Paket'])

@section('content')
    <div class="card">
        <div class="card-body">
            <h3 class="text-primary" style="font-weight: bolder; text-align: center;">Data Surat Paket {{ $models->first()->Pemilik->Nama }}</h3> <!-- Check if Pemilik is available -->

            <table class="table table-striped">
                <thead>
                    <tr style="text-align: center;">
                        <th width="1%">No</th>
                        <th>Foto Surat Paket</th>
                        <th>Waktu Antar</th>
                        <th>Kurir</th>
                        <th>Resi</th>
                        <th>Penjemput</th>
                        <th>Foto Serah Terima</th>
                        <th>Waktu Jemput</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($models as $item)
                        <tr style="text-align: center;">
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if ($item->Foto)
                                    <a href="{{ \Storage::url($item->Foto) }}" target="_blank">
                                        <img src="{{ \Storage::url($item->Foto) }}" width="150" height="100" />
                                    </a>
                                @else
                                    <span>No Image</span> <!-- If no image is available -->
                                @endif
                            </td>
                            <td>{{ $item->created_at }}</td>
                            <td>{{ $item->Kurir->Ekspedisi ?? 'Unknown' }}</td> <!-- Safe fallback if Kurir is null -->
                            <td>{{ $item->Resi }}</td>
                            <td>{{ $item->Penjemput }}</td>
                            <td>
                                @if ($item->FotoST)
                                    <a href="{{ \Storage::url($item->FotoST) }}" target="_blank">
                                        <img src="{{ \Storage::url($item->FotoST) }}" width="150" height="100" />
                                    </a>
                                @else
                                    <span>No Image</span> <!-- If no image is available -->
                                @endif
                            </td>
                            <td>{{ $item->WaktuJemput }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
