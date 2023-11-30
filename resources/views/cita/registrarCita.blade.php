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
                        <label for="paciente @error('idPaciente') border border-danger @enderror">Paciente</label>
                        <input type="text" class="form-control" id="paciente" name="paciente" required readonly>
                        @error('idPaciente')
                            <p class="text-danger">El campo paciente es requerido</p>
                        @enderror
                    </div>
                </div>
            
                <div class="row">
                    <div class="col-7">
                        <label for="fecha">Fecha de la Cita *</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" required value="{{ date('Y-m-d') }}" readonly>
                        
                    </div>
                    <div class="col-5">
                        <label for="hora">Hora *</label>
                        <input type="time" class="form-control @error('hora') border border-danger @enderror" id="hora" name="hora" value="08:00" required>
                        @error('hora')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            
                <input value="" type="hidden" name="paciente_id">
            
                <div class="row">
                    <div class="form-group col-12">
                        <label for="medico">Médicos</label>
                        <select class="form-control @error('medico') border border-danger @enderror" id="medico" name="medico" required>
                            @foreach($medicos as $medico)
                                <option value="{{ $medico->id }}" selected>{{ $medico->nombre_medico }} {{ $medico->apellido_medico }} - {{ $medico->especialidad }}</option>
                            @endforeach
                        </select>
                        @error('medico')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-12">
                        <label for="estado">Estado *</label>
                        <select class="form-control @error('estado') border border-danger @enderror" id="estado" name="estado" required>
                            <option value="Pendiente" selected>Pendiente</option>
                        </select>
                        @error('estado')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-12">
                        <label for="motivo_consulta">Motivo de Consulta :</label>
                        <textarea class="form-control @error('motivo_consulta') border border-danger @enderror" id="motivo_consulta" name="motivo_consulta" rows="4"></textarea>
                        @error('motivo_consulta')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-success" id="btnGuardar">Guardar</button>
                        <a type="button" class="btn btn-secondary" href="{{route('gestionCitas')}}">volver</a>
                    </div>
                </div>
            </form>
            <a href="">{{ config('app.APP_NAME') }}</a>
        </div>
        <div class="col-md-1">
        </div>

        <div class="col-md-8">
            <div id="calendar"></div>
        </div>

    </div>
</div>

<!-- Modal trigger button -->
<button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#modalId">
  Launch
</button>

<!-- Modal Body -->
<!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
<div class="modal fade" id="modalId" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Body
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>


<!-- Optional: Place to the bottom of scripts -->
<script>
    const myModal = new bootstrap.Modal(document.getElementById('modalId'), options)

</script>

@include('paciente.registrarPaciente')
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

@endsection
