@extends('layouts.sessionApp')
@section('titulo')
    Gestion de Pacientes
    
@endsection

@section('contenido')
    <hr>
    <div class="d-md-flex justify-content-md-end">
        <form action="{{route("gestionPacientes")}}" method="GET" class="d-flex align-items-center">
            <input type="text" name="busqueda" class="form-control">
            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
        </form>
    </div>
            <div class="mb-4">
                <div class="mb-4">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create">Registrar Paciente <i class="fa-solid fa-square-plus"></i></button>
                    <a class="btn btn-success" href="{{route('gestionPacientes')}}">Recargar <i class="fa-solid fa-rotate-right"></i></a>
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
                            <button class="btn btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#edit{{$paciente->id}}">Editar <i class="fas fa-edit"></i></button>
                            <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#delete{{$paciente->id}}">Eliminar <i class="fa-solid fa-circle-xmark"></i></button>
                        </td>
                    </tr>
                    @include('paciente.editarPaciente')
                    @include('paciente.eliminarPaciente')
                    @endforeach
                </tbody>
            </table>
            <tfoot>
                <tr>
                    <td class="row" colspan="1"> {{$pacientes->links()}} </td>
                </tr>
            </tfoot>
        </div>
    </div>
    
    
    @include('paciente.registrarPaciente')
@endsection
@section('script')
<script>
    @if ($errors->any() || session('open_modal'))
        $(document).ready(function() {
            $('#create').modal('show');
        });
    @endif
</script>
@endsection