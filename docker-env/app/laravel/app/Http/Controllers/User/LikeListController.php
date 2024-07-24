<?php
namespace App\Http\Controllers\User;

use App\Models\Like;
use App\Models\Photo;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class LikeListController extends Controller
{
    public function show()
    {
        $user_id = Auth::id();
        $photos = Like::where('user_id',$user_id)->with('photo')->get();
        return view('user.profile.like',compact('photos'));
    }
}
