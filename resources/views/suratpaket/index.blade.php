@extends('Crovex/baseFile', ['title' => 'Data Surat Paket'])
@section('content')
    <div class="card">
        <div class="card-body">
            <h3 class="text-primary" style="font-weight: bolder; text-align: center;">Data Surat Paket</h3>
            <center><a href="/suratPaket/create" class="btn btn-primary btn-sm">Tambah Data Surat Paket</a></center><br>
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
                                    <a href="{{ \Storage::url($item->Foto) }}" target="blank">
                                        <img src="{{ \Storage::url($item->Foto) }}" width="150" height="100" />
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
                                    <a href="{{ \Storage::url($item->FotoST) }}" target="blank">
                                        <img src="{{ \Storage::url($item->FotoST) }}" width="150" height="100" />
                                    </a>
                                @endif
                            </td>
                            <td>{{ $item->WaktuJemput }}</td>
                            <td>
                                <div style="display: flex; flex-direction: column; align-items: center; gap: 10px;">
                                    <div style="display: flex; gap: 10px;">
                                        <a href="/suratPaket/{{ $item->id }}"
                                            class="btn btn-primary btn-sm ti-info"></a>
                                        <form action="/suratPaket/{{ $item->id }}" method="POST" class="d-inline" id="delete-form-{{ $item->id }}" onsubmit="return confirmDelete({{ $item->id }})">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm ti-trash"></button>
                                        </form>
                                    </div>
                                    <div style="display: flex; gap: 10px;">
                                        <!-- Notification WA -->
                                        <a href="{{ route('notification.send', $item->id) }}"
                                            class="btn btn-success btn-sm ti-comment"
                                            onclick="return sendWhatsAppNotification('{{ $item->NoHP }}')"></a>
                                        <!-- Notification Email -->
                                        <a href="{{ route('notification.sendEmail', $item->id) }}"
                                            class="btn btn-info btn-sm ti-email"
                                            onclick="return sendEmailNotification('{{ $item->Pemilik->Email }}')"></a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $suratPaket->links() }}
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

        // WhatsApp notification function
        function sendWhatsAppNotification(phoneNumber) {
            Swal.fire({
                icon: 'success',
                title: 'Notifikasi WhatsApp',
                text: 'Pesan berhasil dikirim ke nomor yang terdaftar: ' + phoneNumber,
                showCloseButton: true
            });
            return true; // Keep the link behavior intact
        }

        // Email notification function
        function sendEmailNotification(email) {
            Swal.fire({
                icon: 'success',
                title: 'Notifikasi Email',
                text: 'Pesan berhasil dikirim ke email yang terdaftar: ' + email,
                showCloseButton: true
            });
            return true; // Keep the link behavior intact
        }
    </script>
@endsection
