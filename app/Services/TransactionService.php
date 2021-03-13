<?php

namespace App\Services;

use App\Traits\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Repositories\TransactionRepository;

class TransactionService
{
    use Response;

    /**
     * Variable who contains transaction repository
     * @var TransactionRepository
     */
    protected $transactionRepository;

    /**
     * TransactionService constructor.
     * @param TransactionRepository $transactionRepository
     */
    public function __construct(TransactionRepository $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    /**
     * Method responsible for transfer money between users
     * e.g: ['payer' => 1, 'payee' => 2, 'value' => 400.00]
     * @param array $data
     * @return JsonResponse
     */
    public function transfer(array $data): JsonResponse
    {
        DB::beginTransaction();
        try {
            // Commit transaction
            DB::commit();
        } catch (\Exception $e) {
            // Rollback transaction
            DB::rollback();
        }
    }
}
