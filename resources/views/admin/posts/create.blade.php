<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <form method="POST" action="">
  {{csrf_field()}}
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar el Título de la Nueva Publicación</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
            
                  <input name="title" value="{{old('title')}}" type="text" class="form-control" placeholder="ingrese aquí el título de la publicación" required>
                  {!! $errors->first('title','<span class="help-block">:message</span>') !!}
                 <!-- le ponemos !! a cambio del { y del }-->
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button class="btn btn-primary">Crear Publicación</button>
      </div>
    </div>
  </div>
</form>
</div>