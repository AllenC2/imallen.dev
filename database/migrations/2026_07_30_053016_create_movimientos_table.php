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
        Schema::create('movimientos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('expediente_id')->constrained()->cascadeOnDelete();
            $table->string('tipo');
            $table->decimal('monto', 10, 2);
            $table->text('descripcion')->nullable();
            $table->date('fecha')->default(now());
            $table->timestamps();
            $table->softDeletes()->after('updated_at');

            $table->index('expediente_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimientos');
    }
};
