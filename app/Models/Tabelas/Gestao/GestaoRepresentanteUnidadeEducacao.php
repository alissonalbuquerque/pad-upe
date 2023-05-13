<?php

namespace App\Models\Tabelas\Gestao;

use App\Models\Planejamento;
use App\Models\UserPad;
use App\Queries\Tabelas\Gestao\GestaoRepresentanteUnidadeEducacaoQuery;
use Illuminate\Database\Eloquent\Model;

class GestaoRepresentanteUnidadeEducacao extends Model
{
        /**
     * References table ensino_aulas
     * 
     * @var string
     */
    protected $table = 'gestao_representante_unidade_educacao';
    
    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = ['orientacao_id', 'user_pad_id', 'dimensao', 'cod_atividade', 'nome', 'documento', 'ch_semanal',];

    // Array de strings para preenchimento de campos de avaliação
    public $avaliable_attributes = ['Nome:' => 'nome', 'Documento' => 'documento', 'Carga Horária:' => 'ch_semanal'];

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
            'nome.required' => 'O campo "Documento Comprobatório da Representação Sindical" é obrigatório!',

            //documento
            'documento.required' => 'O campo "Documento que o Designa" é obrigatório!',
        ];
    }

    /**
     * @return array
     */
    public static function getPlanejamentos() {
        $codes = ['G-3'];
        return Planejamento::initQuery()->whereInCodDimensao($codes)->get();
    }

    public function userPad() {
        return $this->belongsTo(UserPad::class);
    }

    public static function initQuery()
    {
        return new GestaoRepresentanteUnidadeEducacaoQuery(get_called_class());
    }

    //retorna a atividade correspondente ao código
    public function getDescricaoAtividade(){
        return "Representante nas Unidades de Educação ou de Educação e Saúde Formalmente Designado(a) pela Entidade Sindical";
    }
}
