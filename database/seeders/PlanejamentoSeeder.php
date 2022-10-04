<?php

namespace Database\Seeders;

use App\Models\Planejamento;
use Illuminate\Database\Seeder;

class PlanejamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list_ensino = [
            ['cod_dimensao' => 'E-1', 'dimensao' => Planejamento::ENSINO, 'descricao' => 'Aula na graduação e/ou pós-graduação stricto sensu', 'ch_semanal' => null, 'ch_maxima' => null],
            ['cod_dimensao' => 'E-2', 'dimensao' => Planejamento::ENSINO, 'descricao' => 'Aula em cursos de especialização lato sensu dentro da carga horária contratual e/ou programas de residência na UPE', 'ch_semanal' => null, 'ch_maxima' => null],
            ['cod_dimensao' => 'E-3', 'dimensao' => Planejamento::ENSINO, 'descricao' => 'Aula na graduação e/ou pós-graduação lato sensu na modalidade EAD dentro da carga contratual da UPE', 'ch_semanal' => null, 'ch_maxima' => null],
            ['cod_dimensao' => 'E-4', 'dimensao' => Planejamento::ENSINO, 'descricao' => 'Supervisão/Preceptoria de estágio de estudantes de graduação da UPE', 'ch_semanal' => 2, 'ch_maxima' => 8],
            ['cod_dimensao' => 'E-5', 'dimensao' => Planejamento::ENSINO, 'descricao' => 'Orientação de estágio de estudantes de graduação da UPE', 'ch_semanal' => 2, 'ch_maxima' => 8],
            ['cod_dimensao' => 'E-6', 'dimensao' => Planejamento::ENSINO, 'descricao' => 'Orientação de TCC de graduação e/ou de cursos de especialização lato sensu dentro da carga horária contratual e/ou programas de residência na UPE', 'ch_semanal' => 2, 'ch_maxima' => 8],
            ['cod_dimensao' => 'E-7', 'dimensao' => Planejamento::ENSINO, 'descricao' => 'Orientação de dissertação de mestrado e tese de doutorado na UPE', 'ch_semanal' => 2, 'ch_maxima' => 8],
            ['cod_dimensao' => 'E-8', 'dimensao' => Planejamento::ENSINO, 'descricao' => 'Coorientação de dissertação de mestrado e tese de doutorado na UPE', 'ch_semanal' => 1, 'ch_maxima' => 4],
            ['cod_dimensao' => 'E-9', 'dimensao' => Planejamento::ENSINO, 'descricao' => 'Coorientação de TCC de graduação e/ou de cursos de especialização lato sensu dentro da carga horária contratual e/ou programas de residência na UPE', 'ch_semanal' => 1, 'ch_maxima' => 4],
            ['cod_dimensao' => 'E-10', 'dimensao' => Planejamento::ENSINO, 'descricao' => 'Supervisão de estágio docente de estudante de stricto sensu da UPE', 'ch_semanal' => 1, 'ch_maxima' => 2],
            ['cod_dimensao' => 'E-11', 'dimensao' => Planejamento::ENSINO, 'descricao' => 'Coordenação e/ou participação de Projetos/ações de Ensino (inovações pedagógicas, monitoria e apoio a vivência de componentes curriculares)', 'ch_semanal' => null, 'ch_maxima' => 8],
            ['cod_dimensao' => 'E-12', 'dimensao' => Planejamento::ENSINO, 'descricao' => 'Plenos de cursos (graduação e pós-graduação)', 'ch_semanal' => 1, 'ch_maxima' => null],
            ['cod_dimensao' => 'E-13', 'dimensao' => Planejamento::ENSINO, 'descricao' => 'Coordenação e/ou membro de Núcleo Docente Estruturante ou Núcleo Docente Estruturante Assistencial', 'ch_semanal' => 2, 'ch_maxima' => null],
            ['cod_dimensao' => 'E-14', 'dimensao' => Planejamento::ENSINO, 'descricao' => 'Coordenação de componente curricular (a partir de dois professores por componente curricular)', 'ch_semanal' => 2, 'ch_maxima' => 4],
            ['cod_dimensao' => 'E-15', 'dimensao' => Planejamento::ENSINO, 'descricao' => 'Coordenação de estágio de curso de graduação', 'ch_semanal' => 2, 'ch_maxima' => null],
            ['cod_dimensao' => 'E-16', 'dimensao' => Planejamento::ENSINO, 'descricao' => 'Atendimento ao estudante', 'ch_semanal' => 1, 'ch_maxima' => 4],
            ['cod_dimensao' => 'E-17', 'dimensao' => Planejamento::ENSINO, 'descricao' => 'Preceptoria/Tutoria de residência de estudantes', 'ch_semanal' => 2, 'ch_maxima' => 8],
            ['cod_dimensao' => 'E-18', 'dimensao' => Planejamento::ENSINO, 'descricao' => 'Atividades fora dos padrões de preenchimento apresentados anteriormente', 'ch_semanal' => null, 'ch_maxima' => null],
        ];

        $list_pesquisa = [
            ['cod_dimensao' => 'P-1', 'dimensao' => Planejamento::PESQUISA, 'descricao' => 'Liderança e/ou participação em grupos de pesquisa cadastrados no CNPq e certificados pela UPE', 'ch_semanal' => 1, 'ch_maxima' => 1],
            ['cod_dimensao' => 'P-2', 'dimensao' => Planejamento::PESQUISA, 'descricao' => 'Coordenação e/ou participação em Projetos de Pesquisa cadastrados no SISPG', 'ch_semanal' => null, 'ch_maxima' => 12],
            ['cod_dimensao' => 'P-3', 'dimensao' => Planejamento::PESQUISA, 'descricao' => 'Orientação de Iniciação Científica oriunda de projeto/subprojeto cadastrado no SISPG', 'ch_semanal' => 2, 'ch_maxima' => 6],
            ['cod_dimensao' => 'P-4', 'dimensao' => Planejamento::PESQUISA, 'descricao' => 'Co-orientação de Iniciação Científica oriunda de projeto/subprojeto cadastrado no SISPG', 'ch_semanal' => 1, 'ch_maxima' => 3],
            ['cod_dimensao' => 'P-5', 'dimensao' => Planejamento::PESQUISA, 'descricao' => 'Atividades fora dos padrões de preenchimento apresentados anteriormente', 'ch_semanal' => null, 'ch_maxima' => null],
        ];

        $list_extensao = [
            ['cod_dimensao' => 'X-1', 'dimensao' => Planejamento::EXTENSAO, 'descricao' => 'Coordenação e/ou participação em atividades de Extensão homologadas na PROEC', 'ch_semanal' => null, 'ch_maxima' => 12],
            ['cod_dimensao' => 'X-2', 'dimensao' => Planejamento::EXTENSAO, 'descricao' => 'Orientação ou acompanhamento de estudantes em atividades de extensão homologados na PROEC', 'ch_semanal' => 2, 'ch_maxima' => 6],
            ['cod_dimensao' => 'X-3', 'dimensao' => Planejamento::EXTENSAO, 'descricao' => 'Atividades fora dos padrões de preenchimento apresentados anteriormente', 'ch_semanal' => null, 'ch_maxima' => null],
        ];

        $list_gestao = [
            ['cod_dimensao' => 'G-1', 'dimensao' => Planejamento::GESTAO, 'descricao' => 'Membro de Comissão / Comitê / Núcleo, formalmente designado (a) no âmbito da UPE ou para representação da UPE', 'ch_semanal' => 2, 'ch_maxima' => 6],
            ['cod_dimensao' => 'G-2', 'dimensao' => Planejamento::GESTAO, 'descricao' => 'Membro titular dos Conselhos da UPE (CEPE, CONSUN ou CGA)', 'ch_semanal' => 1, 'ch_maxima' => null],
            ['cod_dimensao' => 'G-3', 'dimensao' => Planejamento::GESTAO, 'descricao' => 'Representante nas unidades de educação e educação e saúde formalmente designado (a) pela entidade sindical', 'ch_semanal' => 1, 'ch_maxima' => null],
            ['cod_dimensao' => 'G-4', 'dimensao' => Planejamento::GESTAO, 'descricao' => 'Participação como membro nas câmaras consultivas dos Conselhos Superiores', 'ch_semanal' => 1, 'ch_maxima' => null],
            ['cod_dimensao' => 'G-5', 'dimensao' => Planejamento::GESTAO, 'descricao' => 'Coordenação de laboratórios didáticos, de informática, de ensino ou pesquisa', 'ch_semanal' => 2, 'ch_maxima' => null],
            ['cod_dimensao' => 'G-6', 'dimensao' => Planejamento::GESTAO, 'descricao' => 'Coordenação de Programa Institucional', 'ch_semanal' => 2, 'ch_maxima' => null],
            ['cod_dimensao' => 'G-7', 'dimensao' => Planejamento::GESTAO, 'descricao' => 'Atividades fora dos padrões de preenchimento apresentados anteriormente', 'ch_semanal' => null, 'ch_maxima' => null],
        ];

        foreach($list_ensino as $ensino) {
            Planejamento::create($ensino);
        }

        foreach($list_pesquisa as $pesquisa) {
            Planejamento::create($pesquisa);
        }

        foreach($list_extensao as $extensao) {
            Planejamento::create($extensao);
        }

        foreach($list_gestao as $gestao) {
            Planejamento::create($gestao);
        }

    }
}
