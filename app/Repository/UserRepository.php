<?php

namespace App\Repository;

use App\Model\User;
use App\Repository\Interfaces\User\UserRepositoryInterface;
use Hyperf\Collection\Collection;

class UserRepository implements UserRepositoryInterface
{
    public static function create(array $data): User
    {
        return User::create($data);
    }

    public static function withoutWallet(): Collection
    {
        return User::select('users.*')->leftJoin('wallets','users.id', '=', 'wallets.user_id')->whereNull('wallets.id')->get();
    }


}