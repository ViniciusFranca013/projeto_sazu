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
        Schema::create('cidadaos', function (Blueprint $table) {
            $table->id('Id_cidadao');
            $table->string('CPF', 14);
            $table->string('Bairro');
            $table->string('Cidade');
            $table->string('nome');
            $table->date('data_nascimento');
            $table->string('telefone', 20);
            $table->string('email');
            $table->string('cep', 9);
            $table->string('rua');
            $table->string('numero');
            $table->timestamps();
        });
    }
/**
    CREATE TABLE CIDADAO (
    Id_cidadao bigint(20) PRIMARY KEY  NOT NULL,
    CPF varchar (14) NOT NULL,
    Bairro VARCHAR(255) NOT NULL,
    Cidade VARCHAR(255)  NOT NULL,
    nome VARCHAR (55)  NOT NULL,
    data_nascimento DATE NOT NULL,
    telefone VARCHAR(20)  NOT NULL,
    email VARCHAR(45)  NOT NULL,
    cep VARCHAR(9)  NOT NULL,
    rua VARCHAR(55)  NOT NULL,
    numero INTEGER(9) NOT NULL
);
 */

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cidadaos');
    }
};
