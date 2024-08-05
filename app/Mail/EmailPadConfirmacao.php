<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailPadConfirmacao extends Mailable
{
    use Queueable, SerializesModels;

    public $userPad;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userPad)
    {
        $this->userPad = $userPad;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.email_confirmacao_pda')
                    ->with([
                        'userPad' => $this->userPad,
                    ])
                    ->subject('Seu PDA foi salvo');
    }
}
