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
        Schema::table('expedientes', function (Blueprint $table) {
            $table->string('titulo_opcion_pago')->nullable()->after('contenido');
            $table->text('descripcion_opcion_pago')->nullable()->after('titulo_opcion_pago');
            $table->decimal('cantidad_opcion_pago', 10, 2)->nullable()->after('descripcion_opcion_pago');
            $table->string('enlace_opcion_pago')->nullable()->after('cantidad_opcion_pago');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('expedientes', function (Blueprint $table) {
            $table->dropColumn([
                'titulo_opcion_pago',
                'descripcion_opcion_pago',
                'cantidad_opcion_pago',
                'enlace_opcion_pago',
            ]);
        });
    }
};
