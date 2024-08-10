<?php

namespace App\Http\Requests;

use App\Traits\JsonResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginRequest extends FormRequest
{

    use JsonResponse;

    protected $stopOnFirstFailure = true;
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'type' => 'required|string|in:user,admin,event_planner,speaker',
        ];
    }

    public function messages(): array
    {
        return [
            'username.required' => 'Username is required',
            'username.exists' => 'Username does not exist',
            'password.required' => 'Password is required',
            'type.required' => 'Type is required',
            'type.in' => 'Type must be one of admin,event_planner,user,speaker',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->error(422, "Validation didn't pass . Please correct those fields", $validator->errors()));
    }


}
