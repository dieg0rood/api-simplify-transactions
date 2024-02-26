<?php

namespace App\ExternalServices\Service;

use App\ExternalServices\Request\TransactionAuthRequest;

class TransactionAuthService
{
    private TransactionAuthRequest $transactionAuthRequest;

    public function __construct()
    {
        $this->transactionAuthRequest = make(TransactionAuthRequest::class);
    }

    public static function instanciate(): TransactionAuthService
    {
        return new self;
    }

    public function auth()
    {
        return $this->transactionAuthRequest->auth();
    }
}