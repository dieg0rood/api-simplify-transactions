<?php

namespace App\ExternalServices\Request\Notification;

use App\Exception\Notification\NotificationRequestException;
use App\ExternalServices\Request\AbstractRequest;
use App\Helpers\Logger;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class NotificationRequest extends AbstractRequest
{
    const SERVICE_URI = '54dc2cf1-3add-45b5-b5a9-6bf7e7f1f4a6';

    public function notify(): ResponseInterface
    {
        try {
            return $this->getClient()->get(self::SERVICE_URI);
        } catch (GuzzleException $e) {
            Logger::instanciate()->error($e->getMessage());
            throw new NotificationRequestException();
        }
    }
}