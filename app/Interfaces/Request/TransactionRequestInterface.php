<?php

namespace App\Interfaces\Request;

interface TransactionRequestInterface
{
    public function getTransactionValue(): int;
    public function getSenderId(): string;
    public function getReceiverId(): string;
}