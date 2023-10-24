@extends('layouts.app')

@section('titulo')
    Iniciar Sesión 
@endsection

@section('contenido')
    <form action="{{route('login')}}" method="POST">
    </form>
@endsection