<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slang extends Model
{
    public static function getLetters()
    {
        $letters = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'w', 'x', 'y', 'z'];
        return $letters;
    }
}
