<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePenggunaRequest extends FormRequest
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
        $rules = [];
        switch ($this->method()) {
            case 'PATCH':
            case 'PUT':
                $rules = [
                    'nama'    => 'required|regex:/^[a-zA-Z0-9_\- ]*$/|min:3|max:150',
                    'email'    => 'required|email|max:100',
                    'id_provinsi' => 'required|numeric',
                    'id_kota' => 'required|numeric',
                    'kode_afiliasi' => 'required|min:5|max:25',
                    'no_telpon' => 'required|regex:/^[0-9+-]*$/|min:5|max:20',
                    'informasi_bank' => 'required|regex:/^[a-zA-Z0-9_\- ]*$/|min:1|max:20',
                    'no_rekening' => 'required|regex:/^[0-9+-]*$/|min:5|max:20',
                ];
                break;
            case 'POST':
                $rules = [
                    'nama'    => 'required|regex:/^[a-zA-Z0-9_\- ]*$/|min:3|max:150',
                    'email'    => 'required|email|unique:penggunas|max:100',
                    'password' => 'min:8|required_with:password_confirmation|same:password_confirmation|max:20',
                    'password_confirmation' => 'required|min:8|max:20',
                    'id_provinsi' => 'required|integer',
                    'id_kota' => 'required|integer',
                    'iklan_idolapppk' => 'required|regex:/^[a-zA-Z0-9_\- ]*$/',
                    'kode_afiliasi' => 'nullable|min:5|regex:/^[a-zA-Z0-9_\- ]+$/|max:25',
                    'no_telpon' => 'required|regex:/^[0-9+-]*$/|min:5|max:20',
                ];
                break;
            default:
                // Perform no alteration to rules
                break;
        }

        return $rules;
    }
}
