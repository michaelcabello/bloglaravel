<?php

namespace App\Http\Controllers\Admin;
use App\Post;
use App\Photo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PhotosController extends Controller
{
    public function store(Post $post)
    {
       // return 'procesando';
    	$this->validate(request(), [
    		'photo' => 'required|image|max:2048'
    	]);

    	$photo = request()->file('photo')->store('public');
    	//$photoUrl = $photo->store('public');

    	//$photoUrl = Storage::url($photo);

    	Photo::create([
    		'url' => Storage::url($photo),
    		'post_id' => $post->id

    	]);
    }


    public function destroy(Photo $photo)
    {
        $photo->delete();
        
        $photoPath = str_replace('storage','public',$photo->url);

        Storage::delete($photoPath);

        return back()->with('flashh','Foto Eliminada');

    }


}
 