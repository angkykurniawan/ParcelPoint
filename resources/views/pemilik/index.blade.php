@extends('Crovex/baseFile', ['title' => 'Data Pemilik Surat Paket'])
@section('content')
    <div class="card">
        <div class="card-body">
            <h3 class="text-primary" style="font-weight: bolder; text-align: center;">Data Pemilik</h3>
            <center><a href="/pemilik/create" class="btn btn-primary btn-sm">Tambah Data Pemilik</a></center><br>
            <table class="table table-striped">
                <thead>
                    <tr style="text-align: center;">
                        <th>No</th>
                        <th>Nomor Induk</th>
                        <th>Nama</th>
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
                                    <a href="{{ \Storage::url($item->Foto) }}" target="blank">
                                        <img src="{{ \Storage::url($item->Foto) }}" width="50" height="100" />
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
                                <a href="/pemilik/{{ $item->id }}/edit"
                                    class="btn btn-warning btn-sm m-1 ti ti-pencil"></a>
                                <form action="/pemilik/{{ $item->id }}" method="POST" class="d-inline"
                                    id="delete-form-{{ $item->id }}"
                                    onsubmit="return confirmDelete({{ $item->id }})">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm ti-trash"></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $pemilik->links() !!}
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
