<?php

namespace App\Models\Tabelas\Ensino;

use App\Models\Planejamento;
use App\Models\Util\Modalidade;
use App\Models\Util\Nivel;
use App\Queries\Tabelas\Ensino\CoordenacaoRegenciaQuery;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoordenacaoRegencia extends Model
{
    /**
     * References table ensino_aulas
     * 
     * @var string
     */
    protected $table = 'ensino_coordenacao_regencia';

    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = ['user_pad_id', 'dimensao', 'cod_atividade', 'componente_curricular', 'curso', 'nivel', 'modalidade', 'ch_semanal'];

    /**
     * @return string
     */
    public function nivelAsString()
    {
        return Nivel::listNivel($this->nivel);
    }

    /**
     * @return string
     */
    public function modalidadeAsString()
    {
        return Modalidade::listModalidade($this->modalidade);
    }


    public static function rules()
    {
        return [

        ];
    }

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
        $codes = [];
        return Planejamento::initQuery()->whereInCodDimensao($codes)->get();
    }

    public static function initQuery() {
        return new CoordenacaoRegenciaQuery(get_called_class());
    }
}