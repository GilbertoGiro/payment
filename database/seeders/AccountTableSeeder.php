<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Repository\AccountRepository;
use Illuminate\Database\Seeder;

class AccountTableSeeder extends Seeder
{
    /**
     * Variable who contains account repository
     * @var AccountRepository
     */
    private $accountRepository;

    public function __construct(AccountRepository $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }

    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        if (!$this->accountRepository->allRowsCount()) {
            Account::factory()->count(20)->create();
        }
    }
}
