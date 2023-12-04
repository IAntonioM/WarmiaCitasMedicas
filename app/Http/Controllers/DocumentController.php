<?php

namespace App\Http\Controllers;

use App\Models\HistoriaClinica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function __construct(){
        $this->middleware("auth");
    }
    public function descargarDocumentoMedicoInicial($nombres) {
        $rutaArchivo = storage_path('app/public/hc_original/hc_inicial.pdf');
        return response()->download($rutaArchivo, $nombres.'_hc_inicial.pdf');
    }
    public function descargarDocumentoMedicoControl($nombres) {
        $rutaArchivo = storage_path('app/public/hc_original/hc_control.pdf');
        return response()->download($rutaArchivo, $nombres.'_hc_control.pdf');
    }
    public function descargarHCPaciente($nombreArchivo) {
        $rutaArchivo = storage_path("app/public/hc_pacientes/{$nombreArchivo}");
        return response()->download($rutaArchivo, $nombreArchivo.'.pdf');
    }
    
    public function verDocumentoPaciente($nombreArchivo) {
        $path = storage_path('app/public/hc_pacientes/'.$nombreArchivo);
    return response()->file($path);
    }
    

}
