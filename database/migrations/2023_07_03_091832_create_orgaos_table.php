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
        Schema::create('orgaos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tipo_orgao_id');
            $table->foreignId('orgao_id')->nullable();
            $table->string('nome');
            $table->string('sigla')->nullable();
            $table->timestamps();

            $table->foreign('tipo_orgao_id')
                ->references('id')
                ->on('tipos_orgaos');

            $table->foreign('orgao_id')
                ->references('id')
                ->on('orgaos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orgaos');
    }
};
