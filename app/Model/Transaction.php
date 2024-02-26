<?php

declare(strict_types=1);

namespace App\Model;

use Carbon\Carbon;

/**
 * @property uuid id
 * @property uuid sender_id
 * @property uuid receiver_id
 * @property int value
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Transaction extends AbstractModel
{
    protected ?string $table = 'transactions';
    protected array $fillable = ['id', 'sender_id', 'receiver_id', 'value'];
    protected array $casts = [
        'id' => 'string',
        'sender_id' => 'string',
        'receiver_id' => 'string',
        'value' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
}
