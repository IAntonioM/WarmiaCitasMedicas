@extends('layouts.sessionApp')
@section('titulo')
    Home
    
@endsection

@section('contenido')


@role('administrador')
Contenido administrador
@endrole
@role('Medico')
Contenido Medico
@endrole
@role('Recepcionista')
Contenido Recepcionista
@endrole
@endsection