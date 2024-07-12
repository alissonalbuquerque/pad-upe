<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AtividadesEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $atividades;

    public function __construct($atividades)
    {
        $this->atividades = $atividades;
    }

    public function build()
    {
        return $this->view('emails.atividades')
                    ->with('atividades', $this->atividades);
    }
}
