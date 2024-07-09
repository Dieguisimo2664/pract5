<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">NUEVO CONTACTO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action=" {{route('home.store')}} " method="post" enctype="multipart/form-data">
        @csrf
      <div class="modal-body">

            <label for="">Nombre</label>
            <input type="text" name="nombre" id="" class="form-control">
            <label for="">Telefono</label>
            <input type="text" name="telefono" id="" class="form-control">
            <label for="">Direccion</label>
            <input type="text" name="direccion" id="" class="form-control">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>

    </div>
    </form>
  </div>
</div>