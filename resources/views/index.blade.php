@extends('layouts.app')
@section('titulo')    
<style>
    body {
        background-image: url("../img/banner-login.jpg");
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-position: center;
        height: 100vh;
        margin: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .logo {
        max-width: 200px; /* Ancho máximo del logotipo */
        margin-bottom: 20px;
    }

    .text-white {
        color: #fff; /* Color del texto en blanco */
    }
</style>
    Pagina principal

@endsection

@section('contenido')
    <hr>
    <div class="text-center">
        <img src="{{asset('img/logo.jfif')}}" alt="Logo de Warmia" class="logo">
        <h1 class="text-white">Bienvenido a Warmia</h1>
        <p class="text-white">Tu plataforma de bienestar y salud</p>
        <a href="/iniciar-sesion" class="btn btn-primary">Ingresar</a>
    </div>
@endsection
