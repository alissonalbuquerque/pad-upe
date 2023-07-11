<?php

namespace Database\Seeders;

use App\Models\Campus;
use App\Models\Curso;
use Illuminate\Database\Seeder;


class CursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $listCursos = [
            'ARCOVERDE' => [
                'BACHARELADO EM DIREITO',
                'BACHARELADO EM ODONTOLOGIA'
            ],
            'CARUARU' => [
                'BACHARELADO EM ADMINISTRAÇÃO',
                'BACHARELADO EM SISTEMA DE INFORMAÇÃO'
            ],
            'GARANHUNS' => [
                'BACHARELADO EM ENGENHARIA DE SOFTWARE',
                'BACHARELADO EM MEDICINA',
                'BACHARELADO EM PSICOLOGIA',
                'LICENCIATURA EM CIÊNCIAS BIOLÓGICAS',
                'LICENCIATURA EM COMPUTAÇÃO',
                'LICENCIATURA EM GEOGRAFIA',
                'LICENCIATURA EM HISTÓRIA',
                'LICENCIATURA EM LETRAS',
                'LICENCIATURA EM MATEMÁTICA',
                'LICENCIATURA EM PEDAGOGIA',
            ],
            'MATA NORTE' => [
                'LICENCIATURA EM CIÊNCIAS BIOLÓGICAS',
                'LICENCIATURA EM GEOGRAFIA',
                'LICENCIATURA EM HISTORIA',
                'LICENCIATURA EM LETRAS (PORTUGUÊS/INGLÊS)',
                'LICENCIATURA EM LETRAS (PORTUGUÊS/ESPANHOL)',
                'LICENCIATURA EM MATEMÁTICA',
                'LICENCIATURA EM PEDAGOGIA',
                'TECNOLOGIA EM GESTÃO DE LOGÍSTICA',
            ],
            'MATA SUL' => [
                'BACHARELADO EM ADMINISTRAÇÃO',
                'BACHARELADO EM SERVIÇO SOCIAL',
            ],
            'PETROLINA' => [
                'BACHARELADO EM ENFERMAGEM',
                'BACHARELADO EM FISIOTERAPIA',
                'BACHARELADO EM NUTRIÇÃO',
                'LICENCIATURA EM CIÊNCIAS BIOLÓGICAS',
                'LICENCIATURA EM GEOGRAFIA',
                'LICENCIATURA EM HISTORIA',
                'LICENCIATURA EM LETRAS (PORTUGUÊS/INGLÊS)',
                'LICENCIATURA EM LETRAS (PORTUGUÊS/ESPANHOL)',
                'LICENCIATURA EM MATEMÁTICA',
                'LICENCIATURA EM PEDAGOGIA',
            ],
            'EAD' => [
                'BACHARELADO EM ADMINISTRAÇÃO PÚBLICA (EAD)',
                'LICENCIATURA EM CIÊNCIAS BIOLÓGICAS (EAD)',
                'LICENCIATURA EM HISTÓRIA (EAD)',
                'LICENCIATURA EM LETRAS (EAD)',
                'LICENCIATURA EM PEDAGOGIA (EAD)',
            ],
            'BENFICA (POLI)' => [
                'BACHARELADO EM ADMINISTRAÇÃO',
                'BACHARELADO EM DIREITO',
                'BACHARELADO EM ENGENHARIA CIVIL',
                'BACHARELADO EM ENGENHARIA DA COMPUTAÇÃO',
                'BACHARELADO EM ENGENHARIA DE CONTROLE E AUTOMAÇÃO',
                'BACHARELADO EM ENGENHARIA ELÉTRICA ELETROTÉCNICA',
                'BACHARELADO EM ENGENHARIA ELÉTRICA ELETRÔNICA',
                'BACHARELADO EM ENGENHARIA ELÉTRICA E TELECOMUNICAÇÕES',
                'BACHARELADO EM ENGENHARIA MECÂNICA INDUSTRIAL',
                'BACHARELADO EM FÍSICA DE MATERIAIS',
            ],
            'SANTO AMARO' => [
                'BACHARELADO EM CIÊNCIAS BIOLÓGICAS',
                'BACHARELADO EM EDUCAÇÃO FÍSICA',
                'BACHARELADO EM EMFERMAGEM',
                'BACHARELADO EM MEDICINA',
                'BACHARELADO EM ODONTOLOGIA',
                'BACHARELADO EM SAÚDE COLETIVA',
                'LICENCIATURA EM CIÊNCIAS SOCIAIS',
                'LICENCIATURA EM FÍSICA',
            ],
            'SALGUEIRO' => [
                'BACHARELADO EM ADMINISTRAÇÃO'
            ],
            'SERRA TALHADA' => [
                'BACHARELADO EM MEDICINA'
            ]
        ];

        foreach($listCursos as $campus => $cursos)
        {   
            $campus = Campus::whereName($campus)->first();

            foreach($cursos as $curso)
            {   
                Curso::create([
                    'name' => $curso,
                    'campus_id' => $campus->id
                ]);
            }
        }
    }
}

