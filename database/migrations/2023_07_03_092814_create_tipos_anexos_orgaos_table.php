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
        Schema::create('tipos_anexos_orgaos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('orgao_id');
            $table->foreignId('tipo_anexo_id');
            $table->timestamps();

            $table->foreign('orgao_id')
                ->references('id')
                ->on('orgaos');

            $table->foreign('tipo_anexo_id')
                ->references('id')
                ->on('tipos_anexos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipos_anexos_orgaos');
    }
};
