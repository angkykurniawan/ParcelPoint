<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use App\Http\Requests\StoreDashboardRequest;
use App\Http\Requests\UpdateDashboardRequest;
use App\Models\suratPaket;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Jumlah Surat dan Paket
        $jumlahSurat = suratPaket::where('Jenis', 'Surat')->count();
        $jumlahPaket = suratPaket::where('Jenis', 'Paket')->count();

        // Surat dan Paket yang Diterima Hari Ini
        $suratHariIni = suratPaket::where('Jenis', 'Surat')->whereDate('created_at', today())->count();
        $paketHariIni = suratPaket::where('Jenis', 'Paket')->whereDate('created_at', today())->count();

        // Serah Terima Hari Ini
        $suratDijemputHariIni = suratPaket::where('Jenis', 'Surat')->whereDate('WaktuJemput', today())->count();
        $paketDijemputHariIni = suratPaket::where('Jenis', 'Paket')->whereDate('WaktuJemput', today())->count();

        // Total Serah Terima
        $totalSuratDijemput = suratPaket::where('Jenis', 'Surat')->whereNotNull('WaktuJemput')->count();
        $totalPaketDijemput = suratPaket::where('Jenis', 'Paket')->whereNotNull('WaktuJemput')->count();

        return view('dashboard.index', compact(
            'jumlahSurat', 'jumlahPaket',
            'suratHariIni', 'paketHariIni',
            'suratDijemputHariIni', 'paketDijemputHariIni',
            'totalSuratDijemput', 'totalPaketDijemput'
        ));
    }
}
