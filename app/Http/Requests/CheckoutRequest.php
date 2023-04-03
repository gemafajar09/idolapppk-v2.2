<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            case 'POST':
                $rules = [
                    'bank'    => 'required|alpha|max:25',
                ];
                break;
            default:
                // Perform no alteration to rules
                break;
        }

        return $rules;
    }
}
