@extends('layouts.app')
@section('nombre')
  Roles
@endsection
@section('links')
  <title>MagicCopy</title>
@endsection
@section('content')

<div class="panel-title">
    <h1 align="center" style="color: black">Lista de Roles</h1>
</div>
<div class="row">
    <div class="col-sm-9">
        <a class="btn btn-sm btn-danger" href="{{route('home')}}">Regresar</a> 
    </div>
    <div class="col-sm-3" align="right">
        @can('rol.create')
            <a href="{{route('roles.create')}}" class="btn btn-sm btn-success"  style="color: white"><i class="fa fa-fw fa-clipboard-list"></i> Registrar Rol</a>
        @endcan
    </div>
</div>

<br/>
<br/>
<div class="pull-bottom">
    <div class="table-responsive">
        <table id="example" class="display table-hovered table-striped " style="width:100%">
            <thead>
                <tr>
                    <th style="color: black">Rol</th>
                    <th style="color: black">Descripción</th>
                    <th style="color: black">Identificador</th>
                    <th style="color: black">Acciones</th>

                </tr>
            </thead>
            <tbody>
                @foreach($roles as $rol)
                    <tr>
                        <td>{{$rol->name}}</td>
                        <td>{{$rol->description}}</td>
                        <td>{{$rol->slug}}</td>
                        <td>
                            @can('rol.show')
                                <a href="{{route('roles.show',['role' => $rol->id])}}" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i> Ver</a>
                            @endcan
                            @can('rol.edit')
                                <a class="btn btn-sm btn-success" href="{{route('roles.edit', ['role' => $rol->id])}}"><i class="fa fa-fw fa-pencil-alt"></i> Editar</a>
                            @endcan
                            @can('rol.destroy')
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-default2{{$rol->id}}" >
                                    <i class="fa fa-trash" style="color: white"></i> Eliminar
                                </button>
                                <div class="modal fade" id="modal-default2{{$rol->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4>Eliminar Rol</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <form action="{{route('roles.destroy',['role' => $rol->id])}}" method="POST">
                                                {{csrf_field()}}
                                                <input type="hidden" name="_method" value="DELETE">
                                                <div class="modal-body">
                                                    <h4>Realmente desea eliminar el rol: <strong>{{$rol->name}}</strong>?</h4>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-sm btn-secondary pull-left" data-dismiss="modal">Cerrar</button>
                                                    <button type="submit" class="btn btn-sm btn-danger">Si</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready( function () {
        $('#example').DataTable({
            "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                },
        });
    });
</script>

@endsection