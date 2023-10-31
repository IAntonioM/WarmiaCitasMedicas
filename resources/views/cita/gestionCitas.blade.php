@extends('layouts.sessionApp')
@section('titulo')
    Gestion de Citas
    
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
        <a href="/dashboard/registrar-cita" class="btn btn-primary"">Agregar Cita <i class="fa-solid fa-square-plus"></i></a>
    </div>
    <table class="table">
        <thead>
            <td>Codigo</td>
            <td>Fecha y Hora</td>
            <td>Paciente</td>
            <td>Estado</td>
            <td>Acciones</td>
        </thead>
        <tbody>
            <tr>
                <td>7532</td>
                <td>2023-11-01 09:00 AM</td>
                <td>Brayan Maraiana Salazar Sanchez</td>
                <td>Confirmada</td>
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