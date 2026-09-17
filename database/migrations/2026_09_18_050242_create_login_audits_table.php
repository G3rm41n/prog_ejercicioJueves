<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Crea la tabla login_audits para registrar los accesos exitosos.
     */
    public function up(): void
    {
        Schema::create('login_audits', function (Blueprint $table) {
            $table->id();                                           // clave primaria autoincremental
            $table->foreignId('user_id')                           // referencia al usuario que ingresó
                  ->constrained()
                  ->cascadeOnDelete();
            $table->string('ip_address', 45);                      // IPv4 (15 chars) o IPv6 (39 chars)
            $table->timestamp('logged_in_at')->useCurrent();       // fecha y hora del acceso
        });
    }

    /**
     * Revierte la migración eliminando la tabla.
     */
    public function down(): void
    {
        Schema::dropIfExists('login_audits');
    }
};
