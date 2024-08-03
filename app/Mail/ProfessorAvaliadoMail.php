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
    public $aprovadas;
    public $reprovadas;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($professor, $atividadesDetalhes, $aprovadas, $reprovadas)
    {
        $this->professor = $professor;
        $this->atividadesDetalhes = $atividadesDetalhes;
        $this->aprovadas = $aprovadas;
        $this->reprovadas = $reprovadas;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view("emails.professor_avaliado")
                    ->with([
                        'professor' => $this->professor,
                        'atividadesDetalhes' => $this->atividadesDetalhes,
                        'aprovadas' => $this->aprovadas,
                        'reprovadas' => $this->reprovadas,
                    ])
                    ->subject('Suas atividades foram avaliadas!');
    }
}
