<?php

namespace App\Http\Requests\EventPlanner;

use App\Traits\JsonResponse;
use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateEventPriceRequest extends FormRequest
{
    use JsonResponse;

    protected $stopOnFirstFailure = true;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth('sanctum')->user()->role === 'event_planner';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'privileges' => 'required|array',
            'privileges.*' => 'required|string|max:255',
        ];
    }


    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->error(422, "Validation didn't pass . Please correct those fields", $validator->errors()));
    }
}
