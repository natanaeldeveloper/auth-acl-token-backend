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
            $table->string('cpf')->unique()->nullable();
            $table->string('nome_pai')->nullable();
            $table->string('nome_mae')->nullable();
            $table->foreignId('orgao_id');

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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('cpf');
            $table->dropColumn('nome_pai');
            $table->dropColumn('nome_mae');
            $table->foreign('orgao_id');
            $table->dropColumn('orgao_id');
        });
    }
};
