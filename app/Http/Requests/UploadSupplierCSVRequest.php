<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class UploadSupplierCSVRequest extends FormRequest
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
            'id' => 'required|exists:supermarkets,id',
            'file' => 'required|mimes:csv,xlsx'
        ];
    }


    /**
     * Explicit definition of Error Messages
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'id.required' => 'Supermarket Id is required.',
            'id.exists' => 'Supermarket with that Id does not exist.',
            'file.required' => 'Supplier CSV file  is required.',
            'file.mimes' => 'Upload a valid file format, CSV required.',

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
