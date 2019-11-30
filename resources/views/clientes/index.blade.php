@extends('layouts.appticket')
@section('nombre')
    Clientes
@endsection
@section('links')
    <meta charset="utf-8">
    <title>MagicCopy</title>
@endsection
@section('content')
    @auth
        <!--TABLA DE CLIENTES-->
        <div class="container">
            <br>
            <div class="text-center">
                <h1 class="principal">Listado de Clientes</h1>
            </div>
            <br><br>

            <a href="{{route('clientes.create')}}" class="btn btn-success ingresar">
                Ingresar Cliente
            </a>
            <a href="/" class="btn btn-info btnposi">Regresar</a>
            <br><br>
        </div>
        <br>
        <div class="container">
            <table id="datatable" class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Correo</th>
                        <th scope="col">DUI</th>
                        <th scope="col">Empresa</th>
                        <th scope="col">Dirección</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientes as $key => $cliente)
                    <tr>
                        <td>{{$cliente->id}}</td>
                        <td>{{$cliente->nombre}}</td>
                        <td>{{$cliente->apellido}}</td>
                        <td>{{$cliente->correo}}</td>
                        <td>{{$cliente->dui}}</td>
                        <td>{{$cliente->nombre_empresa}}</td>
                        <td>{{$cliente->direccion}}</td>
                        <td>
                            <a href="{{route('clientes.edit',$cliente->id)}}"><i class="fas fa-edit"></i></a>
                            <a href="#"><i class="fas fa-toolbox"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @section('script')
        <script src="js/ticket.js"></script>
    @endsection
    @endauth
@endsection