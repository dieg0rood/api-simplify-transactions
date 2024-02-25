<?php

declare(strict_types=1);

namespace App\Model;

use Carbon\Carbon;

/**
 * @property int $id
 * @property string full_name
 * @property string document
 * @property string email
 * @property string type
 * @property string password
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class User extends AbstractModel
{
    protected ?string $table = 'users';
    protected array $fillable = ['id', 'full_name', 'document', 'email', 'type', 'password'];
    protected array $casts = [
        'id' => 'string',
        'full_name' => 'string',
        'document' => 'string',
        'email' => 'string',
        'type' => 'string',
        'password' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
}
