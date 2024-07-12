<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProfessorAvaliadoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $professor;
    public $atividadesDetalhes;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($professor, $atividadesDetalhes)
    {
        $this->professor = $professor;
        $this->atividadesDetalhes = $atividadesDetalhes;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view("emails.professor_avaliado",)
                    ->with([
                        'professor' => $this->professor,
                        'atividadesDetalhes' => $this->atividadesDetalhes,
                    ])
                    ->subject('Sua atividade foi avaliada');
    }
}
