<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductValidationRequest extends FormRequest
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
    public function rules()
    {
        $product = ((request()->has('product_id') && request()->product_id != '') ? $this->product_id : null);
        // dd($product);
        $rules = [
            'title' => 'required|max:255|unique:products,title,' . ($product ? $product : ''),
            'description' => 'required|max:1024'
        ];

        if ($this->isMethod('patch')) {
            $rules['image'] = 'nullable|mimes:png,jpg,jpeg';
        } else {
            $rules['image'] = 'required|mimes:png,jpg,jpeg';
        }
        return $rules;
    }
    public function messages()
    {
        return [
            'title.required' => 'Title is Required!',
            'title.unique' => 'Title Must be Unique!',
            'image.required' => 'Image is Required!',
            'description.required' => 'Description is Required!',
            'description.max' => 'Max Limit for Description is 1024 Characters!',
        ];
    }
}
