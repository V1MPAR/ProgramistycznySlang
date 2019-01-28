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

    public static function getSlangsToAcceptCount()
    {
        $slangsCount = Slang::where('accepted', 0)->count();
        return $slangsCount;
    }

    public static function checkAccepted($id)
    {
        $slang = Slang::where('id', $id)->get();
        if ( $slang[0] -> accepted == 1 ) {
            return true;
        } else {
            return false;
        }
    }

    public static function getAuthor($id)
    {
        $author = Slang::select('user_id')->where('id', $id)->get();
        return $author[0];
    }

    public static function polishPlural($singularNominativ, $pluralNominativ, $pluralGenitive, $value)
    {
        if ($value === 1) {
            return $singularNominativ;
        } else if ($value % 10 >= 2 && $value % 10 <= 4 && ($value % 100 < 10 || $value % 100 >= 20)) {
            return $pluralNominativ;
        } else {
            return $pluralGenitive;
        }
    }
}
