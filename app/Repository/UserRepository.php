<?php

namespace App\Repository;

use App\Enum\UserTypesEnum;
use App\Model\User;
use App\Model\Wallet;
use App\Repository\Interfaces\User\UserRepositoryInterface;
use Hyperf\Collection\Collection;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(private User $user){}
    public static function create(array $data): User
    {
        return User::create($data);
    }

    public static function createWithWallet(array $data, int $initialAmount = 0): User
    {
        $user = User::create($data);
        WalletRepository::create($user, $initialAmount);
        return $user;
    }

    public static function findWithoutWallet(): Collection
    {
        return User::select('users.*')->leftJoin('wallets','users.id', '=', 'wallets.user_id')->whereNull('wallets.id')->get();
    }

    public static function onlyPayers(): Collection
    {
        return User::where('users.type', '=', UserTypesEnum::Personal)->get();
    }

    public function wallet(): Wallet
    {
        return WalletRepository::byUser($this->user->id);
    }

}