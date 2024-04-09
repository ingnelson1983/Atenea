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
            $table->integer('cod_material_sinco')->nullable();
            $table->text('nom_material', 1000)->nullable();
            $table->string('unidad_medida', 100)->nullable();
            $table->integer('cantidad')->nullable();
            $table->string('destino', 200)->nullable();
            $table->string('descripcion', 200)->nullable();
            $table->String('estado')->nullable();


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
