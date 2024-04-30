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
        Schema::create('salidas', function (Blueprint $table) {
            $table->id();
            $table->integer('id_usu');
            $table->foreignId('proyecto_id')->constrained();
            $table->dateTime('fecha_Salida', $precision = 0)->nullable();
            $table->longText('nom_material')->nullable();
            $table->string('destino', 200)->nullable();
            $table->string('descripcion', 200)->nullable();
            $table->String('estado')->nullable()->default('Generada');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salidas');
    }
};
