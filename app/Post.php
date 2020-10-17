<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	protected $guarded = [];//para desactivar la asignacion masiva	
    protected $dates = ['published_at'];//para que sea instancia de carbon

    public function category()//$post->$category->$name
    {
    	return $this -> belongsto(Category::class);
    }

    public function tags()
    {
    	return $this -> belongstoMany(Tag::class);	

    }

}
