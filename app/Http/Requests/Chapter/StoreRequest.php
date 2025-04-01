<?php

namespace App\Http\Requests\Chapter;

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
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'novel_id' => ['required', 'exists:novels,id'],
            'order' => ['required', 'integer', 'min:1'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Tiêu đề không được để trống',
            'title.max' => 'Tiêu đề không được vượt quá 255 ký tự',
            'content.required' => 'Nội dung không được để trống',
            'novel_id.required' => 'Truyện không được để trống',
            'novel_id.exists' => 'Truyện không tồn tại',
            'order.required' => 'Thứ tự chương không được để trống',
            'order.integer' => 'Thứ tự chương phải là số nguyên',
            'order.min' => 'Thứ tự chương phải lớn hơn 0',
        ];
    }
} 