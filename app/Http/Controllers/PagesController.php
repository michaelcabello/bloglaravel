<?php

namespace App\Http\Controllers;
use App\Post;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home()
    {

    //	$posts = Post::WhereNotNull('published_at')
    //				-> where ('published_at', '<=', Carbon::now())
    //				-> latest('published_at')
    //				->get();
    	
    	//$posts = Post::published()->get();
        //$posts = Post::published()->simplepaginate(1);
        $posts = Post::published()->paginate(2);
    	return view('welcome', compact('posts'));


    }

}

