@extends('layouts.appticket')
@section('nombre')
  Maquina
@endsection
@section('content')
@auth
<!-- add maquina-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Ingresar Máquina</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="{{ action('MaquinaController@store') }}" method="POST">
                  <div class="modal-body">
                  <p><span style="color:red">*</span> <span class="campoObligatorio">Campo obligatorio</span></p>
                    {{ csrf_field() }}

                    <div class="form-group">


            
<label>Clientes <span style="color:red">*</span></label>
                      <select class="custom-select" name="cliente_id">
          <option disabled selected>Lista de Clientes</option>
          @if($clientes)
            @foreach ($clientes as $cliente)
              <option value="{{ $cliente->id }}"> {{ $cliente->nombre }} </option>
            @endforeach
          @else
            <option>No existen Clientes</option>
          @endif
        </select>

                      <label>Categoria <span style="color:red">*</span></label>
                      <select class="custom-select" name="categoria_id" >
          <option disabled selected>Lista de Categorías</option>
          @if($categorias)
            @foreach ($categorias as $categoria)
              <option value="{{ $categoria->id }}"> {{ $categoria->nombre }} </option>
            @endforeach
          @else
            <option>No existen Categorías</option>
          @endif
        </select>
            
                      <label>Marca <span style="color:red">*</span></label>
                      <input type="text" name="marca"  class="form-control" placeholder="Ingrese la marca de la máquina">
                    
                      <label>Modelo <span style="color:red">*</span></label>
                      <input type="text" name="modelo"  class="form-control" placeholder="Ingrese el modelo de la máquina">

                    <label>Contador <span style="color:red">*</span></label>
                      <input type="number" max="999999999" min='1' name="contador"  class="form-control" placeholder="Ingrese el contador de la máquina">
                    
                    <label>Serie <span style="color:red">*</span></label>
                      <input type="text" name="serie"  class="form-control" placeholder="Ingrese la serie de la máquina">
                
                      <label>Descripcion <span style="color:red">*</span></label>
                      <input type="text" name="descripcion"  class="form-control" placeholder="Ingrese una Descripción">

                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

<!--Start Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Actualizar Máquina</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="/marca" method="POST" id="editForm">
                  <div class="modal-body">
                    @method('PUT')
                    @csrf
                    <div class="form-group">

                    <label>Clientes <span style="color:red">*</span></label>
                      <select class="custom-select" name="cliente_id" id="cliente_id[]">
          <option disabled selected>Lista de Clientes</option>
          @if($clientes)
            @foreach ($clientes as $cliente)
              <option value="{{ $cliente->id }}"> {{ $cliente->nombre }} 
              
              </option>
            @endforeach
          @else
            <option>No existen Clientes</option>
          @endif
        </select>

                      <label>Categoría <span style="color:red">*</span></label>
                      <select class="custom-select" name="categoria_id" id="categoria_id[]">
          <option disabled selected>Lista de Categorías</option>
          @if($categorias)
            @foreach ($categorias as $categoria)
              <option value="{{ $categoria->id }}"> {{ $categoria->nombre}} </option>
            @endforeach
          @else
            <option>No existen Categorias</option>
          @endif
        </select>
                    <label>Marca <span style="color:red">*</span></label>
                      <input type="text" name="marca" id="marca" class="form-control" placeholder="Ingrese la marca de la máquina">
                    
                      <label>Modelo <span style="color:red">*</span></label>
                      <input type="text" name="modelo" id="modelo" class="form-control" placeholder="Ingrese el modelo de la máquina">

                    <label>Contador <span style="color:red">*</span></label>
                      <input type="number" max="999999999" min='1' name="contador" id="contador" class="form-control" placeholder="Ingrese el contador de la máquina">
                    
                    <label>Serie <span style="color:red">*</span></label>
                      <input type="text" name="serie" id="serie" class="form-control" placeholder="Ingrese la serie de la máquina">

                      <label>Descripcion <span style="color:red">*</span></label>
                      <input type="text" name="descripcion" id="descripcion" class="form-control" placeholder="Ingrese una descripcion de la maquina">

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

<h1 class="titulo"> Listado Máquinas </h1>
    <br>

    <input type="text" id="buscar" class="buscador sombra" placeholder="Buscar Cliente...">

<button type="button" class="btn btn-success ingresar" data-toggle="modal" data-target="#exampleModal">
            Ingresar Máquina
          </button>


    <a href="/home" class="btn btn-info btnposi"> Regresar </a>

    <br><br>
    <a href="/categoria" class="btn btn-success btn-recepcion" href="">
      Categoría
    </a>
    <br><br>

<table id="datatable" class="table table-striped">
    <thead>
      <tr>
        <th scope="col" class="colorth ocultar">ID</th>
        <th scope="col" class="colorth">Cliente</th>
        <th scope="col" class="colorth">Categoría</th>
        <th scope="col" class="colorth">Marca</th>
        <th scope="col" class="colorth">Modelo</th>
        <th scope="col" class="colorth">Contador</th>
        <th scope="col" class="colorth">Serie</th>
        <th scope="col" class="colorth">Descripción</th>
        
        <th scope="col" class="colorth" width="10%">Acción</th>
      </tr>
    </thead>
    <tbody>

    @foreach($maquinaContacto as $key => $tabla)
    <tr>
        
        <td class="ocultar"> {{ $tabla->id }} </td>
        <td> {{ $tabla->con_nombre}} </td>    
        <td> {{ $tabla->nombre}} </td>
        <td> {{ $tabla->marca}} </td>
        <td> {{ $tabla->modelo}} </td>
        <td> {{ $tabla->contador}}</td>
        <td> {{ $tabla->serie}} </td>
        <td> {{ $tabla->descripcion}} </td>
        <td width="5%">
        
        <a href="{{ route('maquinas.mostrar', $tabla->id) }}" class="detalle view"><i class="fas fa-eye"></i></a>
          <a href="#" class="edit"><i class="fas fa-edit"></i></a>
        </td>
      </tr>
      
      
      @endforeach

    </tbody>
  </table>

@section('script')
<script src="js/maquina.js"></script>
<script src="js/buscar.js"></script>

<script language="javascript">    
    var tbl = document.getElementById("datatable");
    if (tbl != null) {
        for (var i = 0; i < tbl.rows.length; i++)
            tbl.rows[i].onclick = function () { getval(this);};

    }
    function getval(cel) {
        cel1 = cel.cells[1];
        var sel = document.getElementById('cliente_id[]');
        for (var opt, j = 1; opt = sel[j]; j++) {
            if (opt.innerHTML.trim() == cel1.innerHTML.trim()) {
                sel.selectedIndex = j;
                break;
            } 
        }
        cel2 = cel.cells[2];
        var sel = document.getElementById('categoria_id[]');
        for (var opt, j = 1; opt = sel[j]; j++) {
            if (opt.innerHTML.trim() == cel2.innerHTML.trim()) {
                sel.selectedIndex = j;
                break;
            } 
        }
    }
</script>

@endsection
@endauth
@endsection
 