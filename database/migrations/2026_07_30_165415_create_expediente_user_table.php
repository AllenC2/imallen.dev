<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Crear tabla pivot expediente_user (convención: nombres alfabéticos singular)
        Schema::create('expediente_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('expediente_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['expediente_id', 'user_id']);
        });

        // 2. Migrar datos existentes: cada cliente_id → fila en la pivot
        if (Schema::hasColumn('expedientes', 'cliente_id')) {
            $filas = DB::table('expedientes')
                ->whereNotNull('cliente_id')
                ->pluck('cliente_id', 'id');

            $ahora = now();
            foreach ($filas as $expedienteId => $userId) {
                DB::table('expediente_user')->insert([
                    'expediente_id' => $expedienteId,
                    'user_id' => $userId,
                    'created_at' => $ahora,
                    'updated_at' => $ahora,
                ]);
            }

            // 3. Eliminar la columna cliente_id de expedientes
            Schema::table('expedientes', function (Blueprint $table) {
                // SQLite maneja FKs implícitamente; dropForeign acepta array de columnas
                try {
                    $table->dropForeign(['cliente_id']);
                } catch (\Throwable) {
                    // ignorar en SQLite si no existe constraint con nombre
                }
                $table->dropIndex(['cliente_id']);
                $table->dropColumn('cliente_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Recrear cliente_id en expedientes
        Schema::table('expedientes', function (Blueprint $table) {
            $table->foreignId('cliente_id')->nullable()->after('id');
            $table->index('cliente_id');
        });

        // Restaurar datos desde la pivot (primer cliente asociado)
        $filas = DB::table('expediente_user')->get();
        foreach ($filas as $fila) {
            DB::table('expedientes')
                ->where('id', $fila->expediente_id)
                ->whereNull('cliente_id')
                ->update(['cliente_id' => $fila->user_id]);
        }

        Schema::dropIfExists('expediente_user');
    }
};
