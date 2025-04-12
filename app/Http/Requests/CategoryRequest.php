<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
        // false: 403 authorize
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'status' => 'required|boolean'
        ];
    }   

    public function messages()
    {
        return [
            'name.required' => 'Tên danh mục kh được để trống',
            'name.string' => 'Tên danh mục là kiểu chuỗi kí tự',
            'name.max' => 'Tên danh mục kh vượt quá 255 kí tự',
            'status.required' => 'Trạng thái không được bỏ trống',
            'status.boolean' => 'Trạng thái chỉ có hoạt động, tạm dừng'
        ];
    }
}
