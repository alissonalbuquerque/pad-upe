<?php

namespace App\Models\Tabelas\Extensao;

use App\Models\Planejamento;
use App\Models\Tabelas\Constants;
use App\Models\Util\CargaHoraria;
use App\Queries\Tabelas\Extensao\ExtensaoOrientacaoQuery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class ExtensaoOrientacao extends Model
{
        /**
     * References table ensino_aulas
     * 
     * @var string
     */
    protected $table = 'extensao_orientacao';
    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = ['orientacao_id', 'user_pad_id', 'dimensao', 'cod_atividade', 'titulo_projeto', 'discente', 'funcao', 'ch_semanal'];

    // public function orientacao()
    // {
    //     return $this->hasOne(Orientacao::class);
    // }

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

    public static function rules()
    {
        return [
            'cod_atividade' => ['required', 'string', 'max:255'],
            'titulo_projeto' => ['required', 'string', 'max:255'],
            'discente' => ['required', 'string', 'max:255'],
            'funcao' => ['required', 'integer', Rule::in(array_keys(Constants::listFuncaoOrientador()))],
        ];
    }

    public static function messages()
    {
        return [
            //cod_atividade
            'cod_atividade.required' => 'O campo "Cód. Atividade" é obrigatório!',
            
            //titulo_projeto
            'titulo_projeto.required' => 'O campo "Título do Projeto" é obrigatório!',

            //discente
            'discente.required' => 'O campo "Nome do Orientando" é obrigatório!',

            //funcao
            'funcao.required' => 'O campo "Função" é obrigatório!',
            'funcao.in' => 'Selecione uma opção da lista de "Função"!',
            'funcao.integer' => 'O campo "Função" deve ser um inteiro!',
        ];
    }

    /**
     * @return array
     */
    public static function getPlanejamentos() {
        $codes = ['X-2'];
        return Planejamento::initQuery()->whereInCodDimensao($codes)->get();
    }


    /**
     * @return string
     */
    public function funcaoAsString()
    {
        return Constants::listFuncaoOrientador($this->funcao);
    }


    public static function initQuery()
    {
        return new ExtensaoOrientacaoQuery(get_called_class());
    }

}
