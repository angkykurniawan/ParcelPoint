@extends('Crovex/baseFile', ['title' => 'Data Ruang Surat Paket'])

@section('content')
    <div class="card">
        <div class="card-body">
            <h3 class="text-primary" style="font-weight: bolder; text-align: center;">Data Ruang</h3>

            <!-- Form pencarian dan tombol tambah data di tengah -->
            <div class="d-flex justify-content-center align-items-center">
                <form action="/ruang" method="GET" class="d-flex">
                    <input type="text" name="search" value="{{ request()->get('search') }}" class="form-control w-100" placeholder="Cari berdasarkan Nama atau Lokasi" />
                    <button type="submit" class="btn btn-primary btn-sm ml-0">Cari</button> <!-- Mengurangi jarak antara tombol search dan tambah data -->
                </form>

                <a href="/ruang/create" class="btn btn-primary btn-sm ml-1">Tambah Data Ruang</a> <!-- Margin kiri kecil -->
            </div>
            <br>

            <table class="table table-striped">
                <thead>
                    <tr style="text-align: center;">
                        <th width="1%">No</th>
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
                                <div style="display: flex; flex-direction: column; align-items: center; gap: 10px;">
                                    <div style="display: flex; gap: 10px;">
                                        <a href="/ruang/{{ $item->id }}/edit" class="btn btn-warning btn-sm ti-pencil"></a>
                                        <form action="/ruang/{{ $item->id }}" method="POST" class="d-inline" id="delete-form-{{ $item->id }}" onsubmit="return confirmDelete({{ $item->id }})">
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
                {{ $ruang->appends(['search' => request()->get('search')])->links('pagination::bootstrap-4') }} <!-- Menampilkan pagination dengan Bootstrap 4 -->
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
