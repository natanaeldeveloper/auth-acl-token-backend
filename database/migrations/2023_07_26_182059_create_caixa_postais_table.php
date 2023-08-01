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
        Schema::create('caixas_postais', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id');
            $table->foreignId('tipo_caixa_postal_id');
            $table->foreignId('processo_id');
            $table->timestamps();

            $table->foreign('usuario_id')
                ->references('id')
                ->on('users');

            $table->foreign('tipo_caixa_postal_id')
                ->references('id')
                ->on('tipos_caixas_postais');

            $table->foreign('processo_id')
                ->references('id')
                ->on('processos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('caixas_postais');
    }
};
