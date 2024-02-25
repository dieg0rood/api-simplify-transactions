<?php

namespace App\Repository;

use App\Model\Wallet;
use App\Repository\Interfaces\Wallet\WalletRepositoryInterface;

class WalletRepository implements WalletRepositoryInterface
{
    public static function create(array $data): Wallet
    {
        return Wallet::create($data);
    }
}