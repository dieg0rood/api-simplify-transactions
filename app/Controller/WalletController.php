<?php

declare(strict_types=1);

namespace App\Controller;

use App\Request\WalletTransactionRequest;
use App\Service\TransactionService;
use Hyperf\HttpServer\Response;
use Psr\Http\Message\ResponseInterface;

class WalletController extends Controller
{
    public function transaction (WalletTransactionRequest $request): ResponseInterface
    {
        return TransactionService::instanciate()->makeTransaction($request)->toResponse();
    }
}