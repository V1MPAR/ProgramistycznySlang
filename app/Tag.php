<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public static function getTags($id)
    {
        return Tag::where('slang_id', $id)->get();
    }
}
