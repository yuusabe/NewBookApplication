<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAccount extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'account_name' => 'required',
            'mail_address' => 'required',
            'manager_flag' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'account_name.required' => '入力されていないボックスがあります。入力してください。',
            'mail_address.required' => '入力されていないボックスがあります。入力してください。',
            'manager_flag.required' => '入力されていないボックスがあります。入力してください。'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(response()->json([
            'message' => 'Validation Error.',
            'errors' => $errors,
        ], 422, [], JSON_UNESCAPED_UNICODE));
    }
}
