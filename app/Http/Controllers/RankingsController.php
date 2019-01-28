<?php

namespace App\Http\Controllers;

use DB;
use App\Slang;
use Illuminate\Http\Request;

class RankingsController extends Controller
{
    public function index()
    {
        $rankingSlangs = DB::table('slangs')
                     ->select(DB::raw('user_id, count(*) as count'))
                     ->groupBy('user_id')
                     ->limit(10)
                     ->get();
        return view('rankings.index')->with('rankingSlangs', $rankingSlangs);
    }
}
