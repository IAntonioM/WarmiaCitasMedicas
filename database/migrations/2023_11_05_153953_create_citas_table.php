<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitasTable extends Migration
{
    public function up()
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('paciente_id');
            $table->date('fecha');
            $table->string('motivo');
            $table->string('resultados_medicos')->nullable();
            $table->unsignedBigInteger('medico_id');
            $table->unsignedBigInteger('hora_id');
            $table->enum('estado', ['pendiente', 'completada', 'cancelada']);
            $table->foreign('paciente_id')->references('id')->on('pacientes');
            $table->foreign('hora_id')->references('id')->on('horasAtencion');
            $table->foreign('medico_id')->references('id')->on('users')->where('cargo', 'Medico');
        });
    }

    public function down()
    {
        Schema::dropIfExists('citas');
    }
}
