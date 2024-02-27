<?php

namespace App\Repository;

use App\Interfaces\Repository\WalletRepositoryInterface;
use App\Model\User;
use App\Model\Wallet;
use App\Resource\UserResource;
use App\Resource\WalletResource;

class WalletRepository implements WalletRepositoryInterface
{
    public static function create(User $user, $amount = 0): WalletResource
    {
        $data = [
            'user_id' => $user->id,
            'amount' => $amount
        ];
        $wallet = Wallet::create($data);
        return WalletResource::make($wallet);
    }

    public static function byUser(string $userId): WalletResource
    {
        $wallet = Wallet::where('user_id', '=', $userId)->get()->first();
        return WalletResource::make($wallet);
    }

    public static function withdraw(WalletResource $wallet, int $amount): WalletResource
    {
        $wallet = Wallet::find($wallet['id']);
        $newAmount = (int)$wallet->amount - $amount;
        $wallet->update(['amount' => $newAmount]);

        return WalletResource::make($wallet);
    }

    public static function deposit(WalletResource $wallet, int $amount): WalletResource
    {
        $wallet = Wallet::find($wallet['id']);
        $newAmount = (int)$wallet->amount + $amount;
        $wallet->update(['amount' => $newAmount]);
        return WalletResource::make($wallet);
    }
}