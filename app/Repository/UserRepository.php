<?php

namespace App\Repository;

use App\Enum\UserTypesEnum;
use App\Interfaces\Repository\UserRepositoryInterface;
use App\Model\User;
use App\Model\Wallet;
use App\Resource\UserResource;
use App\Resource\WalletResource;
use Hyperf\Collection\Collection;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(private User $user){}

    public static function instanciate(string $id): UserRepository
    {
        $user = User::findOrFail($id);
        return new UserRepository($user);
    }
    public static function create(array $data): UserResource
    {
        return UserResource::make(User::create($data));
    }

    public static function createWithWallet(array $data, float $initialAmount = 0): UserResource
    {
        $user = User::create($data);
        WalletRepository::create($user, $initialAmount);
        return UserResource::make($user);
    }

    public static function findWithoutWallet(): Collection
    {
        return User::select('users.*')->leftJoin('wallets','users.id', '=', 'wallets.user_id')->whereNull('wallets.id')->get();
    }

    public function wallet(): WalletResource
    {
        return WalletRepository::byUser($this->user->id);
    }

    public function user(): UserResource
    {
        return UserResource::make($this->user);
    }

}