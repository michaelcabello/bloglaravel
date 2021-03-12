@extends('admin.layout')


@section('header')
      <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Nuevo Post</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item"><a href="{{ route('admin.posts.index')}}">Posts</a></li>
              <li class="breadcrumb-item active">Nuevo Post</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
@stop

  @push('styles')
    
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.0.1/dropzone.css">
    <link rel="stylesheet" href="/adminlte/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="/adminlte/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="/css/twiter-bootstrap.css">
  @endpush

@section('content')


       


    <form method="POST" action="{{ route('admin.posts.update', $post)}}">
      {{csrf_field()}} {{ method_field('PUT') }}
      <div class="row">

        <div class="col-md-8">
          
          <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Crear una Publicación</h3>
                </div>

                  <!-- /.card-header -->
                <div class="card-body">
                    <div class="form-group {{ $errors->has('title') ? 'text-danger' : '' }}">
                      <label>Titulo de la Publicación</label>
                      <input name="title" value="{{old('title', $post->title)}}" type="text" class="form-control" placeholder="ingrese aquí el título de la publicación">
                      <!-- el segundo parametro del old sirve para pintar en caso este vacio -->
                     <!-- <div class="poner la clase para sombrear solo el mensaje">-->
                      {!! $errors->first('title','<span class="help-block">:message</span>') !!}
                     <!-- </div>-->
                      <!-- le ponemos !! a cambio del { y del }-->
                    </div>

                    

                    <div class="form-group {{ $errors->has('body') ? 'text-danger' : ''}}">
                      <label>Contenido de la Publicación</label>
                      <textarea rows= "10" name="body" id="editor" class="form-control" placeholder="Ingrese la publicación Completa">{{old('body', $post->body)}}</textarea>
                      {!! $errors->first('body','<span class="help-block">:message</span>') !!}
                      
                      
                    </div>  

                    <div class="form-group {{ $errors->has('iframe') ? 'text-danger' : ''}}">
                      <label>Contenido embebido iframe</label>
                      <textarea rows= "2" name="iframe" id="editor" class="form-control" placeholder="Ingrese contenido embebido(iframe) de audio o video">{{old('iframe', $post->iframe)}}</textarea>
                      {!! $errors->first('iframe','<span class="help-block">:message</span>') !!}
                      
                    </div>  


                </div>


           </div>

        </div>

        <div class="col-md-4">
            <div class="card card-primary">
              <div class="card-header">
                   <h3 class="card-title">Crear una Publicación</h3>
              </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Fecha de Publicación:</label>

                    <div class="input-group date">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fa fa-calendar-alt"></i>
                        </span>  
                      </div>
                      <input name="published_at" value="{{old('published_at', $post->published_at ? $post->published_at->format('m/d/Y') : null) }}" type="text" class="form-control pull-right" id="datepicker">
                    </div>
                      <!-- /.input group -->
                </div>
            
              
                <div class="form-group {{ $errors->has('category_id') ? 'text-danger' : ''}}">
                  <label>Categorias</label>
                  <select name="category_id" class="form-control select2">
                    <option value="">Selecciona una categoria</option>
                    @foreach($categories as $category)
                    <option value="{{$category->id}}" 
                            {{ old('category_id',$post->category_id)== $category->id ? 'selected':''}} >{{$category->name}}</option>
                    @endforeach
                  </select>
                   {!! $errors->first('category_id','<span class="help-block">:message</span>') !!}
                </div>
                
                <div class="form-group {{ $errors->has('tags') ? 'text-danger' : ''}}">
                  
                      <label>Etiquetas </label>
                      <!-- var_dump(old('tags')) usar doble llaves-->
                      <select name="tags[]" class="select2" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
                       @foreach($tags as $tag)
                        <option {{collect(old('tags', $post->tags->pluck('id')))->contains($tag->id)? 'selected' : ''}} value="{{$tag->id}}">{{$tag->name}}</option>
                       @endforeach
                       
                      </select>
                      {!! $errors->first('tags','<span class="help-block">:message</span>') !!}
                 
        
                </div>
        
                <div class="form-group {{ $errors->has('excerpt') ? 'text-danger' : ''}}">
                  <label>Resumen de la Publicación</label>
                  <textarea name="excerpt" class="form-control" placeholder="Ingrese resumen de la publicación">
                    {{old('excerpt', $post->excerpt)}}
                  </textarea>
                  {!! $errors->first('excerpt','<span class="help-block">:message</span>') !!}             
                </div>
          		
          		<div class="form-group">
          			<div class="dropzone">
          				
          			</div>

          		</div>
            
              <div class="form-group">
                  <button type='submit' class="btn btn-primary btn-block">Guardar Publicación</button>
                </div>
              </div>


            </div>
        </div> 
      </div>
    </form>
      <div class="row">
            <div class="col-md-12">
              <div class="box box-primary">
              
                
                   @foreach($post->photos as $photo)
                        <form method="POST" action="{{ route('admin.photos.destroy', $photo)}}">
                            {{ method_field('DELETE') }} {{ csrf_field() }}
                            <div class="col-md-2">
                                <button class="btn btn-danger" style="position:absolute"><i class="fas fa-times-circle"></i></button>
                                <img class="img-responsive" src="{{ url($photo->url) }}" alt="">
                            </div>
                        </form>
                    @endforeach         
        
              
              </div>
            </div>
      </div>


@stop





  @push('scripts')
  


  	<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.0.1/min/dropzone.min.js"></script>

    <script src="/adminlte/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script src="/adminlte/plugins/select2/js/select2.full.min.js"></script>

    <script>
        $('#datepicker').datepicker({
          autoclose: true
        });

      $('.select2').select2({
        tags:true
      });

      CKEDITOR.replace('editor');
      CKEDITOR.config.height = 315;

      var myDropzone = new Dropzone('.dropzone',{
     // new Dropzone('.dropzone',{
      	//url:'/',
        url:'/admin/posts/{{ $post->id}}/photos',
      	acceptedFiles: 'image/*',
      	paramName: 'photo',
      	maxFilesiZe: 2,
      	headers:{
      		'X-CSRF-TOKEN': '{{csrf_token()}}'
      	},
      	dictDefaultMessage:'Arrastrar fotos para Subir'
      });

      myDropzone.on('error', function(file, res){
      	var msg = res.photo[0];
      	$('.dz-error-message:last > span').text(msg);
      });

      Dropzone.autoDiscover = false;

    </script>

  @endpush

