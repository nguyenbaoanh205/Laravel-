<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
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
            'price' => 'required|integer',
            'quantity' => 'required|integer',
            // 'category_id' => 'required|exists:categories,id',
            'category_id' => [
                'required',
                Rule::exists('categories', 'id')->where('status', 1)
            ],
            'image' => $this->isMethod('post') ? ['required', 'image'] : ['nullable', 'image'],
            'status' => 'required|boolean',
            'description' => 'nullable|string',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên sản phẩm kh đuọc để trống',
            'name.string' => 'Tên sản phẩm phải là chuỗi kí tự',
            'name.max' => 'Tên sản phẩm kh vượt quá 255 ký tự',
            'price.required' => 'Kh được để trống giá',
            'price.integer' => 'Giá phải là số',
            'quantity.required' => 'Số lượng kh được để trống',
            'quantity.integer' => 'Số lượng phải là dạng số',
            'category_id.required' => 'Kh được để trống danh mục',
            'image.required' => 'Hình ảnh kh được để trống',
            'image.image' => 'Image phải là dạng ảnh',
            'status.required' => 'Trạng thái kh được bỏ trống',
            'status.boolean' => 'Trạng thái chỉ có hoạt động, tạm dừng',
            'description.string' => 'mô tả phải là chuỗi kí tự',
        ];
    }
}
