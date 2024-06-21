<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Track;
use App\Models\Like;
use App\Models\Albom;
use App\Models\User;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($user_id)
    {
        $tracks = Track::where('user_id', $user_id)->get();
        $albom = Albom::with(['user'])->where('user_id', $user_id)->get();
        $user = User::where('id', $user_id)->first();
        return view('home', ['tracks' => $tracks, 'alboms' => $albom, 'user' => $user]);
    }

    public function main()
    {
        $random_traks = Track::with(['user'])->inRandomOrder()->get();
        $liked = Like::with(['user', 'track'])->where('user_id', Auth::user()->id)->get();
        return view('mainPage', ['likes' => $liked, 'random_traks' => $random_traks]);    
    }
    public function search(Request $request) {
        // Поиск
        $word = $request->word;
        $track = Track::where('name', 'like', "%{$word}%")->orderBy('id')->get();
        $albom = Albom::where('name', 'like', "%{$word}%")->orderBy('id')->get();
        return view('search', ['track' => $track, 'albom' => $albom]);
    }
    public function avatar(Request $request)
    {
        $validated = $request->validate([
            'avatar_change' => 'required|image|mimes:jpg,png,jpeg|max:2048'
        ]);
        
        $user = User::where('id', Auth::user()->id)->first();
        $photoPath = $user->photo;
        if (file_exists($photoPath)) {
            unlink($photoPath);
        }

        $name = time(). ".". $request->file('avatar_change')->extension();
        $destination = 'public/avatars';
        $path = $request->file('avatar_change')->storeAs($destination, $name);
        User::where('id', Auth::user()->id)->update([
            'photo' => 'storage/avatars/' . $name
        ]);
    
        return redirect()->back();
    }
}
