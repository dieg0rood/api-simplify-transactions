<?php

declare(strict_types=1);

namespace App\Controller;

use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Psr\Container\ContainerInterface;
abstract class Controller
{
    public function __construct(protected ResponseInterface $response,
                                protected RequestInterface $request,
                                protected ContainerInterface $container)
    {
    }
}
