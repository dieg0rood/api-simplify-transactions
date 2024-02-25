<?php

namespace HyperfTest\Helpers\Factory;

use App\Enum\UserTypesEnum;
use App\Model\User;
use App\Repository\UserRepository;
use Hyperf\Stringable\Str;

class UserGenerator
{
    private string $userType = UserTypesEnum::Personal->value;
    private int $initialAmount = 0;
    private bool $withWallet = false;

    public function create(): User
    {
        if($this->withWallet) {
            return UserRepository::createWithWallet([
                'full_name' => Str::random(),
                'document' => DocumentGenerator::generateDocument($this->userType),
                'email' => Str::random(),
                'type' => $this->userType,
                'password' => md5(Str::random())
            ], $this->initialAmount);
        }
        return UserRepository::create([
            'full_name' => Str::random(),
            'document' => DocumentGenerator::generateDocument($this->userType),
            'email' => Str::random(),
            'type' => $this->userType,
            'password' => md5(Str::random())
        ]);
    }

    public function withWallet(): UserGenerator
    {
        $this->withWallet = true;
        return $this;
    }
    public function initialAmount(int $amount): UserGenerator
    {
        $this->initialAmount = $amount;
        return $this;
    }

    public function enterprise(): UserGenerator
    {
        $this->userType = UserTypesEnum::Enterprise->value;
        return $this;
    }

    public static function init(): UserGenerator
    {
        return new self();
    }


}