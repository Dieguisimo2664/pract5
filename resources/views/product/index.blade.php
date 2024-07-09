@extends('home')

@section('content')


<div class="row">
    
    <div class="col-md-2"></div>
    <div class="col-md-8">

        <br><br>
        <h1>LISTA DE CONTACTOS</h1><br>

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create">
            Nuevo
        </button>

        <div class="table-responsive">
            <table class="table table-primary">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NOMBRE</th>
                        <th>TELEFONO</th>
                        <th>DIRECCION</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($products as $product)

                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->nombre }}</td>
                        <td>{{ $product->telefono }}</td>
                        <td>{{ $product->direccion }}</td>
                        <td>
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#edit{{$product->id}}">EDITAR</button>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete{{$product->id}}">BORRAR</button>
                        </td>
                    </tr>

                    @include('product.modal-info')
                    @endforeach
                
                </tbody>

            </table>
        </div>

        @include('product.modal-create')

    </div>
    <div class="col-md-2"></div>

</div>






@endSection