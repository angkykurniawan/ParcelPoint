@extends('Crovex/baseFile', ['title' => 'Data Kurir Surat Paket'])

@section('content')
    <div class="card">
        <div class="card-body">
            <h3 class="text-primary" style="font-weight: bolder; text-align: center;">Data Kurir Surat Paket</h3>

            <!-- Form pencarian dan tombol tambah data di tengah -->
            <div class="d-flex justify-content-center align-items-center mb-3">
                <form action="/kurir" method="GET" class="d-flex">
                    <input type="text" name="search" value="{{ request()->get('search') }}" class="form-control" placeholder="Cari berdasarkan Ekspedisi">
                    <button type="submit" class="btn btn-primary btn-sm ml-1">Cari</button>
                </form>
                <a href="/kurir/create" class="btn btn-primary btn-sm ml-2">Tambah Data Kurir</a>
            </div>

            <table class="table table-striped">
                <thead>
                    <tr style="text-align: center;">
                        <th width="1%">No</th>
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
                                <div style="display: flex; flex-direction: column; align-items: center; gap: 10px;">
                                    <div style="display: flex; gap: 10px;">
                                        <a href="/kurir/{{ $item->id }}/edit" class="btn btn-warning btn-sm ti-pencil" title="Edit Data"></a>
                                        <form action="/kurir/{{ $item->id }}" method="POST" class="d-inline" id="delete-form-{{ $item->id }}" onsubmit="return confirmDelete({{ $item->id }})">
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
                {{ $kurir->appends(['search' => request()->get('search')])->links('pagination::bootstrap-4') }}
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
        // Function to confirm deletion of data
        function confirmDelete(id) {
            Swal.fire({
                title: 'Yakin ingin menghapus data?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Cancel', // Ganti teks tombol Batal menjadi Cancel
                focusCancel: true, // Fokus pada tombol Cancel
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika tombol "Ya, Hapus!" dipilih
                    Swal.fire(
                        'Dihapus!',
                        'Data telah dihapus.',
                        'success'
                    ).then(() => {
                        // Submit form untuk menghapus data setelah konfirmasi
                        document.getElementById('delete-form-' + id).submit();
                    });
                } else {
                    // Jika tombol Cancel yang dipilih, tidak ada tindakan penghapusan
                    Swal.fire(
                        'Dibatalkan',
                        'Data tidak dihapus.',
                        'info'
                    );
                }
            });
            return false; // Prevent immediate form submission
        }
    </script>
@endsection
