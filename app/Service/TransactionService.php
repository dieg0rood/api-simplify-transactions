<?php

namespace App\Service;

use App\Enum\UserTypesEnum;
use App\Exception\ApplicationException;
use App\Exception\User\EnterpriseUserCannotBePayerException;
use App\Exception\Wallet\InsufficientWalletAmountException;
use App\ExternalServices\Service\TransactionAuthService;
use App\Interfaces\Request\TransactionRequestInterface;
use App\Repository\TransactionsRepository;
use App\Repository\UserRepository;
use App\Repository\WalletRepository;
use App\Resource\TransactionResource;
use Hyperf\DbConnection\Db;
use App\Helpers\Logger;

class TransactionService
{
    private UserRepository $senderRepository;
    private UserRepository $receiverRepository;
    private TransactionAuthService $transactionAuthService;
    public function __construct()
    {
        $this->transactionAuthService = TransactionAuthService::instanciate();
    }

    public static function instanciate(): TransactionService
    {
        return new TransactionService();
    }

    private function definePeoples(TransactionRequestInterface $request): void
    {
        $this->senderRepository = UserRepository::instanciate($request->getSenderId());
        $this->receiverRepository = UserRepository::instanciate($request->getReceiverId());
    }

    public function makeTransaction(TransactionRequestInterface $request): TransactionResource|ApplicationException
    {
        $this->definePeoples($request);

        $sender = $this->senderRepository->user();
        $senderWallet = $this->senderRepository->wallet();

        if ($sender->toArray()['type'] === UserTypesEnum::Enterprise->value) {
            throw new EnterpriseUserCannotBePayerException();
        }

        if ($senderWallet->toArray()['amount'] < $request->getTransactionValue()) {
            throw new InsufficientWalletAmountException();
        }

        $receiver = $this->receiverRepository->user();
        $receiverWallet = $this->receiverRepository->wallet();

        Db::beginTransaction();
        try {
            $this->transactionAuthService->auth();
            WalletRepository::withdraw($senderWallet, $request->getTransactionValue());
            WalletRepository::deposit($receiverWallet, $request->getTransactionValue());
            $transaction = TransactionsRepository::create($sender, $receiver, $request->getTransactionValue());
            DB::commit();
            return $transaction;
        } catch (ApplicationException $e) {
            DB::rollback();
            throw $e;
        } catch (\Exception $e) {
            var_dump($e->getMessage());
            DB::rollback();
            Logger::instanciate()->error($e->getMessage());
            throw new ApplicationException();
        }
    }
}