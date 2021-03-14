<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Services\TransactionService;
use App\Http\Requests\TransactionRequest;

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
     * @param TransactionRequest $request
     * @return JsonResponse
     */
    public function transfer(TransactionRequest $request): JsonResponse
    {
        return $this->transactionService->transfer(
            $request->get('payer'), $request->get('payee'), $request->get('value')
        );
    }
}
