<?php
namespace App\Http\Controllers\Admin;
use App\Post;
use App\Tag;
use App\Category;
use Carbon\Carbon;
use Illuminate\Support\Str;
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
       // dd($request->has('published_at'));
        $this->validate($request, [
            'title'=>'required',
            'body'=>'required',
            'category'=>'required',
            'tags'=>'required',
            'excerpt'=>'required'

        ]    
        );
    	//return $request->all();
    	//return Post::create($request->all());
       // dd($request->get('tags')); // es para realizar pruebasb
    	$post = new Post;
    	$post->title = $request->get('title');
    	$post->url = str::slug($request->get('title'), '-');
    	$post->body = $request->get('body');
    	$post->excerpt = $request->get('excerpt');
    	$post->published_at = $request->has('published_at') ? Carbon::parse($request->get('published_at')) : null;
    	$post->category_id = $request->get('category');
    	//etiquetas

    	$post->save();

    	$post->tags()->attach($request->get('tags'));

    	return back()->with('flashh', 'El post fue creado correctamente');
 	
    	
    }

}


