<?php

namespace App\Models\Tabelas\Gestao;

use App\Models\Planejamento;
use App\Models\Tabelas\Traits\ExpandModel;
use App\Models\Tabelas\Traits\ExpandTask;
use App\Models\UserPad;
use App\Queries\Tabelas\Gestao\GestaoCoordenacaoLaboratoriosDidaticosQuery;
use Illuminate\Database\Eloquent\Model;

class GestaoCoordenacaoLaboratoriosDidaticos extends Model
{   
    use ExpandModel;
    use ExpandTask;
    
    /**
     * References table ensino_aulas
     * 
     * @var string
     */
    protected $table = 'gestao_coordenacao_laboratorios_didaticos';
    
    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = ['orientacao_id', 'user_pad_id', 'dimensao', 'cod_atividade', 'nome', 'documento', 'ch_semanal',];

    // Array de strings para preenchimento de campos de avaliação
    public $avaliable_attributes = ['Nome:' => 'nome', 'Documento:' => 'documento', 'Carga Horária:' => 'ch_semanal'];

    public static function rules()
    {
        return [
            'cod_atividade' => ['required', 'string', 'max:255'],
            'nome' => ['required', 'string', 'max:255'],
            'documento' => ['required', 'string', 'max:255'],
        ];
    }

    public static function messages()
    {
        return [            
            //cod_atividade
            'cod_atividade.required' => 'O campo "Cód. Atividade" é obrigatório!',

            //nome
            'nome.required' => 'O campo "Nome do Laboratório" é obrigatório!',

            //documento
            'documento.required' => 'O campo "Documento que o Designa" é obrigatório!',
        ];
    }

    /**
     * @return array
     */
    public static function getPlanejamentos() {
        $codes = ['G-5'];
        return Planejamento::initQuery()->whereInCodDimensao($codes)->get();
    }

    public function userPad() {
        return $this->belongsTo(UserPad::class);
    }

    public static function initQuery()
    {
        return new GestaoCoordenacaoLaboratoriosDidaticosQuery(get_called_class());
    }

    //retorna a atividade correspondente ao código
    public function getDescricaoAtividade(){
        return "Coordenação de Laboratórios Didático, de Informática ou de Ensino";
    }
}
