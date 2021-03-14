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
     * Method to transfer money between accounts
     * @param int $userFromId
     * @param int $userToId
     * @param float $value
     * @throws \Exception
     */
    public function transfer(int $userFromId, int $userToId, float $value)
    {
        // Remove given value from 'userFrom' account
        $this->decrement($userFromId, $value);
        // Add given value on 'userTo' account
        $this->increment($userToId, $value);
    }

    /**
     * Method to remove given value from given user account
     * @param int $userId
     * @param float $value
     */
    private function increment(int $userId, float $value)
    {
        $this->accountRepository->increment($userId, $value);
    }

    /**
     * Method to add given value on given user account
     * @param int $userId
     * @param float $value
     */
    private function decrement(int $userId, float $value)
    {
        $this->accountRepository->decrement($userId, $value);
    }
}
