<?php

declare(strict_types=1);

namespace App\Controller;

use App\Request\WalletTransactionRequest;
use Hyperf\HttpServer\Response;
use Psr\Http\Message\ResponseInterface;

class WalletController extends Controller
{
    public function transaction (WalletTransactionRequest $request): ResponseInterface
    {
        return (new Response())->json(['mensagem' => 'Resposta básica']);
    }
}