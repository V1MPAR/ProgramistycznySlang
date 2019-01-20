<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    public static function getVotesCount($id)
    {
        $voteUp = Vote::where('slang_id', $id)->where('vote', 1)->count();
        $voteDown = Vote::where('slang_id', $id)->where('vote', 0)->count();
        if ( $voteUp == 0 ) {
            $votes = 0 - $voteDown;
        } else if ( $voteDown == 0 ) {
            $votes = $voteUp - 0;
        } else {
            $votes = $voteUp - $voteDown;
        }

        return $votes;
    }
}
