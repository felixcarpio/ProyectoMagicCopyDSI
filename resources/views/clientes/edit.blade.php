@extends('layouts.appticket')
@section('nombre')
Editar Cliente
@endsection
@section('links')
@endsection
@section('content')
@auth
<div class="container">
    <h3>Actualizar Cliente</h3>
    <p><span style="color:red">*</span><span class="campoObligatorio">Campo obligatorio</span></p>
    <form method="POST" action="{{route('clientes.update',$cliente->id)}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label class="col-form-label">Nombre de Cliente: <span style="color:red">*</span></label>
            <input type="text" name="nombre" class="form-control" value="{{$cliente->nombre}}">
            <label class="col-form-label">Apellido de Cliente: <span style="color:red">*</span></label>
            <input type="text" name="apellido" class="form-control" value="{{$cliente->apellido}}">
            <label class="col-form-label">Correo de Cliente: <span style="color:red">*</span></label>
            <input type="text" name="correo" class="form-control" value="{{$cliente->correo}}">
            <label class="col-form-label">DUI de Cliente: </label>
            <input type="text" name="dui" class="form-control" value="{{$cliente->dui}}">
            <label class="col-form-label">Dirección de Cliente: <span style="color:red">*</span></label>
            <input type="text" name="direccion" class="form-control" value="{{$cliente->direccion}}">
            <label class="col-form-label">Nombre de Empresa: </label>
            <input type="text" name="nombre_empresa" class="form-control" value="{{$cliente->nombre_empresa}}">
            <label class="col-form-label">Giro de la empresa: </label>
            <input type="text" name="giro" class="form-control" value="{{$cliente->giro}}">
            <label class="col-form-label">NIT: </label>
            <input type="text" name="nit" class="form-control" value="{{$cliente->nit}}">
            <label class="col-form-label">Registro: </label>
            <input type="text" name="registro" class="form-control" value="{{$cliente->registro}}">
            <label class="col-form-label">Telefono: <span style="color:red">*</span></label>
            <input type="text" name="telefono" class="form-control" value="{{$cliente->telefono}}">
            <label class="col-form-label">Telefono: </label>
            <input type="text" name="telefono2" class="form-control" value="{{$cliente->telefono2}}">


            <br>
                <button type="submit" class="btn btn-success guardar">Guardar</button>
                <a href="/clientes" class="btn btn-danger">Cancelar</a>
            </div>
        </form>
    </div>            


            <!-- Inicio tabla telefono 
            <div class="form-group">
                <label class="col-form-label">Teléfono: <span style="color:red">*</span></label>
            </div>
            <div class="panel panel-footer">
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Número</th>
                            <th><a href="#" class="addRow"><i class="fas fa-plus-circle"></i></a></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="number" max="99999999" step="1" name="numero[]" required="" class="form-control" placeholder="99999999"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <button type="submit" class="btn btn-success guardar">Actualizar</button>
        <a href="/clientes" class="btn btn-danger">Cancelar</a>
        </div>
    </form>-->
</div>
@endauth
@endsection