<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

abstract class AbstractRequest extends Request
{
    use ProvidesConvenienceMethods;

    /**
     * AbstractRequest constructor.
     * @param Request $request
     * @throws ValidationException
     */
    final public function __construct(Request $request)
    {
        // Call method to apply request rules
        $this->applyRules($request);
        // If request pass, then call parent constructor
        parent::__construct($request->all());
    }

    /**
     * Method who specify request validation rules
     * e.g: ['email' => 'required|email']
     * @return array
     */
    abstract protected function rules(): array;

    /**
     * Method who specify the return messages from request validation
     * e.g: ['required' => 'Field :attribute must be given']
     * @return array
     */
    protected function messages(): array
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'numeric' => 'O campo :attribute só aceita valores numéricos',
            'integer' => 'O campo :attribute só aceita valores inteiros',
            'float' => 'O campo :attribute só aceita valores decimais',
            'exists' => 'O usuário fornecido no campo :attribute é inválido',
            'can' => 'O usuário fornecido no campo :attribute não possui o permissionamento correto'
        ];
    }

    /**
     * Method who specify the custom return messages from request validation
     * e.g: ['email.required' => 'We need to know your email address!']
     * @return array
     */
    protected function customMessages(): array
    {
        return [];
    }

    /**
     * Method to validate request
     * @param Request $request
     * @throws ValidationException
     */
    private function applyRules(Request $request)
    {
        $this->validate($request, $this->rules(), array_merge($this->messages(), $this->customMessages()));
    }

    /**
     * Method to retrieve custom validation response (If fail)
     * @param Request $request
     * @param array $errors
     * @return array
     */
    protected function buildFailedValidationResponse(Request $request, array $errors): array
    {
        return ['code' => 400, 'message' => 'Houve problemas de validação de alguns campos', 'errors' => $errors];
    }
}
