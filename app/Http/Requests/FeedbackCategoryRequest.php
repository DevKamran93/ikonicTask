<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeedbackCategoryRequest extends FormRequest
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
        $category = ((request()->has('category_id') && request()->category_id != '') ? $this->category_id : null);
        // dd($category);
        return [
            'title' => 'required|max:255|unique:feedback_categories,title,' . ($category ? $category : ''),
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Title is Required!',
            'title.unique' => 'Title Must be Unique!',
        ];
    }
}
