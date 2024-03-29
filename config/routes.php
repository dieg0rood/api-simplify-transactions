<?php

declare(strict_types=1);

use App\Controller\WalletController;
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
use Hyperf\HttpServer\Router\Router;

Router::addGroup('/wallet', function() {
    Router::post('/transaction', [WalletController::class, 'transaction']);
});
