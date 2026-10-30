
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ocorrencias', function (Blueprint $table) {
            $table->id('Id_reclamacao');

            $table->unsignedBigInteger('FK_CIDADAO_Id_cidadao');
            $table->unsignedBigInteger('FK_LOCAL_MAPA_Id_mapa')->nullable();

            $table->string('Tipo_ocorrencia', 112);
            $table->string('Rua', 50);
            $table->string('Numero', 10);
            $table->string('Cidade', 30);
            $table->string('situação', 40);
            $table->string('CEP', 11);
            $table->string('foto', 255);
            $table->string('descricao_problema', 250);
            $table->string('prioridade_problema', 15);
            $table->string('bairro', 255);

            $table->date('data_ocorrencia');

            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();

            $table->timestamps();

            $table->foreign('FK_CIDADAO_Id_cidadao')
                ->references('Id_cidadao')
                ->on('cidadaos');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ocorrencias');
    }
};
