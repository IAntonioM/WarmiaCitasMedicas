@extends('layouts.sessionApp')
@section('titulo')
    Historial Clinico
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
    
    <a class="btn btn-primary" href="{{route('nuevaCita')}}">Nueva Historia <i class="fa-solid fa-square-plus"></i></a>
    <a class="btn btn-success" href="{{route('gestionCitas')}}">Recargar <i class="fa-solid fa-rotate-right"></i></a>
</div>

<table class="table">
    <thead>
        <th>ID</th>
        <th>Titulo</th>
        <th>Paciente</th>
        <th>Medico</th>
        <th>Fecha</th>
        <th>Acciones</th>
    </thead>
    <tbody>
        @foreach ($historiasClinicas as $historiaClinica)
        <tr>
            <td>{{ $historiaClinica->id }}</td>
            <td>{{ $historiaClinica->titulo }}</td>
            <td>{{ $historiaClinica->paciente->nombres }} {{ $historiaClinica->paciente->apellidos }}</td>
            <td> {{ $historiaClinica->created_at->format('Y-m-d') }}</td>
            <td>{{ $historiaClinica->titulo }}</td>
            <td>
                <a href="" class="btn btn-primary">Ver <i class="fa-solid fa-file"></i></a>
            <a href="/descargar-documento-control/{{$historiaClinica->id}}" class="btn btn-info" download><i class="fa-solid fa-download"></i></a>
            <a href="/descargar-documento-control/{{$historiaClinica->id}}" class="btn btn-warning">Editar <i class="fas fa-edit"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $historiasClinicas->links() }}

@endsection