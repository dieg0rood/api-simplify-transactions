<?php

namespace App\Service;

use App\Enum\UserTypesEnum;
use App\Exception\ApplicationException;
use App\Exception\Auth\AuthRequestException;
use App\Exception\Notification\NotificationRequestException;
use App\Exception\Transaction\TransactionToYourselfException;
use App\Exception\User\EnterpriseUserCannotBePayerException;
use App\Exception\Wallet\InsufficientWalletAmountException;
use App\ExternalServices\Service\Notification\NotificationService;
use App\ExternalServices\Service\TransactionAuth\TransactionAuthService;
use App\Helpers\Logger;
use App\Interfaces\Request\TransactionRequestInterface;
use App\Repository\TransactionsRepository;
use App\Repository\UserRepository;
use App\Repository\WalletRepository;
use App\Resource\TransactionResource;
use Hyperf\DbConnection\Db;

class TransactionService
{
    private UserRepository $senderRepository;
    private UserRepository $receiverRepository;
    private TransactionAuthService $transactionAuthService;
    private NotificationService $notificationService;
    public function __construct()
    {
        $this->transactionAuthService = TransactionAuthService::instanciate();
        $this->notificationService = NotificationService::instanciate();
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

        if ($receiver['id'] === $sender['id']) {
            throw new TransactionToYourselfException();
        }

        Db::beginTransaction();
        try {
            $this->transactionAuthService->auth();
            WalletRepository::withdraw($senderWallet, $request->getTransactionValue());
            WalletRepository::deposit($receiverWallet, $request->getTransactionValue());
            $transaction = TransactionsRepository::create($sender, $receiver, $request->getTransactionValue());
            DB::commit();
            $this->notificationService->notify();
            return $transaction;
        } catch (AuthRequestException $e) {
            DB::rollback();
            throw $e;
        } catch (NotificationRequestException $e) {
            Logger::instanciate()->error($e->getMessage());
            // TODO: Insert job on queue
        } catch (\Exception $e) {
            DB::rollback();
            Logger::instanciate()->error($e->getMessage());
            throw new ApplicationException();
        }
    }
}