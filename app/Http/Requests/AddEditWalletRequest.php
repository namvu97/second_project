<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddEditWalletRequest extends FormRequest
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
            'wallet_name' => 'required|max:16|',
            'current_balance' => 'required',
            'account_number' => 'required|min:6|max:9|',
        ];
    }

    public function messages()
    {
        return [
            'wallet_name.required' => 'Tên ví không được để trống!',
            'wallet_name.max' => 'Tên ví nhiều nhất 16 ký tự!',
            'current_balance.required' => 'Số dư tài khoản không được để trống!',
            'account_number.required' => 'Số tài khoản được để trống!',
            'account_number.min' => 'Số tài khoản phải ít nhất 6 ký tự!',
            'account_number.max' => 'Số tài khoản nhiều nhất 9 ký tự!',
        ];
    }
}
