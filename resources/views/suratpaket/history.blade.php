@extends('Crovex/baseFile', ['title' => 'Riwayat Pengiriman'])

@section('content')
    <div class="card">
        <div class="card-body">
            <h3 class="text-primary" style="font-weight: bolder; text-align: center;">Riwayat Pengiriman {{ $suratPaket->Jenis }} Dengan Resi {{ $suratPaket->Resi }}</h3>

            <div>
                <ul class="list-group">
                    @foreach ($whatsappHistory as $whatsappItem)
                        <li class="list-group-item">
                            <center><span>{{ $whatsappItem->created_at }} - WhatsApp</center>
                            </span
                        </li>
                    @endforeach

                    @foreach ($emailHistory as $emailItem)
                        <li class="list-group-item">
                            <center><span>{{ $emailItem->created_at }} - {{ $emailItem->status }} - Email</center>
                            </span>
                        </li>
                    @endforeach
                </ul>
            </div>
            <center><a href="{{ url('/suratPaket') }}" class="btn btn-primary mt-3">Kembali ke Data Surat & Paket</a></center>
        </div>
    </div>
@endsection
