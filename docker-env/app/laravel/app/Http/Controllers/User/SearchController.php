<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kind;
use App\Models\Manufacture;
use App\Models\Photo;
use Illuminate\Support\Facades\Redis;

class SearchController extends Controller
{
    public function search(Request $request){
        $photos = Photo::get();
        $kinds = Kind::get(['manufacture_id','type','name']);
        $manufactures = Manufacture::get(['id','name']);
        // dd($manufactures);
        return view('user.search-photo',compact('kinds','manufactures','photos'));
    }
    public function searchResult(Request $request){
        $kinds = Kind::get(['id','manufacture_id','type','name']);
        $manufactures = Manufacture::get(['id','name']);
        $photos = Photo::get();
        $old = $request->input();
    
        if(!empty($request->category)){
            $photos = $photos->where('category',$request->category);
        }
        if(!empty($request->manufacture_id)){
            $photos = $photos->where('manufacture_id',$request->manufacture_id);
        }
        if(!empty($request->kind_id)){
            $photos = $photos->where('kind_id',$request->kind_id);
        }
        return view('user.search-photo',compact('photos','kinds','manufactures','old'));
    }

    public function searchKind(Request $request){
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
        $manufactures = Manufacture::get();
        return view('user.search-photo',compact('kinds','manufactures','result'));
    }
}
