@extends('Crovex.baseFile', ['title' => 'Data Ruang Surat Paket'])

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card" style="border-radius: 16px; border: 1px solid #e1eeff; box-shadow: 0 10px 30px rgba(13, 110, 253, 0.03);">
            <div class="card-body p-4">

                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 mb-4">
                    <h3 class="text-primary m-0" style="font-weight: 800;"><i class="ti ti-folder me-2"></i>Data Ruang</h3>

                    <div class="d-flex flex-column flex-sm-row gap-2 w-100 w-md-auto align-items-center">
                        <form action="/ruang" method="GET" class="d-flex w-100 w-sm-auto">
                            <input type="text" name="search" value="{{ request()->get('search') }}" class="form-control me-2" placeholder="Cari Nama atau Lokasi..." style="border: 2px solid #cbdfff; border-radius: 12px; padding: 8px 16px;">
                            <button type="submit" class="btn btn-primary" style="border-radius: 12px; background-color: #3475FE; border: none; padding: 8px 16px; font-weight: 600;">Cari</button>
                        </form>
                        <a href="/ruang/create" class="btn btn-primary w-100 w-sm-auto shadow-sm text-nowrap" style="border-radius: 12px; background-color: #3475FE; border: none; padding: 10px 16px; font-weight: 600;">
                            <i class="ti ti-plus me-1"></i> Tambah Ruang
                        </a>
                    </div>
                </div>

                <div class="table-responsive" style="border-radius: 12px; border: 1px solid #edf2f7;">
                    <table class="table table-striped align-middle m-0">
                        <thead style="background-color: #f8faff;">
                            <tr class="text-center" style="border-bottom: 2px solid #e1eeff;">
                                <th width="5%" class="py-3 fw-bold text-secondary">No</th>
                                <th class="py-3 fw-bold text-secondary text-start">Nama Ruang</th>
                                <th class="py-3 fw-bold text-secondary">Lantai</th>
                                <th class="py-3 fw-bold text-secondary text-start">Lokasi</th>
                                <th class="py-3 fw-bold text-secondary text-start">PIC</th>
                                <th width="12%" class="py-3 fw-bold text-secondary">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($ruang as $item)
                                <tr class="text-center" style="border-bottom: 1px solid #edf2f7;">
                                    <td class="py-3 fw-semibold text-dark">{{ $loop->iteration }}</td>
                                    <td class="py-3 text-start fw-bold text-dark">{{ $item->Nama }}</td>
                                    <td class="py-3 text-muted fw-bold">
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-10 px-2.5 py-1.5 rounded-3 small">
                                            Lantai {{ $item->Lantai ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="py-3 text-start fw-medium text-secondary">{{ $item->Lokasi ?? '-' }}</td>
                                    <td class="py-3 text-start fw-semibold text-dark">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="ti ti-user text-muted"></i>
                                            <span>{{ $item->PIC ?? '-' }}</span>
                                        </div>
                                    </td>
                                    <td class="py-3">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="/ruang/{{ $item->id }}/edit" class="btn btn-warning btn-sm d-flex align-items-center justify-content-center shadow-sm" title="Edit Data" style="border-radius: 8px; width: 32px; height: 32px; padding: 0;">
                                                <i class="ti ti-pencil fs-6"></i>
                                            </a>
                                            <form action="/ruang/{{ $item->id }}" method="POST" class="d-inline m-0" id="delete-form-{{ $item->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" onclick="confirmDelete({{ $item->id }})" class="btn btn-danger btn-sm d-flex align-items-center justify-content-center shadow-sm" title="Hapus Data" style="border-radius: 8px; width: 32px; height: 32px; padding: 0;">
                                                    <i class="ti ti-trash fs-6"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted fw-medium">
                                        <i class="ti ti-alert-circle fs-3 d-block mb-2"></i> Tidak ada data ruang yang ditemukan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $ruang->appends(['search' => request()->get('search')])->links('pagination::bootstrap-4') }}
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
            icon: 'error',
            title: 'Oops...',
            text: '{{ session('error') }}',
            confirmButtonColor: '#3475FE'
        });
    @endif

    function confirmDelete(id) {
        Swal.fire({
            title: 'Yakin ingin menghapus data?',
            text: "Data ruang yang dihapus tidak dapat dikembalikan!",
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

```
