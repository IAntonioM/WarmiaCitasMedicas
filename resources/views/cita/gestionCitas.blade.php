@extends('layouts.sessionApp')
@section('titulo')
    Gestion de Citas

@endsection

@section('contenido')
    <hr>
    <div class="d-md-flex justify-content-md-end">
        <form action="" method="GET" class="d-flex align-items-center">
            <input type="text" name="busqueda" class="form-control">
            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
        </form>
    </div>
    <div class="mb-4">
        <a class="btn btn-primary" href="{{route('registrarCita')}}">Agregar Cita <i class="fa-solid fa-square-plus"></i></a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Código</th>
                <th>Fecha y Hora</th>
                <th>Paciente</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($citas as $cita)
        <tr>
            <td>{{ $cita->id }}</td>
            <td>{{ $cita->fecha }}</td>
            <td>{{ $cita->nombres }} {{ $cita->apellidos }}</td>
            <td>{{ $cita->estado }}</td>
            <td>
                <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#modal1">Detalles <i class="far fa-eye"></i></button>
                <a href="cita/editar/{{ $cita->id }}" class="btn btn-warning">Editar <i class="fas fa-edit"></i></a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    
    @include('cita.verDetallesCita')
@endsection