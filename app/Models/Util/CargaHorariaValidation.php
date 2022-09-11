<?php

namespace App\Models\Util;

class CargaHorariaValidation
{   
    public const CH_MIN = 'min:1';
    public const CH_MAX = '';
    
    /** @var integer|null */
    public $ch_min;
    	
    /** @var integer|null */
    public $ch_max;

    /** @var string */
    public $ch_sum;

    public function __construct($ch_min, $ch_max, $ch_sum)
    {
        $this->ch_min = $ch_min;
        $this->ch_max = $ch_max;
        $this->ch_sum = $ch_sum;
    }
    
    public function rules()
    {   
        $ch_min = $this->ch_min !== null? sprintf('min:%d', $this->ch_min) : self::CH_MIN;

        $ch_max = $this->ch_max !== null? sprintf('max:%d', $this->ch_max - $this->ch_sum) : self::CH_MAX;

        return [
            'ch_semanal' => ['required', 'integer', $ch_min, $ch_max]
        ];
    }

    public function messages()
    {   
        $ch_min = $this->ch_min !== null && $this->ch_min > 1 ? sprintf('"CH. Semanal" miníma é de %d Hora(s)!', $this->ch_min) : '"CH. Semanal" miníma é de 1 Hora(s)!';
        $ch_max = '';

        if($this->ch_max !== null)
        {
            if($this->ch_max - $this->ch_sum !== 0)
            {
                $ch_max = sprintf('"CH. Semanal" máxima atual para preenchimento é de %d Hora(s)! %d Hora(s) já adicionadas', ($this->ch_max - $this->ch_sum), $this->ch_sum);
            } else {
                $ch_max = "Limite de horas preenchidas alcançado!";
            }
        } else {
            $ch_max = '';
        }
        
        return [
            'ch_semanal.required' => 'O campo "CH. Semanal" é obrigatório!',
            'ch_semanal.integer' => '"CH. Semanal" deve conter um inteiro no seguinte formato: 1, 2, 3...!',
            'ch_semanal.min' => $ch_min,
            'ch_semanal.max' => $ch_max,
        ];
    }

    public static function defaultRules()
    {
        return [
            'ch_semanal' => ['required', 'integer']
        ];
    }

    public static function defaultMessages()
    {
        return [
            'ch_semanal.required' => 'O campo "CH. Semanal" é obrigatório!',
            'ch_semanal.integer' => '"CH. Semanal" deve conter um inteiro no seguinte formato: 1, 2, 3...!',
        ];
    }

}