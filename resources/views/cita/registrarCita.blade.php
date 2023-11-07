@extends('layouts.sessionApp')
@section('titulo')
    Registrar Cita

@endsection

@section('contenido')
    <hr>

    <div style="width: 30%">
        <form action="{{route('buscarPacienteEnCita')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="dni_paciente">DNI del Paciente</label>
                <input type="text" class="form-control" id="dni_paciente" name="dni_paciente" required>
            </div>
            <button type="submit" class="btn btn-primary">Buscar Paciente</button>
        </form>
    
        @if (isset($paciente))
            <p>Nombres del Paciente: {{ $paciente->nombres }} {{ $paciente->apellidos }}</p>
    
            
            <form action="{{route('registrarCita')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="motivo">Motivo de la Cita</label>
                    <textarea class="form-control" id="motivo" name="motivo" rows="4" required></textarea>
                </div>
                <input value="{{ $paciente->id }}" type="hidden" name="paciente_id">
                <div class="form-group">
                    <label for="medico">Médicos</label>
                    <select class="form-control" id="medico" name="medico_id" required>
                        @foreach($medicos as $medico)
                            <option value="{{ $medico->id }}">{{ $medico->nombres }} {{ $medico->apellidos }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="fecha_cita">Fecha de la Cita</label>
                    <input type="date" class="form-control" id="fecha" name="fecha" required>
                </div>
                <div class="form-group">
                    <h5>Horario de Atención</h5>
                    @foreach ($horariosDisponibles as $horario)
                        <div class="form-check">
                            <input type="radio" id="horario{{ $horario->id }}" name="hora_id" value="{{ $horario->id }}">
                            <label for="horario{{ $horario->id }}">{{ $horario->inicio }} - {{ $horario->fin }}</label>
                        </div>
                    @endforeach
                </div>
                <button type="submit" class="btn btn-primary">Guardar Cita</button>
            </form>
    </div>
    @endif
    @include('paciente.registrarPaciente')
@endsection