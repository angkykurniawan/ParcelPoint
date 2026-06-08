@extends('Crovex.baseFile', ['title' => 'Manajemen Akun Security'])

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card" style="border-radius: 16px; border: 1px solid #e1eeff; box-shadow: 0 10px 30px rgba(13, 110, 253, 0.03);">
            <div class="card-body p-4">

                <div class="text-center mb-5 mt-2">
                    <h3 class="text-primary mb-4" style="font-weight: 800; font-size: 1.6rem; letter-spacing: 0.5px;">
                        <i class="ti ti-shield me-2"></i>Daftar Akun Security
                    </h3>

                    <div style="max-width: 250px; margin: 0 auto;" class="px-3">
                        <a href="{{ route('admin.security.create') }}" class="btn btn-primary w-100 shadow-sm text-nowrap d-flex align-items-center justify-content-center" style="border-radius: 12px; background-color: #3475FE; border: none; padding: 12px 16px; font-weight: 600; height: 45px;">
                            <i class="ti ti-plus me-1" style="font-size: 14px;"></i> Tambah Akun Security
                        </a>
                    </div>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert" style="border-radius: 12px;">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-responsive" style="border-radius: 12px; border: 1px solid #edf2f7;">
                    <table class="table table-striped align-middle m-0">
                        <thead style="background-color: #f8faff;">
                            <tr class="text-center" style="border-bottom: 2px solid #e1eeff;">
                                <th width="5%" class="py-3 fw-bold text-secondary">No</th>
                                <th class="py-3 fw-bold text-secondary text-start">Nama Petugas</th>
                                <th class="py-3 fw-bold text-secondary text-start">Email / Username</th>
                                <th class="py-3 fw-bold text-secondary">Role</th>
                                <th width="12%" class="py-3 fw-bold text-secondary">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($securityUsers as $user)
                                <tr class="text-center" style="border-bottom: 1px solid #edf2f7;">
                                    <td class="py-3 fw-semibold text-dark">{{ $loop->iteration }}</td>
                                    <td class="py-3 text-start fw-bold text-dark">{{ $user->name }}</td>
                                    <td class="py-3 text-start text-secondary fw-medium">{{ $user->email }}</td>
                                    <td class="py-3">
                                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-1.5 small fw-bold">
                                            {{ strtoupper($user->role) }}
                                        </span>
                                    </td>
                                    <td class="py-3">
                                        <div class="d-flex justify-content-center gap-2">

                                            <a href="{{ route('admin.security.edit', $user->id) }}" class="btn btn-warning btn-sm d-flex align-items-center justify-content-center shadow-sm" title="Edit Akun" style="border-radius: 8px; width: 32px; height: 32px; padding: 0; background-color: #ffc107; border: none; color: #fff;">
                                                <i class="ti ti-edit fs-5"></i>
                                            </a>

                                            <form action="{{ route('admin.security.destroy', $user->id) }}" method="POST" class="m-0" id="delete-form-{{ $user->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" onclick="confirmDelete({{ $user->id }})" class="btn btn-danger btn-sm d-flex align-items-center justify-content-center shadow-sm" title="Hapus Akun" style="border-radius: 8px; width: 32px; height: 32px; padding: 0;">
                                                    <i class="ti ti-trash fs-6"></i>
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted fw-medium">
                                        <i class="ti ti-alert-circle fs-3 d-block mb-2"></i> Tidak ada akun security yang terdaftar.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $securityUsers->links() }}
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Yakin ingin menghapus akun?',
            text: "Petugas keamanan yang bersangkutan tidak akan bisa login kembali ke sistem!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
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
