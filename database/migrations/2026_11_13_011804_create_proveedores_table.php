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
        Schema::create('proveedores', function (Blueprint $table) {
            $table->id();
            $table->string('rtn',14)->unique();
            $table->string('empresa');
            $table->string('contacto');
            $table->string('telefono',8);
            $table->string('categoria');
            $table->decimal('limite_credito',12,2)->default(0);
            $table->integer('dias_credito');
            $table->string('estado')->default('Activo');
            $table->date('fecha_registro');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proveedores');
    }
};
