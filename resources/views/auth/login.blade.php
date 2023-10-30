@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('titulo')
Inicio de Sesion
@endsection

@section('contenido')
    <div class="wrapper">
      <div class="container main">
        <div class="row ">
          <div class="col-md-6 side-image">
            <img src="{{asset('img/logo.jfif')}}" alt="">
          </div>
          <div class="col-md-6 right">
            <form class="input-box"  action="{{route('login')}}" method="POST">
              <h4>Bienvenido a Warmi'A</h4>
              <p class="">Por favor ingrese sus datos para Iniciar Sesion</p>
              <div class="form-floating mb-3">
                <input type="text" class="form-control" name="dni" id="dni" placeholder="dni">
                <label for="dni">DNI *</label>
              </div>
              <div class="form-floating mb-3">
                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                <label for="password">Contraseña *</label>
              </div>
              <div class="d-grid">
                <button class="btn btn-lg btn-primary btn-login mb-2" type="submit">Iniciar Sesión</button>
              <div class="home">
                <span>Volver al Inicio? <a href="/">Presione Aquí</a> </span>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
@endsection