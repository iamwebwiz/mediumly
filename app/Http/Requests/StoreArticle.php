<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticle extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|unique:articles',
            'tags' => 'required',
            'content' => 'required',
            'featured_image' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'Title cannot be empty',
            'content.required' => 'Content cannot be empty',
            'title.unique' => 'This title already exist',
            'tags.required' => 'The article should have at least one tag',
            'featured_image.required' => 'The article must have a featured image',
        ];
    }
}
