<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Track;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Albom;
use Auth;

class TrackController extends Controller
{
    public function show_track($id)
    {
        $track = Track::with(['comment', 'user'])->where('id', $id)->first();
        $like = Like::where('track_id', $id)->where('user_id', Auth::user()->id)->first();
        return view('showTrackPage', ['track' => $track, 'like' => $like]);
    }

    public function new_comment($id, Request $request)
    {
        $validatedData = $request->validate([
            'comment' => 'required|string',
        ]);

        $theme = Comment::create([
            'user_id' => Auth::user()->id,
            'track_id' => $id,
            'comment' => $request->comment
        ]);
        $theme->save();
        return redirect()->back();
    }

    public function delete_comment($comment_id)
    {
        Comment::where('id', $comment_id)->delete();
        return redirect()->back();
    }
    public function like($track_id)
    {
        $likes = Like::where('user_id', Auth::user()->id)->where('track_id', $track_id)->first();
        if ($likes) {
            Like::where('track_id', $track_id)->where('user_id', Auth::user()->id)->delete();
        } else {
            $like_info = ([
                'user_id' => Auth::user()->id,
                'track_id' => $track_id,
            ]);
            Like::create($like_info);
        }
        return redirect()->back();
    }
    public function delete_track($track_id)
    {
        Track::where('id', $track_id)->delete();
        return view('home', ['tracks' => Track::where('user_id', Auth::user()->id)->get(), 'alboms'=>Albom::with(['user'])->where('user_id', Auth::user()->id)->get(), 'user' => $user = Auth::user()]);
    }
    public function delete_albom($albom_id)
    {
        Albom::where('id', $albom_id)->delete();
        return view('home', ['tracks' => Track::where('user_id', Auth::user()->id)->get(), 'alboms'=>Albom::with(['user'])->where('user_id', Auth::user()->id)->get(), 'user' => $user = Auth::user()]);
    }
    public function show_albom($id)
    {
        
        $newTrack = Like::with('track')->where('user_id', Auth::user()->id)->get();
        $albom = Albom::with('user')->where('id', $id)->first();
        $track_ids = $albom->music;
        if (!empty($track_ids)){            
            $tracks = Track::whereIn('id', $track_ids)->get();
        } else {
            $tracks = null;
        }
        return view('showAlbomPage', ['albom' => $albom, 'newTrack' => $newTrack, 'tracks' => $tracks]);
    }
    public function new_track_in_albom($albom_id, Request $request)
    {
        $album = Albom::find($albom_id);
       
        $track_id = $request->input('track_id');
    
        if (in_array($track_id, $album->music ?? [])) {
            // Track ID already exists in the album's music array
            return redirect()->back()->with('error', 'Track already exists in the album');
        }
    
        $music = $album->music?: [];
        $music[] = $track_id;
        $album->setAttribute('music', $music);
        $album->save();
        return redirect()->back()->with('success', 'Track added to the album');
    }
}
