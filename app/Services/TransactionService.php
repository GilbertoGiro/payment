<?php

namespace App\Services;

use App\Models\TransactionType;
use App\Repositories\TransactionTypeRepository;
use App\Services\Api\ExternalNotificationService;
use App\Traits\Log;
use App\Traits\Response;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Repositories\TransactionRepository;
use App\Services\Api\ExternalAuthorizeService;

class TransactionService
{
    use Response, Log;

    /**
     * Variable who contains transaction repository
     * @var TransactionRepository
     */
    protected $transactionRepository;

    /**
     * Variable who contains transaction type repository
     * @var TransactionTypeRepository
     */
    protected $transactionTypeRepository;

    /**
     * Variable who contains external authorizer service
     * @var ExternalAuthorizeService
     */
    protected $externalAuthorizeService;

    /**
     * Variable who contains external notification service
     * @var ExternalNotificationService
     */
    protected $externalNotificationService;

    /**
     * Variable who contains account service
     * @var AccountService
     */
    protected $accountService;

    /**
     * TransactionService constructor.
     * @param TransactionRepository $transactionRepository
     * @param TransactionTypeRepository $transactionTypeRepository
     * @param ExternalAuthorizeService $externalAuthorizeService
     * @param ExternalNotificationService $externalNotificationService
     * @param AccountService $accountService
     */
    public function __construct(TransactionRepository $transactionRepository, TransactionTypeRepository $transactionTypeRepository,
                                ExternalAuthorizeService $externalAuthorizeService, ExternalNotificationService $externalNotificationService,
                                AccountService $accountService)
    {
        $this->transactionRepository = $transactionRepository;
        $this->transactionTypeRepository = $transactionTypeRepository;
        $this->externalAuthorizeService = $externalAuthorizeService;
        $this->externalNotificationService = $externalNotificationService;
        $this->accountService = $accountService;
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
            // Transfer value between accounts
            $this->accountService->transfer($data['payer'], $data['payee'], $data['value']);
            // Create log of transaction
            $this->logTransaction($data);
            // Check authorize service
            $this->externalAuthorizeService->authorize();
            // Push notification
            $this->externalNotificationService->notify();
            // Commit transaction
            DB::commit();
            // Retrieve success message
            return $this->successJsonResponse('Transferência efetuada com sucesso.');
        } catch (\Exception $e) {
            // Rollback transaction
            DB::rollback();
            // Log error
            $this->errorLog($e);
            // Retrieve error message
            return $this->errorJsonResponse($e);
        }
    }

    /**
     * Method to create transaction using given data
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    private function create(array $data): Model
    {
        return $this->transactionRepository->create($data);
    }

    /**
     * Method to log transaction between two users
     * @param array $data
     */
    private function logTransaction(array $data)
    {
        // Get transaction date
        $transactionDate = date('Y-m-d H:i:s');
        // Create debited transaction
        $this->createTransaction($data['payer'], $data['value'], $transactionDate, TransactionType::TYPE_DEBITED);
        // Create credited transaction
        $this->createTransaction($data['payee'], $data['value'], $transactionDate, TransactionType::TYPE_CREDITED);
    }

    /**
     * Method to create transaction using given data
     * @param int $userId
     * @param float $value
     * @param $transactionDate
     * @param string $transactionType
     */
    private function createTransaction(int $userId, float $value, $transactionDate, string $transactionType)
    {
        // Find debited transaction type
        $transactionType = $this->transactionTypeRepository->findBy(['name' => $transactionType]);
        // Create debited transaction
        $this->create([
            'transaction_type_id' => $transactionType->id,
            'user_id' => $userId,
            'amount' => $value,
            'date' => $transactionDate
        ]);
    }
}
