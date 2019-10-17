<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\TagCategory;

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
    
    // public function validationData()
    // {
    //     $inputs = $this->all();
    //     if ($inputs['search_category_id']) {
    //         $inputs['search_category_id'] = (int)$inputs['search_category_id'];
    //     }
    //     return $inputs;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $category_val = TagCategory::all()->pluck('id')->prepend(0);
        
        return [
            'tag_category_id' => [
                'sometimes',
                Rule::in($category_val)
            ],
            'search_word'     => [
                'max:50'
            ]
        ];
    }

    public function messages()
    {
        return [
            'search_word.max' => ':max文字以内で入力してください。'
        ];
    }
}
