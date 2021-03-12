  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <form method="POST" action="{{ route('admin.posts.store')}}">
        {{csrf_field()}}
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ingresar Título de la Publicación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                    <div class="form-group {{ $errors->has('title') ? 'text-danger' : '' }}">
                       <!-- <label>Titulo de la Publicación</label>-->
                        <input name="title" value="{{old('title')}}" type="text" class="form-control" placeholder="ingrese aquí el título de la publicación" required>
                       <!-- <div class="poner la clase para sombrear solo el mensaje">-->
                        {!! $errors->first('title','<span class="help-block">:message</span>') !!}
                       <!-- </div>-->
                        <!-- le ponemos !! a cambio del { y del }-->
                    </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button class="btn btn-primary">Crear Publicación</button> <!-- por defecto es submit-->
              </div>
            </div>
          </div>
      </form>
  </div>


