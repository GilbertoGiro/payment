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
     * @OA\Post(
     *     path="/transaction",
     *     operationId="/transaction",
     *     summary="Transferir um determinado valor entre dois usuários",
     *     tags={"Transferir"},
     *     @OA\Parameter(
     *         name="payer",
     *         in="query",
     *         description="ID do remetente",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="payee",
     *         in="query",
     *         description="ID do destinatário",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="value",
     *         in="query",
     *         description="Valor a ser transferido",
     *         required=true,
     *         @OA\Schema(type="number")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Quando a transferência for bem sucedida.",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="code",
     *                 type="integer",
     *                 example=200
     *             ),
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Transferência efetuada com sucesso."
     *             ),
     *         )
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Quando houver erros de validação nos campos enviados no corpo da requisição.",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="code",
     *                 type="integer",
     *                 example=500
     *             ),
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Houve problemas de validação de alguns campos"
     *             ),
     *             @OA\Property(
     *                 property="errors",
     *                 type="array",
     *                 @OA\Items(
     *                     @OA\Property(
     *                         property="payer",
     *                         type="array",
     *                         @OA\Items(
     *                             example="O campo payer só aceita valores decimais"
     *                         )
     *                     )
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Quando a autenticação falhar.",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="code",
     *                 type="integer",
     *                 example=401
     *             ),
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Ação não autorizada."
     *             ),
     *         )
     *     ),
     *     @OA\Response(
     *         response="500",
     *         description="Quando houver problemas internos durante a execução.",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="code",
     *                 type="integer",
     *                 example=500
     *             ),
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Serviço indisponivel. Tente novamente mais tarde."
     *             ),
     *         )
     *     )
     * )
     *
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
