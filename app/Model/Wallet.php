<?php

declare(strict_types=1);

namespace App\Model;

use Carbon\Carbon;

/**
 * @property int $id
 * @property uuid user_id
 * @property int value
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Wallet extends AbstractModel
{
    protected ?string $table = 'wallets';
    protected array $fillable = ['id', 'user_id', 'value'];
    protected array $casts = [
        'id' => 'string',
        'user_id' => 'string',
        'value' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
}
