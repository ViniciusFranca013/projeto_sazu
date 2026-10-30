<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cidadaos', function (Blueprint $table) {
            $table->id('Id_cidadao');

            $table->string('CPF', 14);
            $table->string('Bairro', 255);
            $table->string('Cidade', 255);
            $table->string('nome', 255);
            $table->date('data_nascimento')->nullable();
            $table->string('telefone', 20);
            $table->string('email', 255);
            $table->string('cep', 9);
            $table->string('rua', 255);
            $table->string('numero', 255);

            // Relacionamento com a tabela users
            $table->unsignedBigInteger('fk_usuario');

            $table->timestamps();

            $table->foreign('fk_usuario')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cidadaos');
    }
};
