<?php

namespace App\Http\Controllers;

use App\Mail\NotifMail;
use App\Models\suratPaket;
use App\Models\EmailHistory;
use Illuminate\Http\Request;
use App\Models\WhatsappHistory;
use Illuminate\Support\Facades\Mail;

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
        $suratPaket = suratPaket::with(['Pemilik', 'Kurir'])->find($id);

        // Validasi jika data tidak ditemukan
        if (!$suratPaket) {
            return redirect()->back()->with('error', 'Data Surat Paket tidak ditemukan.');
        }

        // Informasi yang akan dikirim melalui WhatsApp
        $message = "Halo, " . ($suratPaket->Pemilik->Nama ?? 'Pemilik') . "!\n\n" .
            "Kami dari security Politeknik Caltex Riau ingin memberitahukan bahwa " .
            $suratPaket->Jenis . " Anda dengan detail berikut telah terdaftar:\n" .
            "Resi: " . $suratPaket->Resi . "\n" .
            "Kurir: " . ($suratPaket->Kurir->Ekspedisi ?? 'Tidak ada') . "\n\n" .
            "Silakan jemput " . $suratPaket->Jenis . " Anda di lokasi kami. \n\n";

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
                'Authorization: ' . env('FONNTE_TOKEN'), // Ganti dengan token Fonnte Anda
            ),
        ));

        $response = curl_exec($curl);
        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
            curl_close($curl);
            return redirect()->back()->with('error', 'Gagal mengirim notifikasi: ' . $error_msg);
        }

        curl_close($curl);

        // Simpan riwayat pengiriman WhatsApp ke dalam database
        WhatsappHistory::create([
            'surat_paket_id' => $suratPaket->id,
            'recipient_phone' => $noHp,
            'message' => $message,
            'status' => 'Sent', // Anda bisa menambahkan status pengiriman
        ]);

        // Menampilkan nomor WhatsApp yang dikirimkan
        return redirect()->back()->with('success', 'Notifikasi berhasil dikirim ke WhatsApp: ' . $noHp);
    }


    public function sendEmailNotification($id)
    {
        // Cari data Surat Paket berdasarkan ID
        $suratPaket = suratPaket::with(['Pemilik', 'Kurir'])->find($id);

        // Validasi jika data tidak ditemukan
        if (!$suratPaket) {
            return redirect()->back()->with('error', 'Data Surat Paket tidak ditemukan.');
        }

        // Email tujuan
        $email = $suratPaket->Pemilik->Email ?? null;

        // Validasi jika email tidak tersedia
        if (!$email) {
            return redirect()->back()->with('error', 'Email pemilik tidak tersedia.');
        }

        // Data untuk email
        $details = [
            'title' => 'Notifikasi ' . $suratPaket->Jenis . ' Dengan Resi ' . $suratPaket->Resi,
            'body' => "Halo, " . ($suratPaket->Pemilik->Nama ?? 'Pemilik') . "!\n\n" .
                "Kami dari security Politeknik Caltex Riau ingin memberitahukan bahwa " .
                $suratPaket->Jenis . " Anda dengan detail berikut telah terdaftar:\n" .
                "Resi: " . $suratPaket->Resi . "\n" .
                "Kurir: " . ($suratPaket->Kurir->Ekspedisi ?? 'Tidak ada') . "\n\n" .
                "Silakan jemput " . $suratPaket->Jenis . " Anda di lokasi kami. \n\n",
        ];

        // Kirim email
        try {
            Mail::to($email)->send(new NotifMail($details));

            // Simpan riwayat email ke dalam database
            EmailHistory::create([
                'surat_paket_id' => $suratPaket->id,
                'recipient_email' => $email,
                'subject' => $details['title'],
                'body' => $details['body'],
            ]);

            return redirect()->back()->with('success', 'Email notifikasi berhasil dikirim ke: ' . $email);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengirim email notifikasi: ' . $e->getMessage());
        }
    }

    /**
     * Kirim email notifikasi ke pemilik surat paket
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
}
