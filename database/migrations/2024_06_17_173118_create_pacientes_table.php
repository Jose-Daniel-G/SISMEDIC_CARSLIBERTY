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
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();

            $table->string('nombres', 100);
            $table->string('apellido', 100);
            $table->string('dni', 100)->unique();
            $table->string('nro_socio_obra_social', 100)->unique();
            $table->string('fecha_nacimiento', 100);
            $table->string('genero', 20);
            $table->string('celular', 20);
            $table->string('email', 100)->unique();
            $table->string('direccion', 255);
            $table->string('grupo_sanguineo', 255);
            $table->string('alergias', 255);
            $table->string('contacto_emergencia', 255);
            $table->string('observaciones', 255)->nullable();
            //relación de la tabla doctor. con la de user
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
