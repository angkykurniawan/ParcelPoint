@extends('dashboardLayout', ['title' => 'Riwayat Pengiriman'])

@section('content')
<div class="row">
    <div class="col-12 max-w-lg mx-auto">
        <div class="card" style="border-radius: 16px; border: 1px solid #e1eeff; box-shadow: 0 10px 30px rgba(13, 110, 253, 0.03);">
            <div class="card-body p-4">

                <div class="text-center p-3 mb-4 rounded-3 text-white" style="background: linear-gradient(135deg, #0d6efd, #0a58ca);">
                    <h5 class="m-0" style="font-weight: 800; font-size: 1.15rem; letter-spacing: 0.5px;">
                        <i class="ti ti-time me-2"></i>Riwayat Pengiriman Notifikasi
                    </h5>
                    <span class="badge bg-white bg-opacity-20 mt-2 px-3 py-1.5 font-monospace rounded-pill">
                        {{ $suratPaket->Jenis }} | Resi: {{ $suratPaket->Resi }}
                    </span>
                </div>

                <div class="mb-4">
                    <ul class="list-group shadow-sm" style="border-radius: 12px; overflow: hidden; border: 1px solid #edf2f7;">

                        {{-- Log WhatsApp --}}
                        @forelse ($whatsappHistory as $whatsappItem)
                            <li class="list-group-item d-flex justify-content-between align-items-center py-3" style="border-left: 4px solid #25D366;">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; background-color: rgba(37, 211, 102, 0.1); color: #25D366;">
                                        <i class="ti ti-brand-whatsapp fs-5"></i>
                                    </div>
                                    <div>
                                        <span class="d-block fw-bold text-dark small">Notifikasi Terkirim</span>
                                        <span class="text-muted font-monospace text-xs" style="font-size: 0.75rem;">{{ $whatsappItem->created_at }}</span>
                                    </div>
                                </div>
                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill fw-bold small px-2.5 py-1">WhatsApp</span>
                            </li>
                        @empty
                            {{-- Digabung dengan loop email jika dua-duanya kosong --}}
                        @endforelse

                        {{-- Log Email --}}
                        @forelse ($emailHistory as $emailItem)
                            <li class="list-group-item d-flex justify-content-between align-items-center py-3" style="border-left: 4px solid #3475FE;">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; background-color: rgba(52, 117, 254, 0.1); color: #3475FE;">
                                        <i class="ti ti-mail fs-5"></i>
                                    </div>
                                    <div>
                                        <span class="d-block fw-bold text-dark small">Status: {{ $emailItem->status ?? 'Sent' }}</span>
                                        <span class="text-muted font-monospace text-xs" style="font-size: 0.75rem;">{{ $emailItem->created_at }}</span>
                                    </div>
                                </div>
                                <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill fw-bold small px-2.5 py-1">Email</span>
                            </li>
                        @empty
                            @if($whatsappHistory->isEmpty())
                                <li class="list-group-item text-center py-4 text-muted fw-medium">
                                    <i class="ti ti-alert-circle fs-3 d-block mb-1"></i> Belum ada riwayat pengiriman notifikasi.
                                </li>
                            @endif
                        @endforelse

                    </ul>
                </div>

                <div class="text-center">
                    <a href="{{ url('/suratPaket') }}" class="btn btn-outline-secondary w-100" style="border-radius: 12px; padding: 12px; font-weight: bold; border: 2px solid #cbdfff; color: #475569;">
                        <i class="ti ti-arrow-left me-1"></i> Kembali ke Data Surat & Paket
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
