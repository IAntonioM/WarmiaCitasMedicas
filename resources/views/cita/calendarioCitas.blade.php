@extends('layouts.sessionApp')

@section('style') 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/main.css">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/locales-all.js"></script>
    
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@endsection

@section('titulo')
    Calendario de Citas,  {{auth()->user()->cargo}} : {{auth()->user()->nombres}} {{auth()->user()->apellidos}} 
@endsection

@section('contenido')
<hr>
<div class="row">
    <div class="col"></div>
    <div class="col-7">
        <div id="calendar"></div>
    </div>
    <div class="col"></div>
</div>
<style>
    .modal-dialog {
        max-width: 30%;
    }
</style>

@endsection

@section('script')  
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let formulario = document.querySelector("form");
            const calendarEl = document.getElementById('calendar');
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: "es",
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,listWeek'
                },
                events: "http://localhost:8000/cita/cita-calendario/Todos/0",
                dateClick: function (info) {
                    formulario.reset();
                    formulario.start.value=info.dateStr;
                    formulario.end.value=info.dateStr;

                    $("#evento").modal("show");
                },
                eventContent: function (arg) {
                    return {
                        html: `
                        <div style="background-color: ${arg.event.backgroundColor}; color: ${arg.event.textColor}; padding: 5px;">
                        <div>${formatHour(arg.event.start)} ${arg.event.title}</div>
                        </div>`,
                    };
                },
            });
            calendar.render();
            document.getElementById("btnGuardar").addEventListener("click", function () {
                const datos = new FormData(formulario);
                const colorValue = document.getElementById("color").value;
                console.log("Color seleccionado:", colorValue);
                axios.post("http://localhost:8000/calendario", datos)
                    .then((respuesta) => {
                        calendar.refetchEvents();
                        $("#evento").modal("hide");
                    })
                    .catch((error) => {
                        console.error(error);
                    });
            });
        });
        function formatHour(date) {
        return date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
    }
    </script>
@endsection
