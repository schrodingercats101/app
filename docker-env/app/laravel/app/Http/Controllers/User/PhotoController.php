<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use App\Models\Manufacture;
use App\Http\Controllers\Controller;
use App\Models\Photo;


class PhotoController extends Controller
{
    public function show()
    {
        $user_id = Auth::id();
        $photos = Photo::where('user_id',$user_id)->get();
        return view('user.profile.photo.show',compact('photos'));
    }

    public function edit(string $id)
    {
        $photo = Photo::with(['manufacture','kind'])->findOrFail($id);
        $manufactures = Manufacture::get();

        return view('user.profile.photo.edit',compact('photo','manufactures'));
    }

    public function update(Request $request,$id)
    {
        $post = Photo::find($id);
        $post->update($request->all());
        return redirect()->route('user.profile.photo.show')->with('編集が完了しました。');
    }

    public function destroy(string $id)
    {
        $photo = Photo::findOrFail($id);
        $path = $photo->path;
        $s3_url = Storage::disk('s3')->url($path);
        $s3_upload_file_name = explode("/images", $s3_url)[1];
        $s3_path = '/images'.'/'.$s3_upload_file_name;
        Storage::disk('s3')->delete($s3_path);
        $photo->delete();
        return redirect()->route('user.profile.photo.show');
    }
}
