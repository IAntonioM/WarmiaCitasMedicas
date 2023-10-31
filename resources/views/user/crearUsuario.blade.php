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
            <form class="input-box"  action="{{route('crearUsuario')}}" method="POST">
              @csrf
              <h4>Bienvenido a Warmi'A</h4>
              <p class="">Por favor ingrese sus datos para Iniciar Sesion</p>
              <div class="form-floating mb-3">
                <input
                  type="text" 
                  class="form-control @error('nombres')  border border-danger @enderror" 
                  name="nombres" 
                  id="nombres" 
                  placeholder="nombres"
                  value="{{old('nombres')}}"
                >
                <label class=" @error('nombres') text-danger @enderror" for="nombres">Nombres *</label>
                @error('nombres')
                    <p class="text-danger">{{$message}}</p>
                @enderror
              </div>
              <div class="form-floating mb-3">
                <input 
                  type="text" 
                  class="form-control @error('apellidos')  border border-danger @enderror" 
                  name="apellidos" 
                  id="apellidos" 
                  placeholder="apellidos"
                  value="{{old('apellidos')}}"
                >
                <label class=" @error('apellidos') text-danger @enderror"  for="apellidos">Apellidos *</label>
                @error('apellidos')
                    <p class="text-danger">{{$message}}</p>
                @enderror
              </div>
              <div class="form-floating mb-3">
                <input 
                  type="number" 
                  class="form-control @error('dni')  border border-danger @enderror" 
                  name="dni" 
                  id="dni" 
                  placeholder="dni"
                >
                <label class=" @error('dni') text-danger @enderror"  for="dni">DNI *</label>
                @error('dni')
                    <p class="text-danger">{{$message}}</p>
                @enderror
              </div>
              <div class="mb-3">
                <label for="rol" class="form-label">Rol</label>
                <select class="form-select" name="rol" id="rol" required>
                  <option value="none">Seleccione...</option>
                  <option value="administrador">Administrador</option>
                  <option value="medico">Medico</option>
                  <option value="recepcionista">Recepcionista</option>
                </select>
                <div class="invalid-feedback">
                  Please provide a valid state.
                </div>
              </div>
              <div class="form-floating mb-3">
                <input type="password" class="form-control @error('password')  border border-danger @enderror" name="password" id="password" placeholder="Password">
                <label class=" @error('password') text-danger @enderror" for="password">Password *</label>
                @error('password')
                    <p class="text-danger">{{$message}}</p>
                @enderror
              </div>
              
              <div class="form-floating mb-3">
                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirmar Password">
                <label for="password_confirmation">Confirmar Password *</label>
              </div>
              <div class="d-grid">
                <button class="btn btn-lg btn-primary btn-login mb-2" type="submit">Registrar usuario</button>
              <div class="home">
                <span>Volver al Inicio? <a href="/">Registrar Usuario</a> </span>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
@endsection