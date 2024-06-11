<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDepartment extends FormRequest
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
            'name' => [
                'required',
                'max:45',
                Rule::unique('departments', 'name')->ignore($this->department->name)
            ],
            'superior_id' => 'nullable|exists:departments,id',
            'parent_id' => 'nullable|exists:departments,id',
            'embassador_id' => 'nullable|exists:departments,id',
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
            'name.unique' => 'El nombre ya ha sido usado',
            'name.max' => 'Máximo 45 caracteres',
        ];
    }
}
