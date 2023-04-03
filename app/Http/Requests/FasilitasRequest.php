<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FasilitasRequest extends FormRequest
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
                    'id_paket'    => 'required|regex:/^[0-9]*$/|max:10',
                    'tipe_fasilitas'    => 'required',
                    'nama_fasilitas'    => 'required',
                    'link_fasilitas'    => '',
                    'status'    => 'required',
                ];
                break;
            case 'POST':
                $rules = [
                    'id_paket'    => 'required|regex:/^[0-9]*$/|max:10',
                    'tipe_fasilitas'    => 'required',
                    'nama_fasilitas'    => 'required',
                    'link_fasilitas'    => '',
                ];
                break;
            default:
                // Perform no alteration to rules
                break;
        }

        return $rules;
    }
}
