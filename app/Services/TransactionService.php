<?php

namespace App\Services;

use App\Services\Api\ExternalAuthorizeService;
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
     * Variable who contains external authorizer service
     * @var ExternalAuthorizeService
     */
    protected $externalAuthorizeService;

    /**
     * TransactionService constructor.
     * @param TransactionRepository $transactionRepository
     * @param ExternalAuthorizeService $externalAuthorizeService
     */
    public function __construct(TransactionRepository $transactionRepository, ExternalAuthorizeService $externalAuthorizeService)
    {
        $this->externalAuthorizeService = $externalAuthorizeService;
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
            // Check authorize service
            $this->externalAuthorizeService->authorize();
            // Commit transaction
            DB::commit();
        } catch (\Exception $e) {
            // Rollback transaction
            DB::rollback();
        }
    }
}
