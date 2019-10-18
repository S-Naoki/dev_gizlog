<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class SearchQuestionsRequest extends FormRequest
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
            'search_category_id' => 'nullable|exists:tag_categories,id',
            'search_word'        => 'max:50'
        ];
    }

    public function messages()
    {
        return [
            'search_word.max' => ':max文字以内で入力してください。'
        ];
    }
}
