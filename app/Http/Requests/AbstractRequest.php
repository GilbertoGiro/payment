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
        parent::__construct();
    }

    /**
     * Method who specify request validation rules
     * e.g: ['email' => 'required|email']
     * @return array
     */
    abstract protected function rules(): array;

    /**
     * Method who specify the return messages from request validation
     * e.g: ['email.required' => 'Field :attribute must contains an valid mail']
     * @return array
     */
    abstract protected function messages(): array;

    /**
     * Method to validate request
     * @param Request $request
     * @throws ValidationException
     */
    private function applyRules(Request $request)
    {
        $this->validate($request, $this->rules(), $this->messages());
    }
}
