<?php

namespace App\Http\Requests\Comment;

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
            'content' => ['required', 'string', 'max:1000'],
            'commentable_type' => ['required', 'string', 'in:App\Models\Novel,App\Models\Chapter'],
            'commentable_id' => ['required', 'integer'],
        ];
    }

    public function messages(): array
    {
        return [
            'content.required' => 'Nội dung bình luận không được để trống',
            'content.max' => 'Nội dung bình luận không được vượt quá 1000 ký tự',
            'commentable_type.required' => 'Loại đối tượng không được để trống',
            'commentable_type.in' => 'Loại đối tượng không hợp lệ',
            'commentable_id.required' => 'ID đối tượng không được để trống',
            'commentable_id.integer' => 'ID đối tượng phải là số nguyên',
        ];
    }
} 