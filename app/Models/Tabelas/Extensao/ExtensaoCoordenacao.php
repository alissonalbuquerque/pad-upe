<?php

namespace App\Models\Tabelas\Extensao;

use App\Models\Planejamento;
use App\Models\Tabelas\Constants;
use App\Queries\Tabelas\Extensao\ExtensaoCoordenacaoQuery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use PHPUnit\TextUI\XmlConfiguration\Constant;

class ExtensaoCoordenacao extends Model
{
        /**
     * References table ensino_aulas
     * 
     * @var string
     */
    protected $table = 'extensao_coordenacao';
    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = ['orientacao_id', 'user_pad_id', 'dimensao', 'cod_atividade', 'titulo_projeto', 'programa_extensao', 'funcao', 'ch_semanal', 'atividade'];

    // public function orientacao()
    // {
    //     return $this->hasOne(Orientacao::class);
    // }

    public static function rules()
    {
        return [

            'cod_atividade' => ['required', 'string', 'max:255'],
            'titulo_projeto' => ['required', 'string', 'max:255'],
            'programa_extensao' => ['required', 'string', 'max:255'],
            'funcao' => ['required', 'integer', Rule::in(array_keys(Constants::listModalidade()))],
            'ch_semanal' => ['required', 'integer', 'min:1'],
        ];
    }

    public static function messages()
    {
        return [
            'required' => 'O campo ":attribute" é obrigatório!',
            'integer' => 'O campo ":attribute" deve cónter um inteiro!',
            'in' => 'Selecione uma opção da lista de ":attribute"!',
            'ch_semanal.min' => 'Carga horária semanal miníma é de 1 Hora!',
        ];
    }

    /**
     * @return array
     */
    public static function getPlanejamentos() {
        $codes = ['X-1'];
        return Planejamento::initQuery()->whereInCodDimensao($codes)->get();
    }

    /**
     * @return string
     */
    public function funcaoAsString()
    {
        return Constants::listFuncaoProjeto($this->funcao);
    }


    public static function initQuery()
    {
        return new ExtensaoCoordenacaoQuery(get_called_class());
    }

}
