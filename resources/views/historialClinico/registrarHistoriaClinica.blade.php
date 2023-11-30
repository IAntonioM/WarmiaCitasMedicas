@extends('layouts.sessionApp')
@section('titulo')
    Registrar Historia Clinica
@endsection

@section('contenido')
<div class="container mt-5">
    <hr>
    <h2 class="text-center">Documentos Médico</h2>
    @foreach ($paciente as $paciente)
    <a href="/descargar-documento-inicial/{{$paciente->dni}}" class="btn btn-success" download><i class="fa-solid fa-download"></i> HC Inicial</a>
    <a href="/descargar-documento-control/{{$paciente->dni}}" class="btn btn-info" download><i class="fa-solid fa-download"></i> HC Control</a>
    @endforeach
    <hr>

    <div class="container mt-4"  style="overflow-y: auto; max-height: 60vh" >
        <div class="row">
            <!-- Columna Izquierda -->
            <div class="col-md-5">
                <div class="col-md-12">
            <h2 class="text-center">Información del Paciente</h2>
            <ul class="list-group">
                <li class="list-group-item"><strong>Nombre:</strong> {{ $paciente->nombres }} {{ $paciente->apellidos }}</li>
                <li class="list-group-item"><strong>DNI:</strong> {{ $paciente->dni }}</li>
                <li class="list-group-item"><strong>Fecha de Nacimiento:</strong> {{ \Carbon\Carbon::parse($paciente->fechaNacimiento)->locale('es_ES')->isoFormat('LL') }} </li>
                <li class="list-group-item"><strong>Teléfono:</strong> {{ $paciente->telefono }}</li>
                <li class="list-group-item"><strong>Dirección:</strong> {{ $paciente->direccion }}</li>
            </ul>
        </div>

        <div class="col-md-12 mt-4">
            <h2 class="text-center">Información de la Cita</h2>
            @foreach ($cita as $cita)
            <ul class="list-group">
                <li class="list-group-item"><strong>Fecha y Hora:</strong> {{ \Carbon\Carbon::parse($cita->fecha_hora)->locale('es_ES')->isoFormat('LL') }}, {{ \Carbon\Carbon::parse($cita->fecha_hora)->format('h:i a') }}</li>
                <li class="list-group-item"><strong>Estado:</strong> {{ $cita->estado }}</li>
                <li class="list-group-item"><strong>Motivo de Consulta:</strong> {{ $cita->motivo_consulta }} </li>
            </ul>
            @endforeach
        </div>
        <div class="col-md-12 mt-4">
            <h2 class="text-center">Historias Clínicas Anteriores</h2>
            <ul class="list-group" style="overflow-y: auto; max-height: 200px">
                <li class="list-group-item"><strong>Consulta Anterior:</strong> 25 de noviembre de 2023 - Prescripción de medicamento para la gripe.</li>
                <li class="list-group-item"><strong>Consulta Anterior:</strong> 25 de noviembre de 2023 - Prescripción de medicamento para la gripe.</li>
                <li class="list-group-item"><strong>Consulta Anterior:</strong> 25 de noviembre de 2023 - Prescripción de medicamento para la gripe.</li>
                <li class="list-group-item"><strong>Consulta Anterior:</strong> 25 de noviembre de 2023 - Prescripción de medicamento para la gripe.</li>
                <li class="list-group-item"><strong>Consulta Anterior:</strong> 25 de noviembre de 2023 - Prescripción de medicamento para la gripe.</li>
                <li class="list-group-item"><strong>Consulta Anterior:</strong> 25 de noviembre de 2023 - Prescripción de medicamento para la gripe.</li>
                <li class="list-group-item"><strong>Consulta Anterior:</strong> 25 de noviembre de 2023 - Prescripción de medicamento para la gripe.</li>
                <li class="list-group-item"><strong>Consulta Anterior:</strong> 25 de noviembre de 2023 - Prescripción de medicamento para la gripe.</li>
                <li class="list-group-item"><strong>Consulta Anterior:</strong> 25 de noviembre de 2023 - Prescripción de medicamento para la gripe.</li>
        </ul>
        </div>
    </div>
    <div class="col-md-7">
        <div class="col-md-12">
            <h2 class="text-center">Consulta Actual</h2>
            <form action="{{route('registrarHistoriaClinica')}}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <input type="hidden" class="form-control" id="paciente_id" name="paciente_id" value="{{ $paciente->id }}" required>
                
                <input type="hidden" class="form-control" id="cita_id" name="cita_id" value="{{ $cita->id }}" required>
                <div class="row g-3">
                    <div class="col-md-7">
                        <label for="titulo" class="form-label">Título:</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" required>
                    </div>
                    <div class="col-md-5">
                        <label for="tipo" class="form-label">Tipo:</label>
                        <select class="form-select" id="tipo" name="tipo" required>
                            <option value="Inicial">Inicial</option>
                            <option value="Control">Control</option>
                        </select>
                    </div>
            
                    <div class="col-md-12">
                        <label for="archivo_respaldo" class="form-label">Documento:</label>
                        <input type="file" class="form-control" id="archivo_respaldo" name="archivo_respaldo" accept=".doc, .docx, .pdf" required>
                    </div>

                    <div class="col-md-12">
                        <label for="diagnostico" class="form-label">Diagnóstico:</label>
                        <textarea class="form-control" id="diagnostico" name="diagnostico" style="min-height: 100px" required></textarea>
                    </div>
            
                    <div class="col-md-7 mt-3">
                        <button type="submit" class="btn btn-primary">Guardar Historia Clínica</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-12 mt-4">
            <h2 class="text-center">Documento Médico Actual</h2>
            <embed id="visorPDF" type="application/pdf" width="100%" height="600">
        </div>
    </div>
</div>
    
    <script>
        const archivoInput = document.getElementById('archivo_respaldo'); // Cambiar a archivo_respaldo
        const visorPDF = document.getElementById('visorPDF');
    
        archivoInput.addEventListener('change', function() {
            const archivo = archivoInput.files[0];
            if (archivo) {
                if (archivo.type === 'application/pdf' || archivo.type === 'application/msword') {
                    const objetoURL = URL.createObjectURL(archivo);
                    visorPDF.setAttribute('src', objetoURL);
                } else {
                    alert('Formato de archivo no válido. Se admiten archivos PDF y DOC.');
                    archivoInput.value = '';
                }
            } else {
                visorPDF.removeAttribute('src');
            }
        });
    </script>
@endsection