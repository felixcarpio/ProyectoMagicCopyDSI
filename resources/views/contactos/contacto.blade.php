@extends('layouts.appticket')
@section('nombre')
  Contacto
@endsection
@section('links')
  <meta charset="utf-8">
  <title>MagicCopy</title>
  <link rel="stylesheet" href="/css/contacto.css">

@endsection
@section('content')
@auth

 <div class="container">
    <br>
      <h1 class="principal">Listado de Contactos </h1>

      <input type="text" id="buscar" class="buscador sombra" placeholder="Buscar Contactos...">

      <br><br>

      <a href=" {{ route('contacto.ingresarc') }} " class="btn btn-success ingresar">
    Ingresar Contacto
      </a>

      <a href="/home" class="btn btn-info"> Regresar </a>
      <br> <br>
        <a href="/empresa" class="btn btn-success ">Ingresar Empresa </a>
      <br><br>

                <table id="datatable" class="table table-striped">

        <thead>
          <tr>
            <th scope="col" class="colorth ocultar">ID</th>
            <th scope="col" class="colorth">Nombre</th>
            <th scope="col" class="colorth">Apellido</th>
            <th scope="col" class="colorth">Correo</th>
            <th scope="col" class="colorth">DUI</th>
            <th scope="col" class="colorth">Direccion</th>
            <th scope="col" class="colorth">Empresa</th>
            <th scope="col" class="colorth">Accion</th>
          </tr>
        </thead>
        <tbody>
              @foreach ($contacto as $contactos)
            <tr>

              <td class="ocultar"> {{ $contactos->id }} </td>
              <td> {{ $contactos->nombre }} </td>
              <td> {{ $contactos->apellido }} </td>
              <td> {{ $contactos->correo }} </td>
              <td> {{ $contactos->dui }} </td>
              <td> {{ $contactos->direccion }} </td>

              <!-- mostrar telefonos 
              @foreach ($telefonos as $telefono)
              @if ($contactos-> id == $telefono->contacto_id)                       
              <td> {{ $telefono->numero }} </td> 
              @endif
              @endforeach
              -->

              @foreach ($empresas as $empresa)
                @if ($contactos-> empresa_id == $empresa->id)
                   <td> {{ $empresa->nombre }} </td>
                @endif
              @endforeach
                           
            <td>
                 <a href="{{ route('contacto.ver', $contactos->id) }}" class="detalle view"><i class="fas fa-eye"></i></a>
                 <a href=" {{ route('contacto.actualizar', $contactos->id) }} " class="edit"><i class="fas fa-edit"></i></a>
          </td>
           </tr>
              @endforeach
        </tbody>
      </table>
  </div>

 
@section('script')
  <script src="js/buscar.js"></script>
  <script src="js/actualizarContacto.js"></script>
@endsection

@endauth

@endsection
