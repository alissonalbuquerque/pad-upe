<?php

namespace App\Models\Util;

class MaskHelper
{
    /** 
     * @param string $document
     * @param array $clean
     * @return string
     * */
    public static function documentOnlyNumber(string $document, array $clean = ['.', '-'])
    {   
        return str_replace($clean, '', $document);
        
    }
}