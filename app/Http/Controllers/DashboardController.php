<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use App\Http\Requests\StoreDashboardRequest;
use App\Http\Requests\UpdateDashboardRequest;
use App\Models\SuratPaket;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Jumlah Surat dan Paket
        $jumlahSurat = SuratPaket::where('Jenis', 'Surat')->count();
        $jumlahPaket = SuratPaket::where('Jenis', 'Paket')->count();

        // Surat dan Paket yang Diterima Hari Ini
        $suratHariIni = SuratPaket::where('Jenis', 'Surat')->whereDate('created_at', today())->count();
        $paketHariIni = SuratPaket::where('Jenis', 'Paket')->whereDate('created_at', today())->count();

        // Serah Terima Hari Ini
        $suratDijemputHariIni = SuratPaket::where('Jenis', 'Surat')->whereDate('WaktuJemput', today())->count();
        $paketDijemputHariIni = SuratPaket::where('Jenis', 'Paket')->whereDate('WaktuJemput', today())->count();

        // Total Serah Terima
        $totalSuratDijemput = SuratPaket::where('Jenis', 'Surat')->whereNotNull('WaktuJemput')->count();
        $totalPaketDijemput = SuratPaket::where('Jenis', 'Paket')->whereNotNull('WaktuJemput')->count();

        return view('dashboard.index', compact(
            'jumlahSurat', 'jumlahPaket',
            'suratHariIni', 'paketHariIni',
            'suratDijemputHariIni', 'paketDijemputHariIni',
            'totalSuratDijemput', 'totalPaketDijemput'
        ));
    }
}
