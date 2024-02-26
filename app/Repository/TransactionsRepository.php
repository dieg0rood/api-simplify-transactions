<?php

namespace App\Repository;

use App\Interfaces\Repository\TransactionsRepositoryInterface;
use App\Interfaces\Repository\UserRepositoryInterface;
use App\Model\Transaction;
use App\Resource\TransactionResource;
use App\Resource\UserResource;

class TransactionsRepository implements TransactionsRepositoryInterface
{
    public static function create(UserResource $sender, UserResource $receiver, int $amount): TransactionResource
    {
        $transaction = Transaction::create([
            'sender_id' => $sender['id'],
            'receiver_id' => $receiver['id'],
            'value' => $amount
        ]);
        return TransactionResource::make($transaction);
    }
}