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
    <div>
        <a href="" class="btn btn-primary"><i class="fas fa-user-plus"></i> Nueva Cita</a>
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
                <td>Brayan Maraiano Salazar Sanchez</td>
                <td>Confirmada</td>
                <td class="">
                    <a href="" class="btn btn-primary"><i class="far fa-eye"></i></a>
                    <a href="" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                    <a href="" class="btn btn-success"><i class="fa fa-check"></i></a>
                    <a href="" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                </td>
            </tr>
            <tr>
                <td>7532</td>
                <td>2023-11-01 09:00 AM</td>
                <td>Brayan Maraiano Salazar Sanchez</td>
                <td>Confirmada</td>
                <td class="">
                    <a href="" class="btn btn-primary"><i class="far fa-eye"></i></a>
                    <a href="" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                    <a href="" class="btn btn-success"><i class="fa fa-check"></i></a>
                    <a href="" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                </td>
            </tr>
            <tr>
                <td>7532</td>
                <td>2023-11-01 09:00 AM</td>
                <td>Brayan Maraiano Salazar Sanchez</td>
                <td>Confirmada</td>
                <td class="">
                    <a href="" class="btn btn-primary"><i class="far fa-eye"></i></a>
                    <a href="" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                    <a href="" class="btn btn-success"><i class="fa fa-check"></i></a>
                    <a href="" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                </td>
            </tr>
        </tbody>
        <tfoot>
              <nav aria-label="Page navigation">
                <ul class="pagination    ">
                  <li class="page-item disabled">
                    <a class="page-link" href="#" aria-label="Previous">
                      <span aria-hidden="true">&laquo;</span>
                    </a>
                  </li>
                  <li class="page-item active" aria-current="page"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                      <span aria-hidden="true">&raquo;</span>
                    </a>
                  </li>
                </ul>
              </nav>
        </tfoot>
    </table>
@endsection