@extends('Crovex/baseFile', ['title' => 'Data Surat Paket'])

@section('content')
    <div class="card">
        <div class="card-body">
            <h3 class="text-primary" style="font-weight: bolder; text-align: center;">Data Surat & Paket</h3>

            <!-- Form pencarian dan tombol tambah data di tengah -->
            <div class="d-flex justify-content-center align-items-center">

                <!-- Kolom Filter -->
                <form action="{{ url('/suratPaket') }}" method="GET" class="d-flex">
                    <input type="text" name="search" value="{{ request()->get('search') }}" hidden>

                    <!-- Filter Berdasarkan Tanggal -->
                    <input type="date" name="date" value="{{ request()->get('date') }}" class="form-control mx-1" placeholder="Tanggal" />
                    <button type="submit" class="btn btn-primary btn-sm ml-1">Filter</button>
                </form>



                <form action="{{ url('/suratPaket') }}" method="GET" class="d-flex">
                    <input type="text" name="search" value="{{ request()->get('search') }}" class="form-control w-100" placeholder="Cari berdasarkan nomor resi atau nama pemilik..." />
                    <button type="submit" class="btn btn-primary btn-sm ml-0">Cari</button>
                </form>

                <a href="/suratPaket/create" class="btn btn-primary btn-sm ml-1">Tambah Data Surat & Paket</a>
                <a href="/laporansurpa/create" class="btn btn-primary btn-sm ml-1">Buat Laporan Surat & Paket</a>
            </div>
            <br>

            <table class="table table-striped">
                <thead>
                    <tr style="text-align: center;">
                        <th width="1%">No</th>
                        <th>Pemilik</th>
                        <th>Foto Surat Paket</th>
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
                        <tr style="text-align: center;">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->Pemilik->Nama }}</td>
                            <td>
                                @if ($item->Foto)
                                    <a href="{{ \Storage::url($item->Foto) }}" target="_blank">
                                        <img src="{{ \Storage::url($item->Foto) }}" width="50" height="50" />
                                    </a>
                                @endif
                            </td>
                            <td>{{ $item->NoHP }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>{{ $item->Kurir->Ekspedisi }}</td>
                            <td>{{ $item->Resi }}</td>
                            <td>{{ $item->Penjemput }}</td>
                            <td>
                                @if ($item->FotoST)
                                    <a href="{{ \Storage::url($item->FotoST) }}" target="_blank">
                                        <img src="{{ \Storage::url($item->FotoST) }}" width="50" height="50" />
                                    </a>
                                @endif
                            </td>
                            <td>{{ $item->WaktuJemput }}</td>
                            <td>
                                <div style="display: flex; flex-direction: column; align-items: center; gap: 10px;">
                                    <div style="display: flex; gap: 10px;">
                                        <a href="/suratPaket/{{ $item->id }}" class="btn btn-primary btn-sm ti-info"></a>
                                        <form action="/suratPaket/{{ $item->id }}" method="POST" class="d-inline" id="delete-form-{{ $item->id }}" onsubmit="return confirmDelete({{ $item->id }})">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm ti-trash"></button>
                                        </form>
                                    </div>
                                    <div style="display: flex; gap: 10px;">
                                        <a href="{{ route('notification.send', $item->id) }}" class="btn btn-success btn-sm fab fa-whatsapp"></a>
                                        <a href="{{ route('notification.sendEmail', $item->id) }}" class="btn btn-info btn-sm ti-email"></a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination Links -->
            <div class="d-flex justify-content-center">
                {{ $suratPaket->appends(['search' => request()->get('search'), 'date' => request()->get('date'), 'month' => request()->get('month'), 'year' => request()->get('year')])->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>

    <script>
        @if (session('success'))
            Swal.fire({
                title: 'Berhasil!',
                icon: 'success',
                text: '{{ session('success') }}',
                showCloseButton: true
            });
        @elseif (session('error'))
            Swal.fire({
                title: 'Gagal!',
                icon: 'error',
                text: '{{ session('error') }}',
                showCloseButton: true
            });
        @endif
    </script>
@endsection
