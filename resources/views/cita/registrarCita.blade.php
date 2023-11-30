@extends('layouts.sessionApp')
@section('titulo')
    Registrar Cita

@endsection

@section('style') 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/main.css">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/locales-all.js"></script>
    
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@endsection

@section('contenido')
<hr>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-3">
            <div class="row">
                <div class="col-12">
                    <label for="dni">Dni del Paciente</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="dni" name="dni" required>
                        <button type="button" class="btn btn-primary" onclick="buscarCliente()">Buscar</button>
                    </div>
                </div>
            </div>
            
            <div id="mensaje-error" class="row mt-2">
                <div class="col-12">    
                
                </div>
            </div>
            <form action="{{ route('registrarCita') }}" method="POST" class="form">
                @csrf
                <input type="hidden" name="idPaciente" id="idPaciente">
                <div class="row">
                    <div class="form-group col-12">
                        <label for="paciente">Paciente</label>
                        <input type="text" class="form-control" id="paciente" name="paciente" required readonly>
                    </div>
                </div>
            
                <div class="row">
                    <div class="col-7">
                        <label for="fecha">Fecha de la Cita *</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" required readonly>
                    </div>
                    <div class="col-5">
                        <label for="hora">Hora *</label>
                        <input type="time" class="form-control" id="hora" name="hora" required>
                    </div>
                </div>
            
                <input value="" type="hidden" name="paciente_id">
            
                <div class="row">
                    <div class="form-group col-12">
                        <label for="medico">Médicos</label>
                        <select class="form-control" id="medico" name="medico" required>
                            @foreach($medicos as $medico)
                                <option value="{{ $medico->id }}">{{ $medico->nombre_medico }} {{ $medico->apellido_medico }} - {{ $medico->especialidad }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-12">
                        <label for="estado">Estado *</label>
                        <select class="form-control" id="estado" name="estado" required>
                            <option value="Pendiente" selected>Pendiente</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-12">
                        <label for="motivo_consulta">Motivo de Consulta :</label>
                        <textarea class="form-control" id="motivo_consulta" name="motivo_consulta" rows="4" required></textarea>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-12">
                        <button type="button" class="btn btn-success" id="btnGuardar">Guardar</button>
                        <a type="button" class="btn btn-secondary" href="{{route('gestionCitas')}}">volver</a>
                    </div>
                </div>
            </form>
            
        </div>
        <div class="col-md-1">

        </div>
        <div class="col-md-8">
            <div id="calendar"></div>
        </div>
    </div>
</div>



@include('paciente.registrarPaciente')
@endsection
@section('script')  

<script>
    // Buscar Cliente
    function buscarCliente() {
        var dni = document.getElementById('dni').value;

        // Realiza la solicitud AJAX con Axios
        axios.get('http://localhost:8000/paciente/buscar/' + dni)
            .then(function (response) {
                paciente = response.data;
                if (typeof paciente.nombres !== 'undefined' && paciente.nombres !== null) {
                    console.log(paciente.nombres);
                    document.getElementById('paciente').value = paciente.nombres + " " + paciente.apellidos;
                    document.getElementById('idPaciente').value = paciente.id;

                    // Limpiar mensaje de error si existe
                    document.getElementById('mensaje-error').innerHTML = '';
                } else {
                    // Mostrar mensaje de error
                    document.getElementById('mensaje-error').innerHTML = '<p class="text-danger">No se encontró paciente con ese DNI <a class="" data-bs-toggle="modal" data-bs-target="#create">registrar Paciente</a></p>';
                }
            })
            .catch(function (error) {
                console.error('Error al buscar cliente:', error);
            });
    }

    document.addEventListener('DOMContentLoaded', function () {
        let formulario = document.querySelector("form");
        const calendarEl = document.getElementById('calendar');
        let idMedico = 0;
        let calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: "es",
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,listWeek'
            },
            events: "http://localhost:8000/cita/cita-calendario/Pendiente/" + idMedico,
            dateClick: function (info) {
                formulario.fecha.value = info.dateStr;
            },
            validRange: {
                start: new Date().toISOString().split("T")[0], // Fecha actual
            },
            eventContent: function (arg) {
                // Agregar estilos personalizados para cada evento
                return {
                    html: `
                        <div style="background-color: ${arg.event.backgroundColor}; color: ${arg.event.textColor}; padding: 5px;">
                            <div>${formatHour(arg.event.start)} ${arg.event.title}</div>
                        </div>`,
                };
            },
        });
        calendar.render();

        document.getElementById("medico").addEventListener("change", function () {
            idMedico = this.value;

            // Destruir el calendario actual
            calendar.destroy();

            // Crear un nuevo calendario con el nuevo idMedico
            calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: "es",
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,listWeek'
                },
                events: "http://localhost:8000/cita/cita-calendario/Pendiente/" + idMedico,
                dateClick: function (info) {
                    formulario.fecha.value = info.dateStr;
                },
                validRange: {
                    start: new Date().toISOString().split("T")[0], // Fecha actual
                },
                eventContent: function (arg) {
                    // Agregar estilos personalizados para cada evento
                    return {
                        html: `
                            <div style="background-color: ${arg.event.backgroundColor}; color: ${arg.event.textColor}; padding: 5px;">
                                <div>${formatHour(arg.event.start)} ${arg.event.title}</div>
                            </div>`,
                    };
                },
            });

            // Renderizar el nuevo calendario
            calendar.render();
            console.log('idMedico seleccionado:', idMedico);
        });

        document.getElementById("btnGuardar").addEventListener("click", function () {
            const datos = new FormData(formulario);

            axios.post("http://localhost:8000/cita", datos)
                .then((respuesta) => {
                    calendar.refetchEvents();
                })
                .catch((error) => {
                    console.error(error);
                });
        });

        function formatHour(date) {
            // Formatear la hora según tus necesidades
            return date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
        }
    });
</script>

@endsection
