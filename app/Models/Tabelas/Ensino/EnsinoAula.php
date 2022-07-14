<?php

namespace App\Models\Tabelas\Ensino;

use App\Models\Curso;
use App\Models\Disciplina;
use App\Models\Planejamento;
use App\Models\Tabelas\Constants;
use App\Queries\PlanejamentoQuery;
use App\Queries\Tabelas\Ensino\EnsinoAulaQuery;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class EnsinoAula extends Model
{
    use HasFactory;

    /**
     * References table ensino_aulas
     * 
     * @var string
     */
    protected $table = 'ensino_aulas';

    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = ['user_pad_id', 'cod_atividade', 'componente_curricular', 'curso', 'nivel', 'modalidade', 'ch_semanal', 'ch_total'];
    
    
    /**
     * cod_dimensao from planejamento table
     * @var array
     */
    private $codesDimensao = ['E-1', 'E-2', 'E-3'];

    /**
     * @return array
     */
    public function orientacaoPreenchimento() {
        return [
            'descricao' =>              ['item' => '1.', 'descricao' => 'Ensino (Aulas em componentes curriculares)'],
            'componente_curricular' =>  ['item' => 'Nome do Componente:', 'descricao' => 'Nome do componente curricular como descrito no PPC do curso'],
            'curso' =>                  ['item' => 'Curso:', 'descricao' => 'Nome do curso ao qual o componente curricular pertence'],
            'nivel' =>                  ['item' => 'Nível:', 'descricao' => 'Preencher o nível do curso ao qual o componente curricular pertence, sendo as opções: Graduação, Pós-graduação Stricto Sensu, Pós-Graduação Lato Sensu'],
            'modalidade' =>             ['item' => 'Modalidade:', 'descricao' => 'Preencher a modalidade que o componente curricular é ofertado, sendo as opções: Presencial e EAD'],
            'ch_semanal' =>             ['item' => 'Carga Horária Semanal:', 'descricao' => 'Carga horária total efetiva exercida pelo docente dentro do componente curricular dividida pelo número de semanas que o mesmo ocorre'],
            'ch_total' =>               ['item' => 'Carga Horária Total:', 'descricao' => 'Carga horária total efetiva exercida pelo docente dentro do(s) componente(s) curricular (es)'],
            
        ];
    }

    /*
        'user_pad_id',
        'cod_atividade',
        'componente_curricular',
        'curso',
        'nivel',
        'modalidade',
        'ch_semanal',
        'ch_total'
    */

    public static function rules()
    {
        return [
            'cod_atividade' => ['required', 'string', 'max:255'],
            'componente_curricular' => ['required', 'string', 'max:255'],
            'curso' => ['required', 'string', 'max:255'],
            'nivel' => ['required', 'integer', Rule::in(array_keys(Constants::listNivel()))],
            'modalidade' => ['required', 'integer', Rule::in(array_keys(Constants::listModalidade()))],
            'ch_semanal' => ['required', 'integer', 'min:1'],
            'ch_total' => ['required', 'integer', 'min:1'],
        ];
    }

    public static function messages()
    {
        return [
            'required' => 'O campo ":attribute" é obrigatório!',
            'integer' => 'O campo ":attribute" deve cónter um inteiro!',
            'in' => 'Selecione uma opção da lista de ":attribute"!',
            'ch_semanal.min' => 'Carga horária semanal miníma é de 1 Hora!',
            'ch_total.min' => 'Carga horária total miníma é de 1 Hora!',
        ];
    }

    /**
     * Get PAD with pad.id = ensino_aulas.pad_id
     * 
     * @return PAD
     */
    public function pad() {
        return $this->belongsTo(PAD::class);
    }

    /**
     * Get Disciplina with diciplina.id = ensino_aulas.displina_id
     * 
     * @return Disciplina
     */
    public function disciplina()
    {
        return $this->belongsTo(Disciplina::class, 'componente_curricular');
    }

    /**
     * @return array
     */
    public function getPlanejamentos() {
        return Planejamento::find()->whereInCodDimensao($this->codesDimensao)->get();
    }


    public static function initQuery() {
        return new EnsinoAulaQuery(get_called_class());
    }

}
