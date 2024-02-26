<?php

declare(strict_types=1);

namespace App\Model;

use Carbon\Carbon;

class Wallet extends AbstractModel
{
    /**
     * @property int $id
     * @property uuid user_id
     * @property int amount
     * @property Carbon $created_at
     * @property Carbon $updated_at
     */
    protected ?string $table = 'wallets';
    protected array $fillable = ['id', 'user_id', 'amount'];
    protected array $casts = [
        'id' => 'string',
        'user_id' => 'string',
        'amount' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
}
