<?php

namespace App\Http\Requests\Admin\Role;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRoleRequest extends FormRequest
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
        $validate = [
            'role_name'=>['required',Rule::unique('role','role_name')->ignore($this->route('id')),'between:1,100'],
            'page'=>['required'],
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
