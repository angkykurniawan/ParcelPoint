@extends('Crovex.baseFile', ['title' => 'Data Kurir Surat Paket'])

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card" style="border-radius: 16px; border: 1px solid #e1eeff; box-shadow: 0 10px 30px rgba(13, 110, 253, 0.03);">
            <div class="card-body p-4">

                <div class="text-center mb-5 mt-2">
                    <h3 class="text-primary mb-4" style="font-weight: 800; font-size: 1.6rem; letter-spacing: 0.5px;">
                        <i class="ti ti-map me-2"></i>Data Kurir Surat Paket
                    </h3>

                    <div style="max-width: 650px; margin: 0 auto;" class="px-3">
                        <div class="row g-2 align-items-center justify-content-center">

                            <div class="col-md-8 col-12">
                                <form action="/kurir" method="GET" class="d-flex w-100 m-0">
                                    <input type="text" name="search" value="{{ request()->get('search') }}" class="form-control" placeholder="Cari Ekspedisi..." style="border: 2px solid #cbdfff; border-radius: 12px 0 0 12px; padding: 10px 16px; border-right: none;">
                                    <button type="submit" class="btn btn-primary" style="border-radius: 0 12px 12px 0; background-color: #3475FE; border: 2px solid #3475FE; padding: 10px 20px; font-weight: 600;">Cari</button>
                                </form>
                            </div>

                            <div class="col-md-4 col-12">
                                <a href="/kurir/create" class="btn btn-primary w-100 shadow-sm text-nowrap d-flex align-items-center justify-content-center" style="border-radius: 12px; background-color: #3475FE; border: none; padding: 12px 16px; font-weight: 600; height: 45px;">
                                    <i class="ti ti-plus me-1" style="font-size: 14px;"></i> Tambah Kurir
                                </a>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="table-responsive" style="border-radius: 12px; border: 1px solid #edf2f7;">
                    <table class="table table-striped align-middle m-0">
                        <thead style="background-color: #f8faff;">
                            <tr class="text-center" style="border-bottom: 2px solid #e1eeff;">
                                <th width="5%" class="py-3 fw-bold text-secondary">No</th>
                                <th class="py-3 fw-bold text-secondary text-start">Ekspedisi</th>
                                <th width="15%" class="py-3 fw-bold text-secondary">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($kurir as $item)
                                <tr class="text-center" style="border-bottom: 1px solid #edf2f7;">
                                    <td class="py-3 fw-semibold text-dark">{{ $loop->iteration }}</td>
                                    <td class="py-3 text-start fw-bold text-dark">{{ $item->Ekspedisi }}</td>
                                    <td class="py-3">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="/kurir/{{ $item->id }}/edit" class="btn btn-warning btn-sm d-flex align-items-center justify-content-center shadow-sm" title="Edit Data" style="border-radius: 8px; width: 32px; height: 32px; padding: 0;">
                                                <i class="ti ti-pencil fs-6"></i>
                                            </a>
                                            <form action="/kurir/{{ $item->id }}" method="POST" class="d-inline m-0" id="delete-form-{{ $item->id }}">
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
                                    <td colspan="3" class="text-center py-5 text-muted fw-medium">
                                        <i class="ti ti-alert-circle fs-3 d-block mb-2"></i> Tidak ada data kurir yang ditemukan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $kurir->appends(['search' => request()->get('search')])->links('pagination::bootstrap-4') }}
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
            text: "Data yang dihapus tidak dapat dikembalikan!",
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
