<?php

namespace App\Http\Requests;

use App\Models\Permission;

class TransactionRequest extends AbstractRequest
{
    /**
     * Method to define request validation rules
     * @return string[]
     */
    protected function rules(): array
    {
        return [
            'payer' => 'bail|required|numeric|exists:users,id|can:' . Permission::PERMISSION_TRANSFER,
            'payee' => 'bail|required|numeric|exists:users,id|can:' . Permission::PERMISSION_RECEIVE,
            'value' => 'bail|required|numeric|min:1'
        ];
    }

    /**
     * Method to define the return messages from request validation
     * @return string[]
     */
    protected function messages(): array
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'numeric' => 'O campo :attribute só aceita valores numéricos',
            'exists' => 'O usuário fornecido no campo :attribute é inválido',
            'value.min' => 'O valor mínimo é 1',
            'can' => 'O usuário fornecido no campo :attribute não possui o permissionamento correto'
       ];
    }
}
