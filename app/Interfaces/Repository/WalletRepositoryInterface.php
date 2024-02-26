<?php

namespace App\Interfaces\Repository;

use App\Model\User;

interface WalletRepositoryInterface
{
    public static function create(User $user, int $amount = null);
}