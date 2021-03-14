<?php

namespace App\Http\Requests;

use App\Models\Permission;
use App\Repositories\AccountRepository;
use Illuminate\Support\Facades\Validator;

class TransactionRequest extends AbstractRequest
{
    /**
     * Method to define request validation rules
     * @return string[]
     */
    protected function rules(): array
    {
        return [
            'payer' => 'bail|required|integer|exists:users,id|can:' . Permission::PERMISSION_TRANSFER . '|has_balance:value',
            'payee' => 'bail|required|integer|exists:users,id|can:' . Permission::PERMISSION_RECEIVE . '|not_equal_to:payer',
            'value' => 'bail|required|numeric|float|min:1'
        ];
    }

    /**
     * Method to define custom validation messages
     * @return string[]
     */
    protected function customMessages(): array
    {
        return [
            'payer.has_balance' => 'O usuário possui saldo insuficiente para a transação',
            'payee.not_equal_to' => 'O destinatário da transferência não pode ser o mesmo que o remetente',
            'value.min' => 'O valor mínimo para transferência é de R$1.00',
        ];
    }
}
