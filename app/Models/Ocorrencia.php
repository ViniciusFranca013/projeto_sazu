<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ocorrencia extends Model
{
    protected $primaryKey = 'Id_reclamacao';
    protected $fillable = [
    'Id_reclamacao',
    'FK_CIDADAO_Id_cidadao',
    'FK_LOCAL_MAPA_Id_mapa',
    'Tipo_ocorrencia',
    'Rua',
    'Numero',
    'Cidade',
    'situação',
    'CEP',
    'foto',
    'descricao_problema',
    'prioridade_problema',
    'bairro',
    'data_ocorrencia'
    ];
}
