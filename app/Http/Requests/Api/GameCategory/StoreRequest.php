<?php

namespace App\Http\Requests\Api\GameCategory;

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
            'category_id.required' => 'The category_id field is required',
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
            'game_id' => 'required',
            'category_id' => 'required',
        ];
    }
}
