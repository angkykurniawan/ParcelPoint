@extends('Crovex/baseFile', ['title' => 'Detail Data Surat Paket'])
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">DATA SURAT PAKET DENGAN NOMOR RESI <strong>{{ strtoupper($suratPaket->Resi) }}</strong></div>
                <div class="card-body">
                    <h4>Data Pemilik</h4>
                    <table width="100%">
                        <tbody>
                            <tr>
                                <th width="15%">Nomor Induk</th>
                                <td> : {{ $suratPaket->Pemilik->NomorInduk }}</td>
                            </tr>
                            <tr>
                                <th>Nama</th>
                                <td> : {{ $suratPaket->Pemilik->Nama }}</td>
                            </tr>
                            <tr>
                                <th>Pekerjaan</th>
                                <td> : {{ $suratPaket->Pemilik->Pekerjaan }}</td>
                            </tr>
                            <tr>
                                <th>No HP</th>
                                <td> : {{ $suratPaket->Pemilik->Whatsapp }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td> : {{ $suratPaket->Pemilik->Email }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <hr>
                    <h4>Data Surat Paket Terbaru</h4>
                    <table width="100%">
                        <tbody>
                            <tr>
                                <th width="15%">Resi</th>
                                <td> : {{ $suratPaket->Resi }}</td>
                            </tr>
                            <tr>
                                <th>Jenis</th>
                                <td> : {{ $suratPaket->Jenis }}</td>
                            </tr>
                            <tr>
                                <th>No HP</th>
                                <td> : {{ $suratPaket->NoHP }}</td>
                            </tr>
                            <tr>
                                <th>Berat</th>
                                <td> : {{ $suratPaket->Berat }} Gram</td>
                            </tr>
                            <tr>
                                <th>Status Surat Paket</th>
                                <td> :
                                    @if ($suratPaket->status_daftar === 'DiterimaSecurity')
                                        <span style="color: white; background-color: blue; padding: 3px 10px; border-radius: 3px; display: inline-block;">
                                            {{ ucfirst($suratPaket->status_daftar) }}
                                        </span>
                                    @else
                                    <span style="color: white; background-color: orange; padding: 3px 10px; border-radius: 3px; display: inline-block;">
                                        {{ ucfirst($suratPaket->status_daftar) }}
                                    </span>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <hr>
                    <h4>Serah Terima Surat Paket</h4>
                    <form action="/suratPaket/{{ $suratPaket->id }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group mt-1 mb-3">
                            <label for="FotoST">Foto ST</label>
                            <input type="file" class="form-control @error('FotoST') is-invalid @enderror" id="FotoST" name="FotoST">
                            <span class="text-danger">{{ $errors->first('FotoST') }}</span>
                            <img src="{{ Storage::url($suratPaket->FotoST) }}" alt="Foto Serah Terima" class="img-thumbnail mt-2" style="width: 100px">
                        </div>
                        <div class="form-group mt-1 mb-3">
                            <label for="Penjemput">Penjemput</label>
                            <select class="form-control" name="Penjemput" id="Penjemput">
                                <option value="" disabled selected>Pilih Penjemput</option>
                                <option value="YBS" {{ old('YBS', $suratPaket->Penjemput ?? '') === 'YBS' ? 'selected' : '' }}>
                                    YBS
                                </option>
                                <option value="Teman" {{ old('', $suratPaket->Penjemput ?? '') === 'Teman' ? 'selected' : '' }}>
                                    Teman
                                </option>
                                <option value="Keluarga" {{ old('', $suratPaket->Penjemput ?? '') === 'Keluarga' ? 'selected' : '' }}>
                                    Keluarga
                                </option>
                            </select>
                            <span class="text-danger">{{ $errors->first('Penjemput') }}</span>
                        </div>
                        <div class="form-group mt-1 mb-3">
                            <label for="WaktuJemput">Waktu Jemput</label>
                            <input type="datetime-local" name="WaktuJemput" class="form-control @error('WaktuJemput') is-invalid @enderror"
                                value="{{ old('WaktuJemput', \Carbon\Carbon::parse($suratPaket->WaktuJemput)->format('Y-m-d\TH:i')) }}">
                            <span class="text-danger">{{ $errors->first('WaktuJemput') }}</span>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">SIMPAN</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
