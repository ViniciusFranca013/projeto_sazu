<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cidadao extends Model
{
    protected $table = 'cidadaos';

    protected $primaryKey = 'Id_cidadao';

    protected $fillable = [
        'CPF',
        'Bairro',
        'Cidade',
        'nome',
        'data_nascimento',
        'telefone',
        'email',
        'cep',
        'rua',
        'numero',
        'fk_usuario'
    ];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'fk_usuario',
            'id'
        );
    }
}
