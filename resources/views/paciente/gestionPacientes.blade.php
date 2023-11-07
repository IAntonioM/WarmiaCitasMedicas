@extends('layouts.sessionApp')
@section('titulo')
    Gestion de Pacientes
    
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
        <div class="mb-4">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNewModal">Agregar Paciente <i class="fa-solid fa-square-plus"></i></button>
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombres</th>
                <th>DNI</th>
                <th>F. de Nacimiento</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pacientes as $paciente)
            <tr>
                <td>{{ $paciente->id }}</td>
                <td>{{ $paciente->nombres }} {{ $paciente->apellidos }}</td>
                <td>{{ $paciente->dni }}</td>
                <td>{{ $paciente->fechaNacimiento }}</td>
                <td>{{ $paciente->direccion }}</td>
                <td>{{ $paciente->telefono }}</td>
                <td class="">
                    <button  class="btn btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#modal1">Editar <i class="fas fa-edit"></i></button>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal2">Eliminar <i class="fa-solid fa-circle-xmark"></i></button>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            
        </tfoot>
    </table>
    @include('paciente.registrarPaciente')
    @include('paciente.editarPaciente')
    @include('paciente.eliminarPaciente')
@endsection