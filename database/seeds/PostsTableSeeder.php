<?php
use App\Tag;
use App\Post;
use App\Category;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::truncate();
     	Category::truncate();
        Tag::truncate();

     	$category = new Category;
     	$category->name="Categoria 1";
     	$category->save();

     	$category = new Category;
     	$category->name="Categoria 2";
     	$category->save();

        $post = new Post;//agregamos los campos
        $post->title="Mi primer post okok";
        $post->url="Mi-primer-post-kok";
        $post->excerpt="Resumen de Mi primer post okok";
        $post->body="<p>Mi primer post Mi primer post Mi post okok</p>";
        $post->published_at = Carbon::now()->subDays(4);//agrega fecha actual
        $post->category_id=1;
        $post->save();
        $post->tags()->attach(Tag::create(['name'=>'etiqueta 1']));

        $post = new Post;//agregamos los campos
        $post->title="Mi segundo post okok";
        $post->url="Mi-segund-pos-okok";
        $post->excerpt="Resumen de Mi segundo post okok";
        $post->body="<p>Mi segundo post Mi segundo post Mi post okok</p>";
        $post->published_at = Carbon::now()->subDays(3);//agrega fecha actual
        $post->category_id=1;
        $post->save();
        $post->tags()->attach(Tag::create(['name'=>'etiqueta 2']));


        $post = new Post;//agregamos los campos
        $post->title="Mi tercer post okok";
        $post->url="Mi-tercer-post-kok";
        $post->excerpt="Resumen de Mi tercer post okok";
        $post->body="<p>Mi tercer post Mi tercer post Mi post okok</p>";
        $post->published_at = Carbon::now()->subDays(2);//agrega fecha actual
        $post->category_id=1;
        $post->save();
        $post->tags()->attach(Tag::create(['name'=>'etiqueta 3']));



        $post = new Post;//agregamos los campos
        $post->title="Mi cuarto post okok";
        $post->url="Mi-cuarto-post-kok";
        $post->excerpt="Resumen de Mi cuarto post okok";
        $post->body="<p>Mi cuarto post Mi cuarto post Mi post okok</p>";
        $post->published_at = Carbon::now()->subDays(1);//agrega fecha actual
        $post->category_id=2;
        $post->save();

       $post->tags()->attach(Tag::create(['name'=>'etiqueta 4']));


        $post = new Post;//agregamos los campos
        $post->title="Mi quiento post okok";
        $post->url="Mi-quiento-post-okok";
        $post->excerpt="Resumen de Mi quiento post okok";
        $post->body="<p>Mi quiento post Mi quiento post Mi post okok</p>";
        $post->published_at = Carbon::now()->subDays(1);//agrega fecha actual
        $post->category_id=2;
        $post->save();

        $post->tags()->attach(Tag::create(['name'=>'etiqueta 5']));
    }
}
