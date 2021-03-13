<?php

namespace App\Services;

use App\Repositories\AccountRepository;

class AccountService
{
    /**
     * Variable who contains account repository
     * @var AccountRepository
     */
    protected $accountRepository;

    /**
     * AccountService constructor.
     * @param AccountRepository $accountRepository
     */
    public function __construct(AccountRepository $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }

    /**
     * Method to get user account by user id
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    private function getAccountByUserId(int $userId)
    {
        return $this->accountRepository->findBy(['user_id' => $userId]);
    }

    /**
     * Method to transfer money between accounts
     * @param int $userFromId
     * @param int $userToId
     * @param float $value
     * @throws \Exception
     */
    public function transfer(int $userFromId, int $userToId, float $value)
    {
        // Remove given value from 'userFrom' account
        $this->pay($userFromId, $value);
        // Add given value on 'userTo' account
        $this->receive($userToId, $value);
    }

    /**
     * Method to remove given value from given user account
     * @param int $userId
     * @param float $value
     */
    private function pay(int $userId, float $value)
    {
        // Find user account
        $account = $this->getAccountByUserId($userId);
        // Lock for update and update account value
        $this->accountRepository->lockAndUpdateBalanceByUserId(
            $userId,
            bcadd($account->balance, $value, 2)
        );
    }

    /**
     * Method to add given value on given user account
     * @param int $userId
     * @param float $value
     */
    private function receive(int $userId, float $value)
    {
        // Find user account
        $account = $this->getAccountByUserId($userId);
        // Lock for update and update account value
        $this->accountRepository->lockAndUpdateBalanceByUserId(
            $userId,
            bcsub($account->balance, $value, 2)
        );
    }
}
