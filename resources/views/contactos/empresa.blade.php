@extends('layouts.appticket')
@section('nombre')
  Empresa
@endsection
@section('links')
  <meta charset="utf-8">
  <title>MagicCopy</title>
  <link rel="stylesheet" href="/css/contacto.css">

@endsection
@section('content')
 @auth

 {{-- Comienzo Add Modal --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ingresar Empresa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <p><span style="color:red">*</span> <span class="campoObligatorio">Campo obligatorio</span></p>


      <form action="{{ action('EmpresaController@store') }}" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          {{ csrf_field() }}

            <div class="form-group">
              <label>Nombre<span style="color:red">*</span> </label>
              <input type="text" name="nombre" class="form-control" placeholder="Ingrese el nombre de la Empresa">
            </div>

            <div class="form-group">
              <label>NIT<span style="color:red">*</span> </label>
              <input type="text" name="nit" class="form-control" placeholder="9999-999999-999-9">
            </div>
            
            <div class="form-group">
              <label>Registro<span style="color:red">*</span> </label>
              <input type="text" name="registro" class="form-control" placeholder="99999-9">
            </div>

            <div class="form-group">
              <label>Giro<span style="color:red">*</span> </label>
              <input type="text" name="giro" class="form-control" placeholder="Ingrese el giro de la Empresa">
            </div>
            
            <div class="form-group">
              <label>Direccion<span style="color:red">*</span> </label>
              <input type="text" name="direccion" class="form-control" placeholder="Ingrese la direccion de la Empresa">
            </div>

            <div class="form-group">
              <label>Correo<span style="color:red">*</span> </label>
              <input type="text" name="correo" class="form-control" placeholder="Ingrese el correo de la Empresa">
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
{{-- Final Add Modal --}}

{{-- Comienzo Add Modal --}}
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar Empresa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <p><span style="color:red">*</span> <span class="campoObligatorio">Campo obligatorio</span></p>

      <form action="/empresa" method="POST" id="editForm" enctype="multipart/form-data">
        <div class="modal-body">
          @method('PUT')
          @csrf

            <div class="form-group">          
              <label>Nombre<span style="color:red">*</span> </label>
              <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ingrese el nombre de la Empresa">
            </div>

            <div class="form-group">
              <label>NIT<span style="color:red">*</span> </label>
              <input type="text" name="nit" id="nit" class="form-control" placeholder="Ingrese el NIT de la Empresa">
            </div>

            <div class="form-group">
              <label>Registro<span style="color:red">*</span> </label>
              <input type="text" name="registro" id="registro" class="form-control" placeholder="Ingrese el registro de la Empresa">
            </div>

            <div class="form-group">
              <label>Direccion<span style="color:red">*</span> </label>
              <input type="text" name="direccion" id="direccion" class="form-control" placeholder="Ingrese la direccion de la Empresa">
            </div>

            <div class="form-group">
              <label>Giro<span style="color:red">*</span> </label>
              <input type="text" name="giro" id="giro" class="form-control" placeholder="Ingrese el giro de la Empresa">
            </div>

            <div class="form-group">
              <label>Correo<span style="color:red">*</span> </label>
              <input type="text" name="correo" id="correo" class="form-control" placeholder="Ingrese el correo de la Empresa">
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
{{-- Final Edit Modal --}}



  <div class="container">
    <br>
      <h1 class="principal">Listado de Empresas </h1>

      <input type="text" id="buscar" class="buscador sombra" placeholder="Buscar Empresa...">

      <br><br>


      <button type="button" class="btn btn-success ingresar" data-toggle="modal" data-target="#exampleModal">
        Ingresar Empresa
      </button>
      <a href="/contacto" class="btn btn-info"> Regresar </a>
      <br><br>

                <table id="datatable" class="table table-striped">
                
        <thead>
          <tr>
          <th scope="col" class="colorth ocultar">ID</th>
            <th scope="col" class="colorth">Nombre</th>
            <th scope="col" class="colorth">NIT</th>
            <th scope="col" class="colorth">Registro</th> 
            <th scope="col" class="colorth">Giro</th>
            <th scope="col" class="colorth">Direccion</th> 
            <th scope="col" class="colorth">Correo</th>          
            <th scope="col" class="colorth">Accion</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($empresa as $empresas)
      <tr>
              <td class="ocultar"> {{ $empresas->id }} </td>
              <td> {{ $empresas->nombre }} </td> 
              <td> {{ $empresas->nit }} </td> 
              <td> {{ $empresas->registro }} </td> 
              <td> {{ $empresas->giro }} </td>
              <td> {{ $empresas->direccion }} </td>
              <td> {{ $empresas->correo }} </td>      
                                                  
              <td>
                <a href="#"  class="edit actualizar"><i  class="fas fa-edit"></i></a>
              </td>
      </tr>
      @endforeach
      </tbody>
      </table>
  </div>

@section('script')
  <script src="js/buscar.js"></script>
  <script src="js/actualizarEmpresa.js"></script>
@endsection

@endauth

@endsection