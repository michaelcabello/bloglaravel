<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	//protected $guarded = [];//para desactivar la asignacion masiva	
    protected $fillable = [
         'title', 'body', 'iframe', 'excerpt', 'published_at', 'category_id'
    ];

    protected $dates = ['published_at'];//para que sea instancia de carbon


    public function getRouteKeyName()
    {
        return 'title';
        //return ('title');
    }

    //de muchos a uno
    public function category()//$post->$category->$name
    {
    	return $this -> belongsto(Category::class);
    }

    //muchos a muchos
    public function tags()
    {
    	return $this -> belongstoMany(Tag::class);	

    }

    //de uno a muchos
    public function photos()
    {
        return $this -> hasMany(Photo::class);  

    }


    public function scopePublished($query)
    {
         $query->WhereNotNull('published_at')
                  -> where ('published_at', '<=', Carbon::now())
                  -> latest('published_at');

    }

        //mutador se declara con set
    public function setTitleAttribute($title)
    {
        $this->attributes['title'] = $title;
        $this->attributes['url'] = str::slug($title, '-');
    }



        //mutador se declara con set
    public function setPublishedAtAttribute($published_at)
    {
        $this->attributes['published_at'] = $published_at ? Carbon::parse($published_at) : null;
        
     }   


    public function setCategoryIdAttribute($category)
    {
        $this->attributes['category_id'] = Category::find($category)
                              ? $category
                              : Category::create(['name' => $category])->id;
        
     } 

     public function syncTags($tags)
     {

        $tagIds = collect($tags)->map(function($tag){
            return Tag::find($tag) ? $tag : Tag::create(['name' => $tag])->id;  

        });

        return $this->tags()->sync($tagIds);
     }



}
