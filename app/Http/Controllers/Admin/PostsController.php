<?php
namespace App\Http\Controllers\Admin;
use App\Post;
use App\Tag;
use App\Category;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {
    	$posts = Post::all();
    	return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
    	$categories = Category::all();
    	$tags = Tag::all();
    	return view('admin.posts.create', compact('categories','tags'));
    }


	public function store(Request $request)
    {
    	//validacion
    	//return $request->all();
    	//return Post::create($request->all());
    	$post = new Post;
    	$post->title = $request->get('title');
    	$post->url = $request->get('title');
    	$post->body = $request->get('body');
    	$post->excerpt = $request->get('excerpt');
    	$post->published_at = Carbon::parse($request->get('published_at'));
    	$post->category_id = $request->get('category');
    	//etiquetas

    	$post->save();

    	$post->tags()->attach($request->get('tags'));

    	return back()->with('flashh', 'El post fue creado correctamente');
 	
    	
    }

}

