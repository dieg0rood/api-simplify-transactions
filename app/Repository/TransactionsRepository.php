<?php

namespace App\Repository;

use App\Model\Transaction;
use App\Repository\Interfaces\User\UserRepositoryInterface;

class TransactionsRepository implements UserRepositoryInterface
{
    public static function create(array $data): Transaction
    {
        return Transaction::create($data);
    }
}