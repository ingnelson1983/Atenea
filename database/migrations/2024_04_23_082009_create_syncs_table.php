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
        Schema::create('syncs', function (Blueprint $table) {
            $table->id();
            $table->string('Cod_Empresa')->nullable();
            $table->string('Nom_Empresa')->nullable();
            $table->string('Codigo_Obra')->nullable();
            $table->string('Nombre_Obra')->nullable();
            $table->string('Cod_Insumo')->nullable();
            $table->string('Nombre_Insumo', 3200)->nullable();
            $table->string('Cod_Nom_Insumo', 3200)->nullable();
            $table->string('Cod_Item')->nullable();
            $table->string('Nombre_Item', 3200)->nullable();
            $table->string('Destino_Item')->nullable();
            $table->string('Cod_Nom_Destino_Item', 3200)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('syncs');
    }
};
