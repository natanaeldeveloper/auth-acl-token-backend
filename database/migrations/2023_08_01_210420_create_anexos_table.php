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
        Schema::create('anexos', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->foreignId('processo_id');
            $table->foreignId('tipo_anexo_id');
            $table->foreignId('editor_id');
            $table->integer('numero_anexo')->nullable();
            $table->string('mime_type')->nullable();
            $table->boolean('por_arquivo');
            $table->string('descricao');
            $table->text('conteudo')->nullable();
            $table->timestamps();

            $table->foreign('processo_id')
                ->references('id')
                ->on('processos');

            $table->foreign('tipo_anexo_id')
                ->references('id')
                ->on('tipos_anexos');

            $table->foreign('editor_id')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anexos');
    }
};
