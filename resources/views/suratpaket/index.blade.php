@extends('Crovex.baseFile', ['title' => 'Data Surat Paket'])

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card" style="border-radius: 16px; border: 1px solid #e1eeff; box-shadow: 0 10px 30px rgba(13, 110, 253, 0.03);">
            <div class="card-body p-4">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="text-primary m-0" style="font-weight: 800;">
                        <i class="ti ti-package me-2"></i>Data Surat & Paket
                    </h3>
                </div>

                <div class="bg-light p-3 mb-4 rounded-3 border d-flex flex-column flex-xl-row justify-content-between align-items-stretch align-items-xl-center gap-3">

                    <div class="d-flex flex-column flex-md-row gap-2 flex-grow-1">
                        <form action="{{ url('/suratPaket') }}" method="GET" class="d-flex flex-grow-1 flex-md-grow-0">
                            <input type="hidden" name="search" value="{{ request()->get('search') }}">
                            <input type="date" name="date" value="{{ request()->get('date') }}" class="form-control me-2" style="border: 2px solid #cbdfff; border-radius: 12px; max-width: 180px;" />
                            <button type="submit" class="btn btn-primary" style="border-radius: 12px; background-color: #3475FE; border: none; font-weight: 600; padding: 0 16px;">
                                Filter
                            </button>
                        </form>

                        <form action="{{ url('/suratPaket') }}" method="GET" class="d-flex flex-grow-1">
                            <input type="hidden" name="date" value="{{ request()->get('date') }}">
                            <input type="text" name="search" value="{{ request()->get('search') }}" class="form-control me-2" placeholder="Cari nomor resi atau nama pemilik..." style="border: 2px solid #cbdfff; border-radius: 12px; padding: 8px 16px;">
                            <button type="submit" class="btn btn-primary" style="border-radius: 12px; background-color: #3475FE; border: none; font-weight: 600; padding: 0 16px;">
                                Cari
                            </button>
                        </form>
                    </div>

                    <div class="d-flex flex-column flex-sm-row gap-2 text-nowrap">
                        <a href="/suratPaket/create" class="btn btn-primary shadow-sm" style="border-radius: 12px; background-color: #3475FE; border: none; padding: 10px 16px; font-weight: 600;">
                            <i class="ti ti-plus me-1"></i> Tambah Data
                        </a>
                        <a href="/laporansurpa" class="btn btn-outline-primary" style="border-radius: 12px; border: 2px solid #cbdfff; font-weight: 600; padding: 10px 16px; color: #3475FE; background-color: white;">
                            <i class="ti ti-printer me-1"></i> Buat Laporan
                        </a>
                    </div>
                </div>

                <div class="table-responsive" style="border-radius: 12px; border: 1px solid #edf2f7;">
                    <table class="table table-striped align-middle m-0">
                        <thead style="background-color: #f8faff;">
                            <tr class="text-center" style="border-bottom: 2px solid #e1eeff;">
                                <th width="1%" class="py-3 fw-bold text-secondary">No</th>
                                <th class="py-3 fw-bold text-secondary text-start">Pemilik</th>
                                <th class="py-3 fw-bold text-secondary">Foto Paket</th>
                                <th class="py-3 fw-bold text-secondary">No HP</th>
                                <th class="py-3 fw-bold text-secondary">Waktu Antar</th>
                                <th class="py-3 fw-bold text-secondary">Kurir</th>
                                <th class="py-3 fw-bold text-secondary text-start">Resi</th>
                                <th class="py-3 fw-bold text-secondary">Penjemput</th>
                                <th class="py-3 fw-bold text-secondary">Foto Serah Terima</th>
                                <th class="py-3 fw-bold text-secondary">Waktu Jemput</th>
                                <th width="12%" class="py-3 fw-bold text-secondary">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($suratPaket as $item)
                                <tr class="text-center" style="border-bottom: 1px solid #edf2f7;">
                                    <td class="py-3 fw-semibold text-dark">{{ $loop->iteration }}</td>
                                    <td class="py-3 text-start fw-bold text-dark">{{ $item->Pemilik->Nama ?? 'Unknown' }}</td>
                                    <td class="py-3">
                                        @if ($item->Foto)
                                            <a href="{{ \Storage::url($item->Foto) }}" target="_blank" class="d-inline-block">
                                                <img src="{{ \Storage::url($item->Foto) }}" class="img-thumbnail" style="width: 60px; height: 45px; object-fit: cover; border-radius: 6px;" />
                                            </a>
                                        @else
                                            <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill px-2 py-1 small">No File</span>
                                        @endif
                                    </td>
                                    <td class="py-3 font-monospace small fw-semibold text-dark">{{ $item->NoHP }}</td>
                                    <td class="py-3 text-muted small fw-medium">{{ $item->created_at }}</td>
                                    <td class="py-3 fw-semibold text-secondary">{{ $item->Kurir->Ekspedisi ?? 'Unknown' }}</td>
                                    <td class="py-3 text-start font-monospace text-primary fw-bold small">{{ $item->Resi }}</td>
                                    <td class="py-3 fw-medium text-dark">{{ $item->Penjemput ?? '-' }}</td>
                                    <td class="py-3">
                                        @if ($item->FotoST)
                                            <a href="{{ \Storage::url($item->FotoST) }}" target="_blank" class="d-inline-block">
                                                <img src="{{ \Storage::url($item->FotoST) }}" class="img-thumbnail" style="width: 60px; height: 45px; object-fit: cover; border-radius: 6px;" />
                                            </a>
                                        @else
                                            <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill px-2 py-1 small">Belum Diambil</span>
                                        @endif
                                    </td>
                                    <td class="py-3 text-muted small fw-medium">{{ $item->WaktuJemput ?? '-' }}</td>
                                    <td class="py-3">
                                        <div class="d-flex justify-content-center gap-1 flex-wrap" style="max-width: 150px; margin: 0 auto;">
                                            <a href="/suratPaket/{{ $item->id }}" class="btn btn-primary btn-sm d-flex align-items-center justify-content-center shadow-sm" title="Detail Data" style="border-radius: 8px; width: 30px; height: 30px; padding: 0; background-color: #3475FE; border: none;">
                                                <i class="ti ti-info fs-6"></i>
                                            </a>
                                            <a href="{{ route('suratPaket.history', $item->id) }}" class="btn btn-warning btn-sm d-flex align-items-center justify-content-center shadow-sm text-white" title="Riwayat Notifikasi" style="border-radius: 8px; width: 30px; height: 30px; padding: 0; background-color: #ffb822; border: none;">
                                                <i class="ti ti-time fs-6"></i>
                                            </a>
                                            <a href="{{ route('notification.send', $item->id) }}" class="btn btn-success btn-sm d-flex align-items-center justify-content-center shadow-sm" title="Kirim WhatsApp" style="border-radius: 8px; width: 30px; height: 30px; padding: 0; background-color: #25D366; border: none;">
                                                <i class="fab fa-whatsapp fs-6"></i>
                                            </a>
                                            <a href="{{ route('notification.sendEmail', $item->id) }}" class="btn btn-info btn-sm d-flex align-items-center justify-content-center shadow-sm text-white" title="Kirim Email" style="border-radius: 8px; width: 30px; height: 30px; padding: 0; background-color: #06b6d4; border: none;">
                                                <i class="ti ti-email fs-6"></i>
                                            </a>
                                            <form action="/suratPaket/{{ $item->id }}" method="POST" class="d-inline m-0" id="delete-form-{{ $item->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" onclick="confirmDelete({{ $item->id }})" class="btn btn-danger btn-sm d-flex align-items-center justify-content-center shadow-sm" title="Hapus Data" style="border-radius: 8px; width: 30px; height: 30px; padding: 0;">
                                                    <i class="ti ti-trash fs-6"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="11" class="text-center py-5 text-muted fw-medium">
                                        <i class="ti ti-alert-circle fs-3 d-block mb-2"></i> Tidak ada data surat atau paket yang ditemukan.
                                    </td>
                                endtr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $suratPaket->appends(['search' => request()->get('search'), 'date' => request()->get('date')])->links('pagination::bootstrap-4') }}
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    @if (session('success'))
        Swal.fire({
            title: 'Berhasil!',
            icon: 'success',
            text: '{{ session('success') }}',
            confirmButtonColor: '#3475FE'
        });
    @elseif (session('error'))
        Swal.fire({
            title: 'Gagal!',
            icon: 'error',
            text: '{{ session('error') }}',
            confirmButtonColor: '#3475FE'
        });
    @endif

    function confirmDelete(id) {
        Swal.fire({
            title: 'Yakin ingin menghapus data?',
            text: "Data surat & paket yang dihapus tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3475FE',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>
@endsection
