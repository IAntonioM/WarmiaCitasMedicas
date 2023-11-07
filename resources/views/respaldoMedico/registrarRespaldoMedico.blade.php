@extends('layouts.sessionApp')
@section('titulo')
    Registrar Respaldo Medico

@endsection

@section('contenido')
    <hr>
    <div class="row">
        <div class="col-5">
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
            
                <div class="form-group">
                    <label for="cita_id">Cita ID</label>
                    <input type="text" class="form-control" id="cita_id" name="cita_id" required>
                </div>
            
                <div class="form-group">
                    <label for="archivo_respaldo">Archivo de Respaldo Médico (Doc o PDF)</label>
                    <input type="file" class="form-control-file" id="archivo_respaldo" name="archivo_respaldo" accept=".doc, .docx, .pdf" required>
                </div>
            
                <button type="submit" class="btn btn-primary">Subir Respaldo Médico</button>
            </form>
        </div>
        <div class="col-7">
            <embed id="visorPDF" type="application/pdf" width="100%" height="600">
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