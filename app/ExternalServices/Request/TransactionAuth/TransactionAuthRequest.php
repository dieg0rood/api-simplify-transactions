<?php

namespace App\ExternalServices\Request\TransactionAuth;

use App\Exception\Auth\AuthRequestException;
use App\ExternalServices\Request\AbstractRequest;
use App\Helpers\Logger;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class TransactionAuthRequest extends AbstractRequest
{
    const SERVICE_URI = '5794d450-d2e2-4412-8131-73d0293ac1cc';

    public function auth(): ResponseInterface
    {
        try {
            return $this->getClient()->get(self::SERVICE_URI);
        } catch (GuzzleException $e) {
            Logger::instanciate()->error($e->getMessage());
            throw new AuthRequestException();
        }
    }
}