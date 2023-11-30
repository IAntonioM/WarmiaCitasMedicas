@extends('layouts.sessionApp')
@section('titulo')
    Editar Cita
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
            <form action="{{ route('editarCita') }}" method="POST" class="form">
                @csrf
                @method('PUT')
            
                @foreach ($Cita as $cita)
                    <input type="hidden" name="idCita" id="idCita" value="{{ $cita->id }}">
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="paciente">Paciente</label>
                            <input type="text" class="form-control" id="paciente" name="paciente" value="{{ $cita->nombre_paciente }} {{ $cita->apellido_paciente }}" required readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-7">
                            <label for="fecha">Fecha de la Cita *</label>
                            <input type="date" class="form-control" id="fecha" name="fecha" required value="{{ $cita->fecha }}" readonly>
                        </div>
                        <div class="col-5">
                            <label for="hora">Hora *</label>
                            <input type="time" class="form-control" id="hora" name="hora" required value="{{ $cita->hora }}">
                        </div>
                    </div>
                
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="medico">Médicos</label>
                            <select class="form-control" id="medico" name="medico" required>
                                @foreach($medicos as $medico)
                                    <option value="{{ $medico->id }}" {{ $cita->medico_id == $medico->id ? 'selected' : '' }}>
                                        {{ $medico->nombre_medico }} {{ $medico->apellido_medico }} - {{ $medico->especialidad }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="estado">Estado *</label>
                            <select class="form-control" id="estado" name="estado" required>
                                <option value="Pendiente" {{ $cita->estado == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                                <option value="Confirmada" {{ $cita->estado == 'Confirmada' ? 'selected' : '' }}>Confirmada</option>
                                <option value="Cancelada" {{ $cita->estado == 'Cancelada' ? 'selected' : '' }}>Cancelada</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="motivo_consulta">Descripcion</label>
                            <textarea class="form-control" id="motivo_consulta" name="motivo_consulta" rows="4" required>{{$cita->motivo_consulta}}</textarea>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-success" id="btnGuardar">Guardar Cambios</button>
                            <a type="button" class="btn btn-secondary" href="{{route('gestionCitas')}}">volver</a>
                        </div>
                    </div>
            
                @endforeach
            
            </form>
            
            
            
        </div>
        <div class="col-md-1">

        </div>
        <div class="col-md-8">
            <div id="calendar"></div>
        </div>
    </div>
</div>




@endsection
@section('script') 
<script>
    let appURL = "{{ $appURL }}";
</script>
<script>
    function buscarCliente() {
        var dni = document.getElementById('dni').value;
        axios.get(appURL+'paciente/buscar/' + dni)
            .then(function (response) {
                paciente = response.data;
                if (typeof paciente.nombres !== 'undefined' && paciente.nombres !== null) {
                    console.log(paciente.nombres);
                    document.getElementById('paciente').value = paciente.nombres + " " + paciente.apellidos;
                    document.getElementById('idPaciente').value = paciente.id;
                    document.getElementById('mensaje-error').innerHTML = '';
                } else {
                    document.getElementById('mensaje-error').innerHTML = '<p class="text-danger">No se encontró paciente con ese DNI <a class="" data-bs-toggle="modal" data-bs-target="#create">registrar Paciente?</a></p>';
                }
            })
            .catch(function (error) {
                console.error('Error al buscar cliente:', error);
            });
    }

    document.addEventListener('DOMContentLoaded', function () {
        let formulario = document.querySelector("form");
        const calendarEl = document.getElementById('calendar');
        let idMedico = formulario.querySelector('#medico').value;
        let calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: "es",
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,listWeek'
            },
            events: appURL+"cita/cita-calendario/Pendiente/" + idMedico,
            dateClick: function (info) {
                formulario.fecha.value = info.dateStr;
            },
            validRange: {
                start: new Date().toISOString().split("T")[0],
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

        document.getElementById("medico").addEventListener("change", function () {
            idMedico = this.value;
            calendar.destroy();
            calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: "es",
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,listWeek'
                },
                events: appURL+"cita/cita-calendario/Pendiente/" + idMedico,
                dateClick: function (info) {
                    formulario.fecha.value = info.dateStr;
                },
                validRange: {
                    start: new Date().toISOString().split("T")[0], 
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
            console.log('idMedico seleccionado:', idMedico);
        });

       
        function formatHour(date) {
            return date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
        }
    });
</script>