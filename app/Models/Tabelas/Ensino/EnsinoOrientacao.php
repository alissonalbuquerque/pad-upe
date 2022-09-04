<?php

namespace App\Models\Tabelas\Ensino;

use App\Models\Planejamento;
use App\Queries\PlanejamentoQuery;
use App\Queries\Tabelas\Ensino\EnsinoOrientacaoQuery;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnsinoOrientacao extends Model
{
    /**
     * References table ensino_orientacoes
     * 
     * @var string
     */
    protected $table = 'ensino_orientacoes';

    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = ['cod_atividade', 'atividade', 'curso_id', 'nivel', 'type_orientacao', 'numero_orientandos', 'ch_semanal', 'pad_id'];

    /**
     * @return array
     */
    public function orientacaoPreenchimento() {
        return [
            'descricao' =>              ['item' => '3.', 'ENSINO (ORIENTAÇÕES: ORIENTAÇÃO DE ESTÁGIO, ORIENTAÇÃO DE TCC, ORIENTAÇÃO DE RESIDÊNCIA, ORIENTAÇÃO DE MESTRADO E/OU ORIENTAÇÃO DE DOUTORADO. COORIENTAÇÕES: TCC, MESTRADO E/OU DOUTORADO)'],
            'atividade' =>              ['item' => 'Atividade de Orientação e Coorientação:', 'descricao' => 'Nome do componente curricular como descrito no PPC do curso'],
            'curso' =>                  ['item' => 'Curso:', 'descricao' => 'Nome do curso ao qual o(s) discente(s) orientado(s) pertence'],
            'nivel' =>                  ['item' => 'Nível:', 'descricao' => 'Preencher o nível do curso que a orientação é realizada, sendo as opções: Graduação, Pós-graduação Stricto Sensu, Pós-Graduação Lato Sensu'],
            'type_orientacao' =>        ['item' => 'Individual ou Grupo:', 'descricao' => 'Preencher se a orientação é individual ou em grupo. Caso seja em grupo, informar o número de participantes'],
            'modalidade' =>             ['item' => 'Modalidade:', 'descricao' => 'Preencher a modalidade que o componente curricular é ofertado, sendo as opções: Presencial e EAD'],
            'ch_semanal' =>             ['item' => 'Carga Horária Semanal:', 'descricao' => 'Carga horária semanal efetivamente exercida na atividade (preencher de acordo com quadro de referência)'],
        ];
    }

    /**
     * @return array
     */
    public static function rules()
    {
        return [

        ];
    }

    /**
     * @return array
     */
    public static function messages()
    {
        return [
            
        ];
    }

    /**
     * @return array
     */
    public static function getPlanejamentos()
    {
        $codes = ['E-5', 'E-6', 'E-7', 'E-8', 'E-9'];
        return Planejamento::initQuery()->whereInCodDimensao($codes)->get();
    }

    public static function initQuery()
    {
        return new EnsinoOrientacaoQuery(get_called_class());
    }

}
