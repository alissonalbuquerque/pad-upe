<?php

namespace App\Models\Tabelas\Pesquisa;

use App\Models\Planejamento;
use App\Models\Tabelas\Traits\ExpandModel;
use App\Models\Tabelas\Traits\ExpandTask;
use App\Models\UserPad;
use App\Queries\Tabelas\Pesquisa\PesquisaOutrosQuery;
use Illuminate\Database\Eloquent\Model;

class PesquisaOutros extends Model
{   
    use ExpandModel;
    use ExpandTask;
    
    /**
     * References table ensino_aulas
     * 
     * @var string
     */
    protected $table = 'pesquisa_outro';

    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = ['orientacao_id', 'user_pad_id', 'dimensao', 'cod_atividade', 'atividade', 'descricao', 'ch_semanal'];

    // Array de strings para preenchimento de campos de avaliação
    public $avaliable_attributes = ['Atividade:' => 'atividade', 'Descrição:' => 'descricao', 'Carga Horária:' => 'ch_semanal'];

    public static function rules()
    {
        return [
            'cod_atividade' => ['required', 'string', 'max:255'],
            'atividade' => ['required', 'string', 'max:255'],
            'descricao' => ['required', 'string', 'max:255'],
        ];
    }

    public static function messages()
    {
        return [
            //cod_atividade
            'cod_atividade.required' => 'O campo "Cod. Atividade" é obrigatório!',

            //atividade
            'atividade.required' => 'O campo "Atividade" é obrigatório!',

            //descricao
            'descricao.required' => 'O campo "Curso" é obrigatório!',
        ];
    }

    /**
     * @return array
     */
    public static function getPlanejamentos() {
        $codes = ['P-5'];
        return Planejamento::initQuery()->whereInCodDimensao($codes)->get();
    }

    public function userPad() {
        return $this->belongsTo(UserPad::class);
    }

    public static function initQuery()
    {
        return new PesquisaOutrosQuery(get_called_class());
    }

    //retorna a atividade correspondente ao código
    public function getDescricaoAtividade(){
        return "Outros";
    }

}
