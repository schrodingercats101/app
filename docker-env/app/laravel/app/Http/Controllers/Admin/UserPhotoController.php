<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Photo;
use App\Models\Manufacture;
use Illuminate\Support\Facades\Storage;

class UserPhotoController extends Controller
{
    public function photoEdit($id)
    {
        $photo = Photo::with('kind','manufacture')->findOrFail($id);
        // dd($photo);
        $manufactures = Manufacture::get();
        return view('admin.users.edit-photo',compact('photo','manufactures'));
    }
    public function update(Request $request,$id)
    {
        $post = Photo::findOrFail($id);
        $id = $post->user_id;
        $post->update($request->all());
        return redirect()->route('admin.users.edit',compact('id'))->with('message','編集が完了しました。');
    }
    public function destroy(string $id)
    {
        $photo = Photo::findOrFail($id);
        $id = $photo->user_id;
        $path = $photo->path;
        $s3_url = Storage::disk('s3')->url($path);
        $s3_upload_file_name = explode("/images", $s3_url)[1];
        $s3_path = '/images'.'/'.$s3_upload_file_name;
        Storage::disk('s3')->delete($s3_path);
        $photo->delete();
        return redirect()->route('admin.users.edit',compact('id'))->with('message','削除が完了しました。');
    }
}
