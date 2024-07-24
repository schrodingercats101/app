<?php

namespace App\Http\Controllers\User;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class LikeController extends Controller
{
    public function like(Request $request)
{
    $user_id = Auth::id();
    $photo_id = $request->photo_id;
    $already_liked = Like::where('user_id', $user_id)->where('photo_id', $photo_id)->first();

    if (!$already_liked) {
        Like::create([
            'user_id' => $user_id,
            'photo_id' => $photo_id,
        ]);
    } else {
        Like::where('photo_id', $photo_id)->where('user_id', $user_id)->delete();
    }
    $likes_count = Like::where('photo_id',$photo_id)->count();
    $param = [
        'likes_count' => $likes_count,
    ];
    return response()->json($param);
}
}
