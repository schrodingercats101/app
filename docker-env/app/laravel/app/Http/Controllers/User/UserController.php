<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Photo;
use App\Models\Kind;
use App\Models\Like;
use App\Models\Manufacture;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function guest()
    {
        $user_images = Photo::simplePaginate(60);
        return view('user.dashboard', compact('user_images'));
    }
    public function index()
    {
        $user_images = Photo::simplePaginate(60);
        return view('user.dashboard', compact('user_images'));
    }

    public function create()
    {
        $kinds = Kind::get();
        $manufactures = Manufacture::get();
        return view('user.upload',compact('manufactures','kinds'));
    }

    public function getContent(Request $request){
        $manufacture_id = $request['manufacture_id'];
        $type = $request['type'];
        $kinds = Kind::where([
            ['manufacture_id', '=', $manufacture_id],
            ['type', '=', $type],
          ])->get();
        $result = [];
        foreach ($kinds as $kind) {
            $result[$kind->id] = $kind->name;
        }
        return response()->json($result);

    }

    public function searchContent(Request $request){
        $manufacture_name = $request['manufacture_name'];
        $kind_name = $request['kind_name'];
        $manufactures = Manufacture::where('name',$manufacture_name)->get();
        $kinds = Kind::where('name',$kind_name)->get();
        foreach ($kinds as $kind) {
            $result[$kind->id] = $kind->name;
        }
        foreach ($manufactures as $manufacture) {
            $result[$manufacture->id] = $manufacture->name;
        }
        return response()->json($result);
    }

    public function store(Request $request)
    {
            session()->regenerateToken();
            $upload_info = Storage::disk('s3')->putFile('/images', $request->file('file'));
            $path = Storage::disk('s3')->url($upload_info);
            $user_id = Auth::id();
            Photo::create([
                'user_id' => $user_id,
                'path' => $path,
                'manufacture_id'  => $request->manufacture_id,
                'kind_id' => $request->kind_id,
                'name' => $request->name,
                'category' => $request->category,
                'setting' => $request->setting
            ]);

            return redirect()->route('user.upload')->with('message','登録が完了しました。');
    }

    public function photoDetail($id)
    {
        $photo = Photo::with(['manufacture','kind'])->findOrFail($id);
        $like = Like::where([
            ['user_id', '=', Auth::id()],
            ['photo_id', '=', $id],
        ])->get();
                return view('user.detail',compact('photo','like'));
    }
}
