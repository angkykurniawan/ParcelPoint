@extends('Crovex/baseFile', ['title' => 'Data Pemilik Surat Paket'])

@section('content')
    <div class="card">
        <div class="card-body">
            <h3 class="text-primary" style="font-weight: bolder; text-align: center;">Data Pemilik Surat Paket</h3>

            <!-- Form pencarian dan tombol tambah data di tengah -->
            <div class="d-flex justify-content-center align-items-center">
                <form action="/pemilik" method="GET" class="d-flex">
                    <input type="text" name="search" value="{{ request()->get('search') }}" class="form-control w-100" placeholder="Cari berdasarkan Nama" />
                    <button type="submit" class="btn btn-primary btn-sm ml-0">Cari</button> <!-- Mengurangi jarak antara tombol search dan tambah data -->
                </form>

                <a href="/pemilik/create" class="btn btn-primary btn-sm ml-1">Tambah Data Pemilik</a> <!-- Margin kiri kecil -->
            </div>
            <br>

            <table class="table table-striped">
                <thead>
                    <tr style="text-align: center;">
                        <th width="1%">No</th>
                        <th>Nomor Induk</th>
                        <th>Foto & Nama</th>
                        <th>Umur</th>
                        <th>Pekerjaan</th>
                        <th>Whatsapp</th>
                        <th>Email</th>
                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pemilik as $item)
                        <tr style="text-align: center;">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->NomorInduk }}</td>
                            <td>
                                @if ($item->Foto)
                                    <a href="{{ \Storage::url($item->Foto) }}" target="_blank">
                                        <img src="{{ \Storage::url($item->Foto) }}" width="50" height="100" alt="Foto Pemilik">
                                    </a>
                                @endif
                                {{ $item->Nama }}
                            </td>
                            <td>{{ $item->Umur }}</td>
                            <td>{{ $item->Pekerjaan }}</td>
                            <td>{{ $item->Whatsapp }}</td>
                            <td>{{ $item->Email }}</td>
                            <td>{{ $item->JenisKelamin }}</td>
                            <td>{{ $item->Alamat }}</td>
                            <td>
                                <div style="display: flex; flex-direction: column; align-items: center; gap: 10px;">
                                    <div style="display: flex; gap: 10px;">
                                        <a href="/pemilik/{{ $item->id }}/edit" class="btn btn-warning btn-sm ti-pencil"></a>
                                        <form action="/pemilik/{{ $item->id }}" method="POST" class="d-inline" id="delete-form-{{ $item->id }}" onsubmit="return confirmDelete({{ $item->id }})">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm ti-trash"></button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination Links -->
            <div class="d-flex justify-content-center">
                {{ $pemilik->appends(['search' => request()->get('search')])->links('pagination::bootstrap-4') }} <!-- Menampilkan pagination dengan Bootstrap 4 -->
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
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
                showCloseButton: true
            });
        @endif
    </script>
@endsection
