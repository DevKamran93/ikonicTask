<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFeedbackRequest extends FormRequest
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
            'title' => 'required|max:255',
            'category' => 'required',
            'description' => 'required|max:1024',
        ];
    }


    public function messages()
    {
        return [
            'title.required' => 'Title is Required!',
            'category.required' => 'Please Select Category!',
            'description.required' => 'Description is Required!'
        ];
    }
}
