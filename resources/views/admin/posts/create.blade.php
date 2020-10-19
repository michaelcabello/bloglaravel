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


@section('content')

 <form method="POST" action="{{ route('admin.posts.store')}}">
  {{csrf_field()}}
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
                  <input name="title" value="{{old('title')}}" type="text" class="form-control" placeholder="ingrese aquí el título de la publicación">
                 <!-- <div class="poner la clase para sombrear solo el mensaje">-->
                  {!! $errors->first('title','<span class="help-block">:message</span>') !!}
                 <!-- </div>-->
                  <!-- le ponemos !! a cambio del { y del }-->
                </div>

                

                <div class="form-group {{ $errors->has('body') ? 'text-danger' : ''}}">
                  <label>Contenido de la Publicación</label>
                  <textarea rows= "10" name="body" id="editor" class="form-control" placeholder="Ingrese la publicación Completa">{{old('body')}}</textarea>
                  {!! $errors->first('body','<span class="help-block">:message</span>') !!}
                  
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
                  <input name="published_at" value="{{old('published_at')}}" type="text" class="form-control pull-right" id="datepicker">
                </div>
                  <!-- /.input group -->
            </div>
        
          
            <div class="form-group {{ $errors->has('category') ? 'text-danger' : ''}}">
              <label>Categorias</label>
              <select name="category" class="form-control">
                <option value="">Selecciona una categoria</option>
                @foreach($categories as $category)
                <option value="{{$category->id}}" 
                        {{ old('category')== $category->id ? 'selected':''}} >{{$category->name}}</option>
                @endforeach
              </select>
               {!! $errors->first('category','<span class="help-block">:message</span>') !!}
            </div>
            
            <div class="form-group {{ $errors->has('tags') ? 'text-danger' : ''}}">
              
                  <label>Etiquetas </label>
                  <!-- var_dump(old('tags')) usar doble llaves-->
                  <select name="tags[]" class="select2" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
                   @foreach($tags as $tag)
                    <option {{collect(old('tags'))->contains($tag->id)? 'selected' : ''}} value="{{$tag->id}}">{{$tag->name}}</option>
                   @endforeach
                   
                  </select>
                  {!! $errors->first('tags','<span class="help-block">:message</span>') !!}
             
    
            </div>
    
            <div class="form-group {{ $errors->has('excerpt') ? 'text-danger' : ''}}">
              <label>Resumen de la Publicación</label>
              <textarea name="excerpt" class="form-control" placeholder="Ingrese resumen de la publicación">
                {{old('excerpt')}}
              </textarea>
              {!! $errors->first('excerpt','<span class="help-block">:message</span>') !!}             
            </div>
      
        
            <div class="form-group">
              <button type='submit' class="btn btn-primary btn-block">Guardar Publicación</button>
            </div>
          </div>


        </div>
    </div> 
</div>
</form>
 


@stop



  @push('styles')
    <link rel="stylesheet" href="/adminlte/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="/adminlte/plugins/select2/css/select2.min.css">
  @endpush

  @push('scripts')
    <script src="/adminlte/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script src="/adminlte/plugins/select2/js/select2.full.min.js"></script>

    <script>
        $('#datepicker').datepicker({
          autoclose: true
        });

      $('.select2').select2();

      CKEDITOR.replace('editor');

    </script>

  @endpush
