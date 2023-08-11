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
        Schema::create('processos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('solicitante_id');
            $table->decimal('valor_estimado', 12,2);
            $table->string('sequencia_processo')->nullable();
            $table->string('numero_processo')->nullable();
            $table->integer('ano_processo');
            $table->text('objeto');
            $table->timestamps();

            $table->foreign('solicitante_id')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('processos');
    }
};
