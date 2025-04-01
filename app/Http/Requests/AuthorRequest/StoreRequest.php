<?php

namespace App\Http\Requests\AuthorRequest;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'reason' => ['required', 'string', 'max:1000'],
            'portfolio' => ['required', 'string', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'reason.required' => 'Lý do không được để trống',
            'reason.max' => 'Lý do không được vượt quá 1000 ký tự',
            'portfolio.required' => 'Portfolio không được để trống',
            'portfolio.max' => 'Portfolio không được vượt quá 1000 ký tự',
        ];
    }
} 