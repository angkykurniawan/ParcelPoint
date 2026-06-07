@extends('dashboardLayout', ['title' => 'Manajemen Akun Security'])

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card" style="border-radius: 16px; border: 1px solid #e1eeff; box-shadow: 0 10px 30px rgba(13, 110, 253, 0.03);">
            <div class="card-body p-4">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="text-primary m-0" style="font-weight: 800;"><i class="ti ti-shield me-2"></i>Daftar Akun Security</h3>
                    <a href="{{ route('admin.security.create') }}" class="btn btn-primary" style="border-radius: 12px; background-color: #3475FE; border: none; padding: 10px 16px; font-weight: 600;">
                        <i class="ti ti-plus me-1"></i> Tambah Akun Security
                    </a>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 12px;">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-responsive" style="border-radius: 12px; border: 1px solid #edf2f7;">
                    <table class="table table-striped align-middle m-0">
                        <thead style="background-color: #f8faff;">
                            <tr class="text-center">
                                <th width="5%" class="py-3 text-secondary">No</th>
                                <th class="py-3 text-secondary text-start">Nama Petugas</th>
                                <th class="py-3 text-secondary text-start">Email / Username</th>
                                <th class="py-3 text-secondary">Role</th>
                                <th width="10%" class="py-3 text-secondary">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($securityUsers as $user)
                                <tr class="text-center">
                                    <td class="py-3 fw-semibold">{{ $loop->iteration }}</td>
                                    <td class="py-3 text-start fw-bold text-dark">{{ $user->name }}</td>
                                    <td class="py-3 text-start text-secondary">{{ $user->email }}</td>
                                    <td class="py-3">
                                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-1.5 small fw-bold">
                                            {{ strtoupper($user->role) }}
                                        </span>
                                    </td>
                                    <td class="py-3">
                                        <form action="{{ route('admin.security.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun security ini?')" class="m-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm d-flex align-items-center justify-content-center mx-auto" style="border-radius: 8px; width: 32px; height: 32px; padding: 0;">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">
                                        Tidak ada akun security yang terdaftar.
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
@endsection
