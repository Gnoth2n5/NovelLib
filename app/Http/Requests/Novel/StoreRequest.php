<?php

namespace App\Http\Requests\Novel;

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
            'description' => ['required', 'string'],
            'cover_image' => ['required', 'image', 'max:2048'],
            'categories' => ['required', 'array'],
            'categories.*' => ['exists:categories,id'],
            'status' => ['required', 'in:draft,published'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Tiêu đề không được để trống',
            'title.max' => 'Tiêu đề không được vượt quá 255 ký tự',
            'description.required' => 'Mô tả không được để trống',
            'cover_image.required' => 'Ảnh bìa không được để trống',
            'cover_image.image' => 'File phải là ảnh',
            'cover_image.max' => 'Kích thước ảnh không được vượt quá 2MB',
            'categories.required' => 'Vui lòng chọn ít nhất một thể loại',
            'categories.array' => 'Thể loại không hợp lệ',
            'categories.*.exists' => 'Thể loại không tồn tại',
            'status.required' => 'Trạng thái không được để trống',
            'status.in' => 'Trạng thái không hợp lệ',
        ];
    }
} 