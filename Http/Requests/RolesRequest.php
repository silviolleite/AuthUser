<?php

namespace AuthUser\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RolesRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id= $this->route('role');
        return [
            'name' => "required|max:255|unique:roles,name,$id"
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Nome'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
