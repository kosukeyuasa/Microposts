<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Micropost;
use App\Http\Controllers\Auth;

class FavoritesController extends Controller
{
     public function store(Request $request, $id)
    {
        \Auth::user()->favorite($id);
        return redirect()->back();
    }

    public function destroy($id)
    {
        \Auth::user()->unfavorite($id);
        return redirect()->back();
    }
     public function favoritings($id)
    {
        $user = \Auth::user();
        $micropost = Micropost::find($id);
        $favoritings = $user->favoritings()->paginate(10);
    
        $data = [
            'micropost' => $micropost,
            'favoritings' => $favoritings,
            'user' => $user,
        ];

        $data += $this->counts($user);

        return view('favorites.favoritings', $data );
    }

    public function show($id)
    {
        $user = User::find($id);
        $microposts = $user->microposts()->orderBy('created_at', 'desc')->paginate(10);

        $data = [
            'user' => $user,
            'microposts' => $microposts,
        ];

        $data += $this->counts($user);

        return view('favorites.show', $data);

    }


}
