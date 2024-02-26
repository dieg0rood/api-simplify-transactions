<?php

namespace App\Helpers;

use Hyperf\Logger\LoggerFactory;

class Logger
{
    public static function instanciate(string $group = 'default')
    {
        return make(LoggerFactory::class)->get('sys', $group);
    }
}
