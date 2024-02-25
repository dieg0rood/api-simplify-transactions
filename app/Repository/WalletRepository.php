<?php

namespace App\Repository;

use App\Model\User;
use App\Model\Wallet;
use App\Repository\Interfaces\Wallet\WalletRepositoryInterface;

class WalletRepository implements WalletRepositoryInterface
{
    public static function create(User $user, $amount = 0): Wallet
    {
        $data = [
            'user_id' => $user->id,
            'amount' => $amount
        ];
        return Wallet::create($data);
    }

    public static function byUser(int $userId): Wallet
    {
        return Wallet::where('user_id', '=', $userId)->get()->first();
    }
}