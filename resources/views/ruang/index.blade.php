@extends('Crovex/baseFile', ['title' => 'Data Ruang Surat Paket'])
@section('content')
<div class="card">
    <div class="card-body">
        <h3 class="text-primary" style="font-weight: bolder; text-align: center;">Data Ruang</h3>
        <center><a href="/ruang/create" class="btn btn-primary btn-sm">Tambah Data Ruang</a><br></center><br>
        <table class="table table-striped">
            <thead>
                <tr style="text-align: center;">
                    <th>No</th>
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
                        <a href="/ruang/{{ $item->id }}/edit" class="btn btn-warning btn-sm m-1 ti ti-pencil"></a>
                        <form action="/ruang/{{ $item->id }}" method="POST" class="d-inline" id="delete-form-{{ $item->id }}" onsubmit="return confirmDelete({{ $item->id }})">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm ti-trash"></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {!! $ruang->links() !!}
    </div>
</div>
@endsection

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
