<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransferWalletRequest extends FormRequest
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
            'amount' => 'required',
            'time' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'amount.required' => 'Số tiền chuyển không được để trống!',
            'time.required' => 'Thời gian chuyển không được để trống!',
        ];
    }
}
