<?php

namespace App\Http\Requests\Admin\Designation;

use Illuminate\Foundation\Http\FormRequest;

class AddDesignationRequest extends FormRequest
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
        request()->session()->flash('add_designation',true);

        $validate = [
            'designation_name'=>['required','unique:designation,name','between:1,100'],
            'department_id'=>['required','integer']
        ];
        return $validate;

    }
    public function messages()
    {
        return config('constants.validate_message');
    }
    public function attributes()
    {
        return config('constants.validate_attribute_alias');
    }
}
