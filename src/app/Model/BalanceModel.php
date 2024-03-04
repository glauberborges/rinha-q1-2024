<?php

declare(strict_types=1);

namespace App\Model;

/**
 * @property string $id
 * @property string $cliente_id
 * @property string $valor
 */
class BalanceModel extends Model
{
    public bool $timestamps = false;

    /**
     * The table associated with the model.
     */
    protected ?string $table = 'saldos';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = [];
}
