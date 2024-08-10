<?php

namespace App\Http\Requests;

use App\Traits\JsonResponse;
use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateProfileRequest extends FormRequest
{
    use JsonResponse;

    protected $stopOnFirstFailure = true;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth('sanctum')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . auth()->id(),
            'phone' => 'required|string|max:255|regex:/^01[0125][0-9]{8}$/|unique:users,phone,' . auth()->id(),
            'email' => 'required|string|email|max:255|unique:users,email,' . auth()->id(),
        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'username.required' => 'Username is required',
            'phone.required' => 'Phone is required',
            'phone.regex' => 'Phone must be a valid phone number',
            'email.required' => 'Email is required',
            'email.email' => 'Email must be a valid email address',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->error(422, "Validation didn't pass . Please correct those fields", $validator->errors()));
    }
}
