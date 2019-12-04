@extends('layouts.appticket')
@section('nombre')
Ingresar Cliente
@endsection

@section('content')
@auth

<div class="container">
    <br>
    <h1 class="principal"> Información del ticket: </h1>
    <br><br>
    <div class="centrado">
      <div class="boton">
        <a href="/tickets" class="btn btn-info"> Regresar </a>
      </div>

      <br><br><br>
      <div class="">
        <h3><strong>Fecha: </strong><label>{{$ticketPdf[0]->fecha_inicio}}</label></h3>
      </div>
      <div class="">
        <h3><strong>Telefono: </strong><label>{{$ticketPdf[0]->telefono}}</label></h3>
      </div>
      <div class="">
        <h3><strong>Cliente: </strong><label>{{$ticketPdf[0]->nom}} {{$ticketPdf[0]->apellido}}</label></h3>
      </div>
  
      <div class="derecha">
        <h3><strong>Direccion: </strong><label>{{$ticketPdf[0]->direccion}}</label></h3>  
      </div>
      <div class="derecha">
        <h3><strong>Correo: </strong><label>{{$ticketPdf[0]->correo}}</label></h3>  
      </div>
      <div class="derecha">
        <h3><strong>DUI: </strong><label>{{$ticketPdf[0]->dui}}</label></h3>  
      </div>
      <div class="derecha">
        <h3><strong>Empresa: </strong><label>{{$ticketPdf[0]->empresa}}</label></h3>  
      </div>
      <div class="derecha">
        <h3><strong>NIT: </strong><label>{{$ticketPdf[0]->nit}}</label></h3>  
      </div>

      <div class="derecha">
        <h3><strong>Equipo: </strong><label>{{$ticketPdf[0]->cat}}</label></h3>  
      </div>  
      <div class="derecha">
        <h3><strong>Serie: </strong><label>{{$ticketPdf[0]->serie}}</label></h3>      
        </div>
      <div class="derecha">
        <h3><strong>Marca: </strong><label>{{$ticketPdf[0]->marca}}</label></h3>    
        </div>
      <div class="derecha">
      <h3><strong>Modelo: </strong><label>{{$ticketPdf[0]->modelo}}</label></h3>    
      </div>
      <div class="derecha">
      <h3><strong>Contador: </strong><label>{{$ticketPdf[0]->contador}}</label></h3>    
      </div>
      <div class="derecha">
        <h3><strong>Comentario del trabajo realizado: </strong><label>{{$ticketPdf[0]->comentario}}</label></h3>  
      </div>
      <div class="derecha">
      <h3><strong>Total a pagar: </strong><label>{{$ticketPdf[0]->total}}</label></h3>    
      </div>
      

      @endauth
      @endsection