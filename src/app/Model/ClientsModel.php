<?php

declare(strict_types=1);

namespace App\Model;



/**
 * @property string $id
 * @property string $nome
 * @property string $limite
 */
class ClientsModel extends Model
{
    public bool $timestamps = false;

    /**
     * The table associated with the model.
     */
    protected ?string $table = 'clientes';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = [];

    public function balance(): \Hyperf\Database\Model\Relations\HasOne
    {
        return $this->hasOne(BalanceModel::class, 'cliente_id', 'id');
    }
}
