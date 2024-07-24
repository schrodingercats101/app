<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Manufacture;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Photo;
use App\Models\Kind;

class UserController extends Controller
{
    public function index()
    {
        $users  = User::withTrashed()->paginate(15);
        return view('admin.users.index',compact('users'));
    }

    public function edit($id)
    {
        $photos = Photo::where('user_id',$id)->get();
        return view('admin.users.edit',compact('photos'));
    }

    public function destroy($id)
    {
       $user = User::findOrFail($id);
       $user->delete();

       return redirect()->route('admin.users.index');
    }

    public function restore($id){
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();

        return redirect()->route('admin.users.index');
    }

    public function retrieve(Request $request)
    {
        if(!empty($request->retrieve)){
            $users = User::withTrashed()->where('name','LIKE',"%$request->retrieve%")->orWhere('email','LIKE',"%$request->retrieve%")->paginate(15);
        }else{
            $users = User::withTrashed()->paginate(15);
        }
        return view('admin.users.index',compact('users'));
    }
}
