<?php

namespace App\Models\Tabelas\Ensino;

use App\Queries\PlanejamentoQuery;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnsinoOrientacao extends Model
{
    use HasFactory;

    const NIVEL_GRADUACAO = 1;
    const NIVEL_POS_GRADUACAO_LATO_SENSU = 2;
    const NIVEL_POS_GRADUACAO_STRICTO_SENSU = 3;

    const MODALIDADE_EAD = 1;
    const MODALIDADE_PRESENCIAL = 2;

    const ORIENTACAO_GRUPO = 1;
    const ORIENTACAO_INDIVIDUAL = 2;

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
     * cod_dimensao from planejamento table
     * @var array
     */
    private $codesDimensao = ['E-5', 'E-6', 'E-7', 'E-8', 'E-9'];

    /**
     * @return array|string
     */
    public function listNivel($value = null) {
        $values = [
            self::NIVEL_GRADUACAO => 'Graduação',
            self::NIVEL_POS_GRADUACAO_LATO_SENSU => 'Pós-graduação Stricto Sensu',
            self::NIVEL_POS_GRADUACAO_STRICTO_SENSU => 'Pós-Graduação Lato Sensu',
            
        ];
    
        return $value !== null? $values[$value] : $values;
    }

    /**
     * @return array|string
     */
    public function listModalidade($value = null) {
        $values = [
            self::MODALIDADE_EAD => 'EAD',
            self::MODALIDADE_PRESENCIAL => 'Presencial',
            
        ];
    
        return $value !== null? $values[$value] : $values;
    }

    /**
     * @return array|string
     */
    public function listTypeOrientacao($value = null) {
        $values = [
            self::ORIENTACAO_GRUPO => 'Individual',
            self::ORIENTACAO_INDIVIDUAL => 'Grupo',
        ];
    
        return $value !== null? $values[$value] : $values;
    }

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
     * Get PAD with pad.id = ensino_coordenacao.pad_id
     * 
     * @return PAD
     */
    public function pad() {
        return $this->belongsTo(PAD::class);
    }

    /**
     * Get Curso with curso.id = ensino_aulas.curso_id
     * 
     * @return Curso
     */
    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    /**
     * @return array
     */
    public function getPlanejamentos() {
        $query = new PlanejamentoQuery();
        return $query->whereInCodDimensao($this->codesDimensao)->get();
    }


}
