<?php

namespace App\Http\Controllers;

use App\Services\TransactionService;
use App\Http\Requests\TransferRequest;
use Illuminate\Http\JsonResponse;

class TransactionController extends AbstractController
{
    /**
     * Variable who contains transaction service
     * @var TransactionService
     */
    protected $transactionService;

    /**
     * TransactionController constructor.
     * @param TransactionService $transactionService
     */
    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    /**
     * Action responsible for transfer money between users
     * @param TransferRequest $request
     * @return JsonResponse
     */
    public function transfer(TransferRequest $request): JsonResponse
    {
        return $this->transactionService->transfer($request->all());
    }
}
