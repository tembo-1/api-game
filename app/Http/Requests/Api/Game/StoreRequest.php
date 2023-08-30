<?php

namespace App\Http\Requests\Api\Game;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Custom messages for rules
     *
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'name.min' => 'The minimum length is 7 characters',
            'name.unique' => 'The name must be unique',
            'studio_id.required' => 'The studio_id field is required',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:7|unique:games',
            'studio_id' => 'required',
        ];
    }
}
