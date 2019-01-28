<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\Tag;
use App\Vote;
use App\Slang;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Permission;

class SlangsController extends Controller
{
    use HasRoles;

    public function index()
    {
        $count = Slang::count();
        $slangs = Slang::orderBy('slang', 'ASC')->paginate(10);
        return view('slangs.index')->with('slangs', $slangs)->with('count', $count);
    }

    public function slang($link)
    {
        $slang = Slang::where('link', $link)->get();
        if ( auth()->user() != null ) {
            if ( ! auth()->user()->hasRole(['verified', 'admin']) ) {
                $slang = Slang::where('link', $link)->where('accepted', 1)->get();
            }
        }

        if ( $slang->count() > 0 ) {
            return view('slangs.slang')->with('slang', $slang[0]);
        } else {
            abort(404, 'Slang o takim linku nie istnieje.');
        }
    }

    public function letter($letter)
    {
        $slangsGet = Slang::where('slang', 'like', $letter . '%')->where('accepted', 1)->get();
        $slangs = Slang::where('slang', 'like', $letter . '%')->where('accepted', 1)->orderBy('slang', 'ASC')->paginate(10);
        if ( $slangsGet->count() > 0 ) {
            return view('slangs.letter.index')->with('slangs', $slangs)->with('letter', $letter);
        } else {
            return view('slangs.letter.index')->with('exist', 0)->with('letter', $letter);
        }
    }

    public function tag($tag)
    {
        $tags = Tag::where('link', $tag)->get();
        $slangs = [];
        foreach ( $tags as $tag ) {
            $tagName = $tag -> tag;
            array_push($slangs, $tag -> slang_id);
        }
        $slangsDb = Slang::whereIn('id', $slangs)->where('accepted', 1)->orderBy('slang', 'ASC')->paginate(10);
        if ( $tags->count() > 0 ) {
            return view('slangs.tag.index')->with('slangs', $slangsDb)->with('tag', $tagName);
        } else {
            return abort(404, 'Podany tag nie istnieje.');
        }
    }

    public function random()
    {
        $slang = Slang::where('accepted', 1)->inRandomOrder()->get();
        return redirect('/slang/' . $slang[0] -> link)->with('slang', $slang[0]);
    }

    public function voteUp($id)
    {
        $slang = Slang::findOrFail($id);
        $voteUp = Vote::where('ip', request()->ip())->where('slang_id', $id)->where('vote', 1)->get();
        $voteDown = Vote::where('ip', request()->ip())->where('slang_id', $id)->where('vote', 0)->get();

        if ( $voteUp->count() == 0 ) {
            $vote = new Vote;
            $vote -> slang_id = $id;
            $vote -> ip = request()->ip();
            $vote -> vote = 1;
            $vote -> save();

            if ( $voteDown->count() != 0 ) {
                $voteDel = Vote::findOrFail($voteDown[0]->id);
                $voteDel->delete();
            }

            Session::flash('success', 'Pomyślnie oddałeś swój pozytywny głos dla tego slangu!');
            return redirect('/slang/' . $slang -> link);
        } else {
            Session::flash('error', 'Oddałeś już swój pozytywny głos dla tego slangu!');
            return redirect('/slang/' . $slang -> link);
        }

    }

    public function voteDown($id)
    {
        $slang = Slang::findOrFail($id);
        $voteUp = Vote::where('ip', request()->ip())->where('slang_id', $id)->where('vote', 1)->get();
        $voteDown = Vote::where('ip', request()->ip())->where('slang_id', $id)->where('vote', 0)->get();

        if ( $voteDown->count() == 0 ) {
            $vote = new Vote;
            $vote -> slang_id = $id;
            $vote -> ip = request()->ip();
            $vote -> vote = 0;
            $vote -> save();

            if ( $voteUp->count() != 0 ) {
                $voteDel = Vote::findOrFail($voteUp[0]->id);
                $voteDel->delete();
            }

            Session::flash('success', 'Pomyślnie oddałeś swój negatywny głos dla tego slangu!');
            return redirect('/slang/' . $slang -> link);
        } else {
            Session::flash('error', 'Oddałeś już swój negatywny głos dla tego slangu!');
            return redirect('/slang/' . $slang -> link);
        }

    }

    public function acceptSlangs()
    {
        if ( auth()->user()->hasRole('admin') ) {
            $slangs = Slang::where('accepted', 0)->paginate(10);
            return view('slangs.accept.index')->with('slangs', $slangs);
        } else {
            return abort(403);
        }
    }

    public function accept($id)
    {
        if ( auth()->user()->hasRole('admin') ) {
            $slang = Slang::findOrFail($id);
            $slang -> accepted = 1;
            $slang -> save();
            return redirect('/slang/acceptslangs')->with('success', 'Slang został pomyślnie zaakceptowany!');
        } else {
            return abort(403);
        }
    }

    public function decline($id)
    {
        if ( auth()->user()->hasRole('admin') ) {
            $slang = Slang::findOrFail($id);
            $slang->delete();
            return redirect('/slang/acceptslangs')->with('success', 'Slang został pomyślnie odrzucony!');
        } else {
            return abort(403);
        }
    }

    public function create()
    {
        return view('slangs.create.index');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
          'slang' => 'required|min:2|max:128|unique:slangs',
          'description' => 'required|min:16|max:512',
          'example' => 'max:512',
          'tags' => 'required'
        ]);

        $slang = new Slang;
        $slang -> user_id = Auth::id();
        $slang -> slang = $request -> slang;
        $slang -> description = $request -> description;
        $slang -> example = $request -> example;
        $slang -> link = str_slug($slang -> slang, '-');

        if ( auth()->user()->hasRole(['verified', 'admin']) ) {
            $slang -> accepted = 1;
        } else {
            $slang -> accepted = 0;
        }

        $slang->save();

        $tags = explode(',', $request->tags);
        foreach ( $tags as $tagForm ) {
            $tag = new Tag;
            $tag -> slang_id = $slang -> id;
            $tag -> tag = $tagForm;
            $tag -> link = str_slug($tagForm, '-');
            $tag->save();
        }

        if ( $slang -> accepted == 1 ) {
            return redirect('/slang/' . $slang -> link);
        } else {
            return redirect('/')->with('success', 'Twój slang został przesłany do zaakceptowania przez naszych administratorów. O wyniku akceptacji poinformujemy Cię mailowo.');
        }
    }

    public function edit($link)
    {
        $slang = Slang::where('link', $link)->get();
        if ( $slang[0] -> user_id == auth()->id() || auth()->user()->hasRole('admin') ) {
            return view('slangs.edit.index')->with('slang', $slang[0]);
        } else {
            return abort(403);
        }
    }

    public function update($id, Request $request)
    {
        $slangDb = Slang::find($id)->get();
        if ( $slangDb[0] -> user_id == auth()->id() || auth()->user()->hasRole('admin') ) {

            $validatedData = $request->validate([
              'slang' => 'required|min:2|max:128|unique:slangs,slang,' . $id,
              'description' => 'required|min:16|max:512',
              'example' => 'max:512'
            ]);

            $slang = Slang::find($slangDb[0] -> id);
            $slang -> slang = $request -> slang;
            $slang -> description = $request -> description;
            $slang -> example = $request -> example;
            $slang -> link = str_slug($slang -> slang, '-');

            $slang->save();

            $tags = explode(',', $request->tags);
            foreach ( $tags as $tagForm ) {
                $tag = new Tag;
                $tag -> slang_id = $slang -> id;
                $tag -> tag = $tagForm;
                $tag -> link = str_slug($tagForm, '-');
                $tag->save();
            }

            return redirect('/slang/' . $slang -> link);

        } else {
            return abort(403);
        }
    }
}
