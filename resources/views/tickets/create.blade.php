@extends('layouts.appticket')
@section('nombre')
Ingresar Ticket
@endsection
@section('links')
<script src="{{ asset('js/jquery-3.3.1.min.js')}}"></script>
<script src="{{ asset('js/jquery.min.js')}}"></script>
<link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"> --}}
<link rel="stylesheet" href="/css/inventario.css">
<link rel="stylesheet" href="/css/style-mc.css">
@endsection
@section('content')
@auth
<div class="container">
    <h3>Nuevo Ticket</h3>
    <p><span style="color:red">*</span><span class="campoObligatorio">Campo obligatorio</span></p>
    <form method="POST" action="{{route('tickets.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label class="col-form-label">Código <span style="color:red">*</span></label>
            <input type="text" name="codigo" class="form-control">
        </div>
        <div class="form-group">
            <label class="col-form-label">Estado <span style="color:red">*</span></label>
            <select class="custom-select" name="estado">
                <option selected="">Opciones de Estados</option>
                <option value="Pendiente Revision">Pendiente Revisión</option>
                <option value="Cotizacion">Cotización</option>
                <option value="Pendiente Reparacion">Pendiente Reparación</option>
                <option value="Pendiente Pago">Pendiente Pago</option>
                <option value="Finalizado">Finalizado</option>
            </select>
        </div>
        <div class="form-group">
            <label class="col-form-label">Fecha de Inicio <span style="color:red">*</span></label>
            <input type="text" name="fecha_inicio" class="form-control datepicker" placeholder="dd/MM/aaaa">
        </div>
        <div class="form-group">
            <label class="col-form-label">Comentario </label>
            <input type="text" name="comentario" class="form-control" placeholder="Comentario">
        </div>
        <div class="form-group">
            <label class="col-form-label">Serie de Máquina <span style="color:red">*</label>
            <select class="custom-select" name="serie">
                <option selected="">Selecciona</option>
                @foreach ($maquinas as $key => $maquina)
                    <option value="{{$maquina->serie}}">{{$maquina->serie}}</option>
                @endforeach
            </select>
        </div>
        <br>
        <h4>Servicios</h4>
        <label class="col-form-label">Seleccione los servicios que desea agregar: </label>
        <div class="form-group">
            <label class="col-form-label">Arrendamiento <span style="color:red">*</span></label>
            <input type="number" max="9999" class="form-control" name="arrendamiento" placeholder="0.00" min="0" step="0.01" value="0.00">
        </div>
        <div class="form-group">
            <label class="col-form-label">Reparación y Mantenimiento de Fotocopiadora <span style="color:red">*</span></label>
            <input type="number" max="9999" class="form-control" name="reparacionfc" placeholder="0.00" min="0" step="0.01" value="0.00">
        </div>
        <div class="form-group">
            <label class="col-form-label">Reparación y Mantenimiento de Computadora <span style="color:red">*</span></label>
            <input type="number" max="9999" class="form-control" name="reparacionpc" placeholder="0.00" min="0" step="0.01" value="0.00">
        </div>
        <br>
        <button type="submit" class="btn btn-success guardar">Ingresar Ticket</button>
        <a href="/tickets" class="btn btn-danger">Cancelar</a>
    </form><br>
</div>
@section('script')
<script src="{{ asset('js/jquery-1.12.4.js') }}"></script>
<script src="{{ asset('js/jquery-ui.js') }}"></script>
<script>
$(function() {
    $(".datepicker").datepicker({
        dateFormat: '{{ config('app.date_format_js') }}',
    });
});
</script>
@endsection
@endauth
@endsection