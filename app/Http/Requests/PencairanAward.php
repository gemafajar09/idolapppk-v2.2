<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PencairanAward extends FormRequest
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
            'saldo_komisi_award'    => 'required|regex:/^[0-9.]*$/',
            'point_award'    => 'required|regex:/^[0-9.]*$/',
            'informasi_bank'    => 'required|regex:/^[a-zA-Z0-9_\- ]*$/',
            'no_rekening'    => 'required|regex:/^[0-9.]*$/',
            'nama_penerima'    => 'required|regex:/^[a-zA-Z0-9_\- ]*$/',
        ];
    }
}