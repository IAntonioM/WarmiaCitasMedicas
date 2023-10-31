@extends('layouts.sessionApp')
@section('titulo')
    Registrar Paciente
@endsection

@section('contenido')
<form class="needs-validation" novalidate>
    <div class="row g-3">
      <div class="col-sm-6">
        <label for="nombres" class="form-label">Nombres *</label>
        <input type="text" class="form-control" id="nombres" placeholder="" value="" required>
        <div class="invalid-feedback">
          Valid first name is required.
        </div>
      </div>

      <div class="col-sm-6">
        <label for="apellidos" class="form-label">Apellidos *</label>
        <input type="text" class="form-control" id="apellidos" placeholder="" value="" required>
        <div class="invalid-feedback">
          Valid last name is required.
        </div>
      </div>


      <div class="col-4">
        <label for="dni" class="form-label">DNI *</label>
        <input type="number" class="form-control" id="dni" placeholder="">
        <div class="invalid-feedback">
          Please enter a valid email address for shipping updates.
        </div>
      </div>

      <div class="col-8">
        <label for="fechaNac" class="form-label">Fecha Nacimiento *</label>
        <input type="date" class="form-control" id="fechaNac" placeholder="" required>
        <div class="invalid-feedback">
          Please enter your shipping address.
        </div>
      </div>

      <div class="col-6">
        <label for="address2" class="form-label">Dirección *</label>
        <input type="text" class="form-control" id="address2" placeholder="">
      </div>
      <div class="col-6">
        <label for="address2" class="form-label">Telefono *</label>
        <input type="text" class="form-control" id="address2" placeholder="">
      </div>

      
    <hr class="my-4">
    <a class="btn btn-primary btn-lg" type="submit">Volver</a>
    <button class="btn btn-primary btn-lg" type="submit">Registrar Paciente</button>
  </form>


  
@endsection