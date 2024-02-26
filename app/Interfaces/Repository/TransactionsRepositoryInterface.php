<?php

namespace App\Interfaces\Repository;

use App\Resource\TransactionResource;
use App\Resource\UserResource;

interface TransactionsRepositoryInterface
{
    public static function create(UserResource $sender, UserResource $receiver, int $amount): TransactionResource;
}