<?php

namespace App\Repository\Interfaces\Wallet;

use App\Model\User;

interface WalletRepositoryInterface
{
    public static function create(User $user, int $amount = null);
}