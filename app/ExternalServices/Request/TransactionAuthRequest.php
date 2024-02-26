<?php

namespace App\ExternalServices\Request;

use App\Exception\Auth\AuthRequestException;
use App\Helpers\Logger;
use GuzzleHttp\Exception\GuzzleException;

class TransactionAuthRequest extends AbstractRequest
{
    const SERVICE_URI = '5794d450-d2e2-4412-8131-73d0293ac1cc';

    public function auth()
    {
        try {
            $response = $this->getClient()->get(self::SERVICE_URI);
            return $response;
        } catch (GuzzleException $e) {
            Logger::instanciate()->error($e->getMessage());
            throw new AuthRequestException();
        }
    }
}