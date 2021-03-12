<?php

namespace App;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $guarded = [];

    public function getRouteKeyName()
    {
    	//return 'name';
        return 'url';
    }

    public function posts()
    {
    	return $this->hasMany(Post::Class);

    }

    //accesor Name es el nombre del atributo o campo que deseamos modificar
   // public function getNameAtribute($name)
  //  {

  //  	return Str::slug($name, '-');//retornamos la modificación
    	//$slug = Str::slug('Laravel 5 Framework', '-');
  //  }

    //mutador se declara con set
    public function setNameAttribute($name)
    {
    	$this->attributes['name'] = $name;
    	$this->attributes['url'] = str::slug($name, '-');
    }

}
