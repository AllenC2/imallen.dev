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
        Schema::table('users', function (Blueprint $table) {
            $table->string('tipo_usuario')->default('Cliente')->after('email');
            $table->softDeletes()->after('updated_at');
        });

        // Backfill: los usuarios existentes quedan como Administrador (evita lockout)
        \Illuminate\Support\Facades\DB::table('users')
            ->whereNull('deleted_at')
            ->update(['tipo_usuario' => 'Administrador']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropSoftDeletes();
            $table->dropColumn('tipo_usuario');
        });
    }
};
