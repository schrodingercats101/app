<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Manufacture;
use App\Models\Kind;

class CameraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cameras = Kind::with('manufacture')->paginate(25);
        return view('admin.camera.index',compact('cameras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $manufactures = Manufacture::get(['id','name']);
        return view('admin.camera.create-camera',compact('manufactures'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Kind::create($request->all());
        return redirect()->route('admin.camera.create')->with('message','追加が完了しました。');
    }
    public function destroy($id)
    {
        $kind = Kind::findOrFail($id);
        $kind->delete();
        return redirect()->route('admin.camera.index');
    }

    public function retrieve(Request $request)
    {
        if(!empty($request->retrieve))
        {

            $keyword = $request->input('retrieve');
            $cameras = Kind::whereHas('manufacture',function($query) use ($keyword){ $query->where('name','LIKE',"%$keyword%");})->orWhere('name','LIKE',"%$request->retrieve%")->paginate(15);
        }else
        {
            $cameras = Kind::with('manufacture')->paginate(25);
        }
        return view('admin.camera.index',compact('cameras'));
    }
}
