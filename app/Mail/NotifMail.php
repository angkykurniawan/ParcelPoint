<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NotifMail extends Mailable
{
    use Queueable, SerializesModels;

    private $details;

    /**
     * Create a new message instance.
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('[PENTING] Pemberitahuan Surat Paket')
            ->greeting('Halo!')
            ->line('Kami dari security Politeknik Caltex Riau ingin menyampaikan bahwa ' . $this->details['jenis'] .
                ' atas nama ' . $this->details['pemilik'] . ' dengan nomor resi ' . $this->details['noResi'] . ' sudah sampai.')
            ->line('Mohon untuk segera dijemput di pos security Politeknik Caltex Riau.')
            ->line('Untuk informasi lebih lanjut, silahkan hubungi kami.')
            ->salutation('Terimakasih.');
    }

    public function toArray($notifiable)
    {
        return $this->details;
    }




    /**
     * Get the message envelope.
     */
    // public function envelope(): Envelope
    // {
    //     return new Envelope(
    //         new Address('angky23ti@mahasiswa.pcr.ac.id', 'Angky'),
    //         'Informasi surat & paket',
    //     );
    // }

    /**
     * Get the message content definition.
     */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'mail.send',
    //         with: $this->data, // Kirim data ke view
    //     );
    // }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    // public function attachments(): array
    // {
    //     return [];
    // }
}
