<?php

declare(strict_types=1);

namespace App\Model;

/**
 * @property string $id
 * @property string $cliente_id
 * @property string $valor
 * @property string $tipo
 * @property string $descricao
 * @property string $realizada_em
 */
class TransactionsModel extends Model
{
    public bool $timestamps = false;

    /**
     * The table associated with the model.
     */
    protected ?string $table = 'transacoes';

//    protected array $hidden = ['id', 'cliente_id'];

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [
        'cliente_id',
        'valor',
        'tipo',
        'descricao',
        'realizada_em',
    ];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = [];
}
