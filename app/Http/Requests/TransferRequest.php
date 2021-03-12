<?php

namespace App\Http\Requests;

class TransferRequest extends AbstractRequest
{
    /**
     * Method to define request validation rules
     * @return string[]
     */
    protected function rules(): array
    {
        return [
            'payer' => 'required|numeric|exists:users,id',
            'payee' => 'required|numeric|exists:users,id',
            'value' => 'required|numeric|exists:users,id'
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
            'exists' => 'O usuário fornecido no campo :attribute é inválido'
       ];
    }
}
