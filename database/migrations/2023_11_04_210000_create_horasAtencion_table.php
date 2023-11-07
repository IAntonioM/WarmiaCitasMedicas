<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('horasAtencion', function (Blueprint $table) {
            $table->id();
            $table->string('inicio');
            $table->string('fin');
        });
        DB::table('horasAtencion')->insert([
            ['inicio' => '8:00AM', 'fin' => '9:45AM'],
            ['inicio' => '10:00AM', 'fin' => '11:45AM'],
            ['inicio' => '12:00PM', 'fin' => '1:00PM'],
            ['inicio' => '2:15PM', 'fin' => '4:00PM'],
            ['inicio' => '4:15PM', 'fin' => '6:00PM'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horasAtencion');
    }
};
