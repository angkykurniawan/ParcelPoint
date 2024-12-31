<?php

namespace App\Http\Controllers;

use App\Models\SuratPaket;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Kirim notifikasi WhatsApp menggunakan Fonnte API.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendNotification($id)
    {
        // Cari data Surat Paket berdasarkan ID
        $suratPaket = SuratPaket::with(['Pemilik', 'Kurir'])->find($id);

        // Validasi jika data tidak ditemukan
        if (!$suratPaket) {
            return redirect()->back()->with('error', 'Data Surat Paket tidak ditemukan.');
        }

        // Informasi yang akan dikirim melalui WhatsApp
        $message = "Halo, " . ($suratPaket->Pemilik->Nama ?? 'Pemilik') . "!\n\n" .
            "Paket Anda dengan detail berikut telah terdaftar:\n" .
            "Resi: " . $suratPaket->Resi . "\n" .
            "Kurir: " . ($suratPaket->Kurir->Ekspedisi ?? 'Tidak ada')."\n\n".
            "Silakan jemput" . $suratPaket->Jenis ." Anda di lokasi kami. \n\n Kunjungi : localhost:8000/$suratPaket->Resi untuk informasi lebih lanjut\nTerima kasih.";

        // Nomor WhatsApp tujuan
        $noHp = $suratPaket->NoHP;

        // Format nomor WhatsApp (hapus karakter non-digit)
        $noHpFormatted = preg_replace('/[^0-9]/', '', $noHp);

        // Kirim pesan menggunakan Fonnte API
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'target' => $noHpFormatted,
                'message' => $message,
                'schedule' => 0,
                'typing' => false,
                'delay' => '2',
                'countryCode' => '62', // Kode negara Indonesia
            ),
            CURLOPT_HTTPHEADER => array(
                'Authorization: CoXpGMHoZ7TAUS6hP3YH', // Ganti dengan token Fonnte Anda
            ),
        ));

        $response = curl_exec($curl);
        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
            curl_close($curl);
            return redirect()->back()->with('error', 'Gagal mengirim notifikasi: ' . $error_msg);
        }

        curl_close($curl);

        return redirect()->back()->with('success', 'Notifikasi berhasil dikirim.');
    }
}
