@extends('layouts.sessionApp')

@section('style')  
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5/main.css' rel='stylesheet' />
@endsection

@section('titulo')
    Calendario de Citas
@endsection

@section('contenido')
<hr>
<div id="calendar" style="width: 100vh"></div>

@endsection


@section('script')  
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5/main.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const calendarEl = document.getElementById('calendar');
    
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth'
            });
    
            calendar.render();
        });
    </script>
@endsection