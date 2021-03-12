<?php
namespace App\Http\Controllers\Admin;
use App\Post;
use App\Tag;
use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;


class PostsController extends Controller
{
    public function index()
    {
    	$posts = Post::all();
    	return view('admin.posts.index', compact('posts'));
    }

//    public function create()
//    {
//    	$categories = Category::all();
//    	$tags = Tag::all();
//    	return view('admin.posts.create', compact('categories','tags'));
//    }



    public function store(Request $request)
    {

        $this->validate($request, ['title' => 'required']);
        $post = Post::create(
            //'title' => $request->get('title'), //remmplazamos por el de abajo
            $request->only('title')
            //'url' => str::slug($request->get('title'), '-')

        );



        return redirect()->route('admin.posts.edit', $post);
    }



    public function edit(Post $post)
    {

        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.edit', compact('categories','tags','post'));

    }

    
	public function update(Post $post, StorePostRequest $request)
    {
        $post->update($request->all());
        $post->syncTags($request->get('tags'));
        return redirect()->route('admin.posts.edit', $post)->with('flashh', 'El post fue Guardado Correctamente');
    	//validacion
       // dd($request->has('published_at'));
       /* $this->validate($request, [
            'title'=>'required',
            'body'=>'required',
            'category'=>'required',
            'tags'=>'required',
            'excerpt'=>'required'
        ]    
        );*/
    	//return $request->all();
    	//return Post::create($request->all());
       // dd($request->get('tags')); // es para realizar pruebasb
    	//$post->title = $request->get('title');
    	//$post->url = str::slug($request->get('title'), '-');//le quitamos porque el mutator gravara
    	/*
        $post->body = $request->get('body');
        $post->iframe = $request->get('iframe');
    	$post->excerpt = $request->get('excerpt');
        $post->published_at = $request->get('published_at');
        $post->category_id  = $request->get('category_id');
        $post->save();

        
        */
        

    	//$post->published_at = $request->has('published_at') 
          //                    ? Carbon::parse($request->get('published_at')) 
          //                    : null;
    	//$post->category_id = $request->get('category');
        /*$post->category_id = Category::find($cat = $request->get('category'))
                              ? $cat
                              : Category::create(['name' => $cat])->id;
        */    
    	//etiquetas



    	

        

        /*
        $tags = collect($request->get('tags'))->map(function($tag){
            return Tag::find($tag) ? $tag : Tag::create(['name' => $tag])->id;  

        });
        */

       /* $tags = [];

        foreach ($request->get('tags') as $tag) 
        {
            $tags[] = Tag::find($tag)
                      ? $tag
                      : Tag::create(['name' => $tag])->id;  
        }

        */



    	//$post->tags()->sync($request->get('tags'));
        //$post->tags()->sync($tags);

    	//return back()->with('flashh', 'El post fue Guardado Correctamente');
        
    	
    }



}


