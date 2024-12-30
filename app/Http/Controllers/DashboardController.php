<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use App\Http\Requests\StoreDashboardRequest;
use App\Http\Requests\UpdateDashboardRequest;
use App\Models\SuratPaket;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil jumlah surat
        $jumlahSurat = SuratPaket::where('Jenis', 'Surat')->count();

        // Mengambil jumlah paket
        $jumlahPaket = SuratPaket::where('Jenis', 'Paket')->count();

        // Mengambil jumlah surat yang diterima hari ini
        $suratHariIni = SuratPaket::whereDate('created_at', today())->where('Jenis', 'Surat')->count();

        // Mengambil jumlah paket yang diterima hari ini
        $paketHariIni = SuratPaket::whereDate('created_at', today())->where('Jenis', 'Paket')->count();

        // Mengambil jumlah surat yang sudah dijemput hari ini
        $suratDijemputHariIni = SuratPaket::whereDate('WaktuJemput', today())
            ->where('Jenis', 'Surat')->count();

        // Mengambil jumlah paket yang sudah dijemput hari ini
        $paketDijemputHariIni = SuratPaket::whereDate('WaktuJemput', today())
            ->where('Jenis', 'Paket')->count();

        // Mengirim data ke view
        return view('dashboard.index', compact(
            'jumlahSurat',
            'jumlahPaket',
            'suratHariIni',
            'paketHariIni',
            'suratDijemputHariIni',
            'paketDijemputHariIni'
        ));
    }
}
