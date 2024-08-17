<?php

namespace App\Http\Requests\EventPlanner;

use App\Traits\JsonResponse;
use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateEventRequest extends FormRequest
{
    use JsonResponse;

    protected $stopOnFirstFailure = true;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth('sanctum')->check() && auth('sanctum')->user()->eventPlanner()->exists();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' =>[
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) {
                    $exists = auth('sanctum')->user()->eventPlanner->events()
                        ->where('title', $value)
                        ->exists();

                    if ($exists) {
                        $fail("You already have an event with the title $value");
                    }
                },
            ],
            'description' => 'required|string',
            'banner' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'start_date' => 'required|date|after:today',
            'end_date' => 'required|date|after:start_date',
            'google_map_url' => 'required|string|active_url',
            'location' => 'required|string',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->error(422, "Validation didn't pass . Please correct those fields", $validator->errors()));
    }
}
