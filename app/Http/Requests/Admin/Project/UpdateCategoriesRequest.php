<?php

namespace App\Http\Requests\Admin\Project;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

// class UpdateCategoriesRequest extends FormRequest
// {
//     /**
//      * Determine if the user is authorized to make this request.
//      *
//      * @return bool
//      */
//     public function authorize()
//     {
//         return true;
//     }

//     /**
//      * Get the validation rules that apply to the request.
//      *
//      * @return array
//      */
//     public function rules()
//     {
//         $validate = [
//             'categories_name'=>['required','between:1,255',Rule::unique('categories_project','categories_name')->ignore($this->route('id'))],
//             'description'=>['required'],
//         ];
//         return $validate;

//     }
//     public function messages()
//     {
//         return config('constants.validate_message');
//     }
//     public function attributes()
//     {
//         return config('constants.validate_attribute_alias');
//     }
// }
