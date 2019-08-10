<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddEditTransactionRequest extends FormRequest
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
            'from_wallet' => 'required',
            'to_wallet' => 'required',
            'time' => 'required',
            'amount' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'from_wallet.required' => 'Ví gửi tiền không được để trống!',
            'to_wallet.required' => 'Ví nhận tiền không được để trống!',
            'time.required' => 'Thời gian không được để trống!',
            'amount.required' => 'Số lượng không được để trống!',
        ];
    }
}
