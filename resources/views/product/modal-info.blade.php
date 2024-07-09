<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="edit{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">EDITAR CONTACTO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action=" {{route('home.update', $product->id)}} " method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
      <div class="modal-body">

            <label for="">Nombre</label>
            <input type="text" name="nombre" id="" class="form-control" value="{{$product->nombre}}">
            <label for="">Telefono</label>
            <input type="text" name="telefono" id="" class="form-control" value="{{$product->telefono}}">
            <label for="">Direccion</label>
            <input type="text" name="direccion" id="" class="form-control" value="{{$product->direccion}}">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">UPDATE</button>
      </div>

    </div>
    </form>
  </div>
</div>






<!-- MODAL DELETE -->

<div class="modal fade" id="delete{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ELIMINAR CONTACTO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action=" {{route('home.destroy',$product->id)}} " method="post" enctype="multipart/form-data">
        @csrf
        @method('DELETE')
      <div class="modal-body">

        Estas seguro de eliminar a <strong>{{$product->nombre}}</strong>  ?

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">CONFIRMAR</button>
      </div>

    </div>
    </form>
  </div>
</div>