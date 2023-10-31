@extends('layouts.sessionApp')
@section('titulo')
    Gestion de Pacientes
    
@endsection

@section('contenido')
    <hr>
    <div class="d-md-flex justify-content-md-end">
        <form action="/" method="GET">
            <input type="text" name="busqueda" class="form-control">
            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
        </form>
    </div>
    <div class="mb-4">
        <a href="/dashboard/registrar-paciente" class="btn btn-primary">Agregar Paciente <i class="fa-solid fa-square-plus"></i></a>
    </div>
    <table class="table">
        <thead>
            
            <td>ID</td>
            <td>Nombres</td>
            <td>DNI</td>
            <td>F. de Nacimiento</td>
            <td>Dirección</td>
            <td>Teléfono</td>
            <td>Acciones</td>
        </thead>
        <tbody>
            <tr>
                <td>167</td>
                <td>Brayan Maraiana Salazar Sanchez</td>
                <td>74562458</td>
                <td>1999-11-01</td>
                <td>Av. avenida 123</td>
                <td>978245456</td>
                <td class="">
                    <a href="" class="btn btn-primary">Ver <i class="far fa-eye"></i></a>
                    <a href="" class="btn btn-warning">Editar <i class="fas fa-edit"></i></a>
                </td>
            </tr>
           
        </tbody>
        <tfoot>
              
        </tfoot>
    </table>
@endsection