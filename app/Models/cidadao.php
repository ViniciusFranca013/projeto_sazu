<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;



class cidadao extends Model
{
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

