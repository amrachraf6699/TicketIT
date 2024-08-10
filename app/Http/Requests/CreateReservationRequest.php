<?php

namespace App\Http\Requests;

use App\Traits\JsonResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateReservationRequest extends FormRequest
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
            'event_price_id' => 'required|exists:event_prices,id',
        ];
    }

    public function messages(): array
    {
        return [
            'event_price_id.required' => 'Event Price is required',
            'event_price_id.exists' => 'Please select a valid Event Price',
        ];
    }


    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->error(422, "Validation didn't pass . Please correct those fields", $validator->errors()));
    }
}
