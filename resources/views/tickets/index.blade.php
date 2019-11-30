@extends('layouts.appticket')
@section('nombre')
  Tickets
@endsection
@section('links')
    <meta charset="utf-8">
    <title>MagicCopy</title>
@endsection
@section('content')
    @auth
        <!-- TABLA DE TICKETS -->
        <div class="container">
            <br>
            <div class="text-center">
                <h1 class="principal">Listado de Tickets</h1>
            </div>
            <br><br>

            <a href="{{route('tickets.create')}}" class="btn btn-success ingresar">
                Ingresar Ticket
            </a>
            <a href="/" class="btn btn-info btnposi">Regresar</a>
            <br><br>
        </div>
        <br>
        <div class="container">
            <table id="datatable" class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th scope="col" class="ocultar">ID</th>
                        <th scope="col">Código</th>
                        <th scope="col">Serie</th>
                        <th scope="col">Categoría</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Fecha Inicio</th>
                        <th scope="col">Fecha Fin</th>
                        <th scope="col">Total</th>
                        <th scope="col" class="ocultar">Comentario</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tickets as $key => $ticket)
                    <tr>
                        <td class="ocultar">{{$ticket->id}}</td>
                        <td>{{$ticket->codigo}}</td>
                        <td>{{$ticket->serie}}</td>
                        <td>{{$ticket->nombre}}</td>
                        <td>{{$ticket->estado}}</td>
                        <td>{{date('d/m/Y', strtotime($ticket->fecha_inicio))}}</td>
                        @if(date('d/m/Y', strtotime($ticket->fecha_fin)) == '31/12/1969')
                            <td></td>
                        @else
                            <td>{{date('d/m/Y', strtotime($ticket->fecha_fin))}}</td>
                        @endif
                        @if(($ticket->total) == 0.00)
                            <td></td>
                        @else
                            <td>${{$ticket->total}}</td>
                        @endif
                        <td class="ocultar">{{$ticket->comentario}}</td>    
                        <td>
                            <a href="{{route('tickets.edit', $ticket->id)}}"><i class="fas fa-edit"></i></a>
                            <a href=""><i class="fas fa-toolbox"></i></a>
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