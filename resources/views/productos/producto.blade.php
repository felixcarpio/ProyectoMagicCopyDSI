@extends('layouts.app')
@section('nombre')
  Producto
@endsection
@section('links')
  <meta charset="utf-8">
  <title>MagicCopy</title>
  <link rel="stylesheet" href="/css/producto.css">

@endsection
@section('content')
  {{-- @auth  --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ingresar Producto</h5><br><br>
        <p><span style="color:red"> *</span> <span class="campoObligatorio">Campo obligatorio</span></p>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ action('ProductoController@store') }}" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          {{ csrf_field() }}

            <div class="form-group">
              <label>Nombre del Producto<span style="color:red">*</span></label>
              <input type="text" name="nombre" class="form-control" placeholder="Ingrese el nombre del producto">
            </div>

            <div class="form-group">
              <label>Descripcion</label>
              <input type="text" name="descripcion" class="form-control" placeholder="Ingrese descripcion del producto">
            </div>

            <div class="form-group">
              <label>Precio<span style="color:red">*</span></label>
              <input type="number" step="0.001" min="0" name="precio" class="form-control" placeholder="Ingrese el precio del producto">
            </div>

            <div class="form-group">
              <label>Precio con Descuento</label>
              <input type="number" step="0.001" min="0" name="precioConDescuento" class="form-control" placeholder="Ingrese el precio con descuento">
            </div>

            <div class="form-group">
              <label>Marca<span style="color:red">*</span></label>
              <select name="marcas_id" class="form-control">
                @foreach ($marcas as $marca)
                    <option value="{{ $marca->id }}">{{ $marca->nombre }}</option>
                @endforeach

              </select>
            </div>

            <div class="form-group">
              <label>Categoria<span style="color:red">*</span></label>
              <select name="categorias_id" class="form-control">
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                @endforeach
              </select>
            </div>

            <label>Proveedor<span style="color:red">*</span><br></label>
            <div class="form-group scroll" >


                @foreach ($proveedores as $proveedor)
              <input type="checkbox" name='proveedor_id[]'

                  value="{{ $proveedor->id }}">

                   {{ $proveedor->nombre}}
                    <br>
                    @endforeach

            </div>

            <div class="form-group">
              <label>Imagen</label>
              <input type="file" name="imagen"  placeholder="Ingrese el nombre de la imagen">
            </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>
</div>

{{-- End Add Modal --}}

<!--Start Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar Producto</h5>
        <p><span style="color:red"> *</span> <span class="campoObligatorio">Campo obligatorio</span></p>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/producto" method="POST" id="editForm" enctype="multipart/form-data">
        <div class="modal-body">
          @method('PUT')
          @csrf
          <div class="form-group">
            <label>Nombre del Producto<span style="color:red">*</span></label>
            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ingrese el nombre del producto">
          </div>

          <div class="form-group">
            <label>Descripcion</label>
            <input type="text" name="descripcion" id="descripcion" class="form-control" placeholder="Ingrese descripcion del producto">
          </div>

          <div class="form-group">
            <label>Precio<span style="color:red">*</span></label>
            <input type="number" step="0.01" min="0" name="precio" id="precio" class="form-control" placeholder="Ingrese el precio del producto">
          </div>

          <div class="form-group">
            <label>Precio con Descuento</label>
            <input type="number" step="0.001" min="0" name="precioConDescuento" id="precioConDescuento" class="form-control" placeholder="Ingrese el precio con descuento del producto">
          </div>


          <div class="form-group">
            <label>Marca<span style="color:red">*</span></label>
            <select name="marcas_id" id="marcas_id[]" class="form-control">
              @foreach ($marcas as $marca)
                  <option value="{{ $marca->id }}">{{ $marca->nombre }}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label>Categoria<span style="color:red">*</span></label>
            <select name="categorias_id" id="categorias_id[]" class="form-control">
              @foreach ($categorias as $categoria)
                  <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
              @endforeach
            </select>
          </div>

          <label>Proveedor<span style="color:red">*</span><br></label>

          <div class="form-group scroll">

              @foreach ($proveedores as $proveedor)
            <input type="checkbox" name='proveedor_id[]' id="proveedor_id[]"

                value="{{ $proveedor->id }}">

                 {{ $proveedor->nombre}}
                  <br>
                  @endforeach
          </div>

          <div class="form-group">
            <label>Imagen</label>
            <input type="file" name="imagen" id="imagen"  placeholder="Ingrese el nombre de la imagen">
          </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Actualizar</button>
        </div>
      </form>
    </div>
  </div>
</div>
</div>

{{-- End Edit Modal --}}



<!-- Start Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header rojo">
      <h5 class="modal-title" id="exampleModalLabel">Eliminar Producto</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <form action="/producto" method="POST" id="deleteForm">

      {{ csrf_field() }}
      {{ method_field('DELETE') }}

      <div class="modal-body">

          <input type="hidden" name="_method" value="DELETE">
            <p>Esta seguro de eliminar el producto? </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-danger">Si! Eliminar Producto</button>
      </div>
    </form>
  </div>
</div>
</div>
<!-- End Delete Modal -->

  <div class="container">
    <br>
      <h1 class="principal"> Productos </h1>

      <input type="text" id="buscar" class="buscador sombra" placeholder="Buscar Producto...">

      <br><br>



      <button type="button" class="btn btn-success ingresar" data-toggle="modal" data-target="#exampleModal">
        Ingresar Producto
      </button>
      <a href="/" class="btn btn-info"> Regresar </a>
      <br> <br>
        <a href="/marca" class="btn btn-success "> Marcas </a>
          <a href="/proveedor" class="btn btn-success "> Proveedores </a>
      <br><br>

                <table id="datatable" class="table table-striped">
        <thead>
          <tr>
            <th scope="col" class="colorth ocultar">ID</th>
            <th scope="col" class="colorth">Nombre</th>
            <th scope="col" class="colorth">Código</th>
            <th scope="col" class="colorth  descripcion">Descripcion</th>
            <th scope="col" class="colorth">Precio</th>
            <th scope="col" class="colorth">Precio Con Descuento</th>
            <th scope="col" class="colorth">Existencias</th>
            <th scope="col" class="colorth">Marca</th>
            <th scope="col" class="colorth">Categoria</th>
            <th scope="col" class="colorth ocultar">Proveedor</th>
            <th scope="col" class="colorth ocultar">Imagen</th>
            <th scope="col" class="colorth">Accion</th>
          </tr>
        </thead>
        <tbody>
              @foreach ($articulo as $articulos)
            <tr>

              <td class="ocultar"> {{ $articulos->id }} </td>
              <td> {{ $articulos->nombre }} </td>
              <td> {{ $articulos->codigo }} </td>
              <td class="descripcion"> {{ $articulos->descripcion }} </td>
              <td> {{ $articulos->precio }} </td>
              <td>{{ $articulos->precio_con_descuento}}</td>
              <td> {{ $articulos->existencias }} </td>
              @foreach ($marcas as $marca)
                @if ($articulos->marcas_id == $marca->id)
                   <td> {{ $marca->nombre }} </td>
                @endif
              @endforeach
              @foreach ($categorias as $categoria)
                @if ($articulos->categorias_id == $categoria->id)
                   <td> {{ $categoria->nombre }} </td>
                @endif
              @endforeach
              <td class="ocultar">
                @foreach ($proveedores as $proveedor)
                      {{ $proveedor->nombre }}
                      @break
                @endforeach
              </td>
              <td class="ocultar">
                  <img class="imagen" src="images/{{$articulos->imagen}}" alt="">
              </td>
              <td>
                <a href="{{ route('producto.mostrar', $articulos->id) }}" class="detalle view"><i class="fas fa-eye"></i></a>
                <a href="#" class="edit actualizar"><i class="fas fa-edit"></i></a>
                <a href="#" class="delete borrar"><i class="fas fa-trash-alt"></i></a>
               </td>
             </tr>
            @endforeach
        </tbody>
      </table>
  </div>
@section('script')
  <script src="js/buscar.js"></script>
  <script src="js/actualizar.js"></script>
@endsection

{{-- @endauth --}}

@endsection
