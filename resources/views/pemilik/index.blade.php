@extends('Crovex/baseFile', ['title' => 'Data Pemilik Surat Paket'])
@section('content')
    <div class="card">
        <div class="card-body">
            <h3 class="text-primary text-center font-weight-bold">Data Pemilik</h3>
            <center>
                <a href="/pemilik/create" class="btn btn-primary btn-sm">Tambah Data Pemilik</a>
            </center>
            <br>
            <table class="table table-striped">
                <thead>
                    <tr class="text-center">
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
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->NomorInduk }}</td>
                            <td>
                                @if ($item->Foto)
                                    <a href="{{ \Storage::url($item->Foto) }}" target="_blank">
                                        <img src="{{ \Storage::url($item->Foto) }}" width="50" height="100" alt="Foto Pemilik" />
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
                                <!-- Edit Button -->
                                <a href="/pemilik/{{ $item->id }}/edit"
                                   class="btn btn-warning btn-sm m-1"
                                   title="Edit Data">
                                    <i class="ti ti-pencil"></i>
                                </a>
                                <!-- Delete Button -->
                                <form action="/pemilik/{{ $item->id }}" method="POST" class="d-inline" id="delete-form-{{ $item->id }}" onsubmit="return confirmDelete({{ $item->id }})">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm"
                                            title="Hapus Data"
                                            onclick="confirmDelete({{ $item->id }})">
                                        <i class="ti ti-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $pemilik->links('pagination::bootstrap-4') !!}
        </div>
    </div>
@endsection

@push('scripts')
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
                text: 'Data ini tidak akan bisa dikembalikan setelah dihapus.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                focusCancel: true
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Dihapus!',
                        'Data telah dihapus.',
                        'success'
                    ).then(() => {
                        document.getElementById('delete-form-' + id).submit();
                    });
                } else {
                    Swal.fire(
                        'Dibatalkan',
                        'Data tidak dihapus.',
                        'info'
                    );
                }
            });
        }
    </script>
@endpush
