<?php

declare(strict_types=1);

namespace HyperfTest\Cases\Wallet;

use HyperfTest\Cases\AbstractTest;
use HyperfTest\Helpers\Factory\UserGenerator;

/**
 * @internal
 * @coversNothing
 */
class WalletTransactionTest extends AbstractTest
{
    public function testTransactionUserToUser()
    {
        $payer = UserGenerator::init()->withWallet()->initialAmount(10000)->create();
        $payee = UserGenerator::init()->withWallet()->initialAmount(0)->create();

        $body = [
            'value' => 50.00,
            'payer' => $payer['id'],
            'payee' => $payee['id'],
        ];
        $response = $this->getData($this->post('/wallet/transaction', $body));
    }

//    public function testTransactionWithEnterpriseUserCannotBePayerException()
//    {
//        $payer = UserGenerator::init()->enterprise()->withWallet()->initialAmount(10000)->create();
//        $payee = UserGenerator::init()->withWallet()->initialAmount(0)->create();
//
//        $body = [
//            'value' => 5000,
//            'payer' => $payer['id'],
//            'payee' => $payee['id'],
//        ];
//        $response = $this->post('/wallet/transaction', $body);
//    }

//    public function testTransactionWithInsufficientAmountException()
//    {
//        $payer = UserGenerator::init()->withWallet()->initialAmount(10000)->create();
//        $payee = UserGenerator::init()->withWallet()->initialAmount(0)->create();
//
//        $body = [
//            'value' => 50000,
//            'payer' => $payer['id'],
//            'payee' => $payee['id'],
//        ];
//        $response = $this->post('/wallet/transaction', $body);
//    }
}
