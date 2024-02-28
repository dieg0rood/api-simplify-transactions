<?php

namespace App\ExternalServices\Service\Notification;

use App\ExternalServices\Request\Notification\NotificationRequest;

class NotificationService
{
    private NotificationRequest $notificationRequest;

    public function __construct()
    {
        $this->notificationRequest = make(NotificationRequest::class);
    }

    public static function instanciate(): NotificationService
    {
        return new self;
    }

    public function notify()
    {
        return $this->notificationRequest->notify();
    }
}