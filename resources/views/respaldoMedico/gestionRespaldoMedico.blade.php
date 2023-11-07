@extends('layouts.sessionApp')
@section('titulo')
    Respaldo Medico
@endsection

@section('contenido')
<hr>
<div class="d-md-flex justify-content-md-end">
    
    <div class="d-md-flex justify-content-md-end">
        <form action="" method="GET" class="d-flex align-items-center">
            <input type="text" name="busqueda" class="form-control">
            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
        </form>
    </div>
</div>
<div class="mb-4">
    <a class="btn btn-primary" href="{{ route('registrarCita') }}">Agregar Cita <i class="fa-solid fa-square-plus"></i></a>
</div>
<table class="table">
    <thead>
        <th>Codigo</th>
        <th>Fecha y Hora</th>
        <th>Paciente</th>
        <th>Estado</th>
        <th>Acciones</th>
    </thead>
    <tbody>
        <tr>
            <td>7532</td>
            <td>2023-11-01 09:00 AM</td>
            <td>Maria Pasos Robles</td>
            <td>Confirmada</td>
            <td>
                <a href="" class="btn btn-primary">Ver Cita<i class="far fa-eye"></i></a>
                <a href="" class="btn btn-warning">Editar <i class="fa-solid fa-file-pen"></i></a>
                <a href="{{route('registrarRespaldoMedico')}}" class="btn btn-success">Subir <i class="fa-solid fa-file-arrow-up"></i></a>
            </td>
        </tr>
    </tbody>
</table>
@endsection