<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function __construct(){
        $this->middleware("auth");
    }
    public function descargarDocumentoMedicoInicial($dni) {
        $rutaArchivo = storage_path('app/public/documents/hc_original/hc_inicial.doc');
        return response()->download($rutaArchivo, $dni.'_hc_inicial.doc');
    }
    public function descargarDocumentoMedicoControl($dni) {
        $rutaArchivo = storage_path('app/public/documents/hc_original/hc_inicial.doc');
        return response()->download($rutaArchivo, $dni.'_hc_control.doc');
    }
}
