<?php

namespace App\Models\Util;

class CargaHorariaValidation
{   
    public const CH_MIN = 'min:1';
    public const CH_MAX = '';

    public const CH_MIN_DOUBLE = 'min:0.5';
    
    /** @var integer|null */
    public $ch_min;
    	
    /** @var integer|null */
    public $ch_max;

    /** @var array */
    public $multiplier;

    /** @var double */
    public $is_double;
    
    public function __construct($ch_min, $ch_max, $multiplier = [], $is_double = false)
    {
        $this->ch_min = $ch_min;
        $this->ch_max = $ch_max;
        $this->multiplier = $multiplier;
        $this->is_double = $is_double;
    }
    
    public function rules()
    {   
        $ch_min = $this->ch_min !== null? sprintf('min:%d', $this->ch_min) : self::CH_MIN;

        $ch_max = $this->ch_max !== null? sprintf('max:%d', $this->ch_max) : self::CH_MAX;

        if($this->is_double)
        {
            $ch_min = $this->ch_min !== null? sprintf('min:%.2f', $this->ch_min) : self::CH_MIN_DOUBLE;

            $ch_max = $this->ch_max !== null? sprintf('max:%.2f', $this->ch_max) : self::CH_MAX;
        }

        return [
            'ch_semanal' => ['required', 'numeric', $ch_min, $ch_max]
        ];
    }

    public function messages()
    {   
        $ch_min = $this->ch_min !== null && $this->ch_min > 1 ? sprintf('"CH. Semanal" miníma é de %d Hora(s)!', $this->ch_min) : '"CH. Semanal" miníma é de 1 Hora(s)!';

        $ch_max = $this->ch_max !== null ? sprintf('"CH. Semanal" máxima para o preenchimento é de %d Hora(s)!', $this->ch_max) : '';

        if($this->ch_max !== null && isset($this->multiplier['value']) && (integer) $this->multiplier['value'] > 1)
        {   
            $ch_max = sprintf('"CH. Semanal" máxima para o preenchimento é de %d Hora(s)! Valor multiplicado pelo campo "%s" está acima da "CH. Semanal" máxima!', $this->ch_max, $this->multiplier['field']);
        }

        if($this->is_double)
        {
            $ch_min = $this->ch_min !== null && $this->ch_min > 0.5 ? sprintf('"CH. Semanal" miníma é de %.2f Hora(s)!', $this->ch_min) : '"CH. Semanal" miníma é de 0.5 Hora(s)!';

            $ch_max = $this->ch_max !== null ? sprintf('"CH. Semanal" máxima para o preenchimento é de %.2f Hora(s)!', $this->ch_max) : '';
        }
        
        return [
            'ch_semanal.required' => 'O campo "CH. Semanal" é obrigatório!',
            'ch_semanal.numeric' => '"CH. Semanal" deve conter um inteiro no seguinte formato: 1, 2, 3...!',
            'ch_semanal.min' => $ch_min,
            'ch_semanal.max' => $ch_max,
        ];
    }

    public static function defaultRules()
    {
        return [
            'ch_semanal' => ['required', 'numeric']
        ];
    }

    public static function defaultMessages()
    {
        return [
            'ch_semanal.required' => 'O campo "CH. Semanal" é obrigatório!',
            'ch_semanal.numeric' => '"CH. Semanal" deve conter um número no seguinte formato: 0.5, 1, 1.5, 2, 3...!',
        ];
    }

}