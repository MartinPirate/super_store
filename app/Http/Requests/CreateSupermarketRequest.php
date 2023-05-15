<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class CreateSupermarketRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'location_id' => 'required|exists:locations,id'
        ];
    }


    /**
     * Explicit definition of Error Messages
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Supermarket Name is required.',
            'location_id.required' => 'Supermarket Location is required.',
            'location_id.exits' => 'The Selected Supermarket Location is Not Available.',

        ];
    }


    /**
    * @param Validator $validator
    * @return void
    */
    public function failedValidation(Validator $validator): void
    {
        $messageBag = collect($validator->errors()->messages());
        $message = implode(',', $messageBag->flatten()->toArray());
        throw new HttpResponseException(response()->json(['error' => true, 'message' => $message], Response::HTTP_UNPROCESSABLE_ENTITY));

    }
}
