@extends('layouts.sessionApp')
@section('titulo')
    Editar Cita

@endsection

@section('contenido')
    <hr>

    <div style="width: 30%">
        <p>Nombres del Paciente: Nombres del Paciente Apellidos del Paciente</p>
        
        <form action="#" method="POST">
            @csrf
            <div class="form-group">
                <label for="motivo">Motivo de la Cita</label>
                <textarea class="form-control" id="motivo" name="motivo" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="paciente_id">ID del Paciente</label>
                <input type="hidden" name="paciente_id" value="1">
            </div>
            <div class="form-group">
                <label for="medico_id">Médicos</label>
                <select class="form-control" id="medico" name="medico_id" required>
                    <option value="1">Médico 1</option>
                    <option value="2">Médico 2</option>
                </select>
            </div>
            <div class="form-group">
                <label for="fecha">Fecha de la Cita</label>
                <input type="date" class="form-control" id="fecha" name="fecha" required>
            </div>
            <div class="form-group">
                <h5>Horario de Atención</h5>
                <div class="form-check">
                    <input type="radio" id="horario1" name="hora_id" value="1">
                    <label for="horario1">8:00 AM - 9:45 AM</label>
                </div>
                <div class="form-check">
                    <input type="radio" id="horario2" name="hora_id" value="2">
                    <label for="horario2">10:00 AM - 11:45 AM</label>
                </div>
                <!-- Agrega más opciones de horario si es necesario -->
            </div>
            <button type="submit" class="btn btn-primary">Modificar Cita</button>
        </form>
        
    </div>
    </div>
@endsection