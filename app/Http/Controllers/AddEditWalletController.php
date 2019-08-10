<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Wallet;
use App\Http\Requests\AddEditWalletRequest;
use App\Http\Requests\TransferWalletRequest;

class AddEditWalletController extends Controller
{

    public function addWallet()
    {
        return view("add_edit_wallet");
    }

    public function doAddWallet(AddEditWalletRequest $request)
    {
        $amount = $this->getAmount($request->current_balance);
        $checkWalletName = Wallet::whereRaw('wallet_name = ? AND user_id = ?', [$request->wallet_name, session("user_id")])->get()->Count();
        if ($checkWalletName == 0) {
            $checkAccountNumber = Wallet::whereRaw('account_number = ? AND user_id = ?', [$request->account_number, session("user_id")])->get()->Count();
            if ($checkAccountNumber == 0) {
                Wallet::insert(array("wallet_name" => $request->wallet_name, "account_number" => $request->account_number, "current_balance" => $amount , "user_id" => session("user_id") ));
                return redirect(url('admin/wallet?mess=add_wallet-success'));
            } else
                return redirect(url('admin/wallet/add?err=account_number-exists'));
        } else
            return redirect(url('admin/wallet/add?err=wallet_name-exists'));
    }

    public function editWallet(Request $request, $id)
    {
        $data["record"] = Wallet::find($id);
        return view("add_edit_wallet", $data);
    }

    public function doEditWallet(AddEditWalletRequest $request, $id)
    {
        $amount = $this->getAmount($request->current_balance);
        $checkWalletName = Wallet::whereRaw('wallet_name = ? AND user_id = ? AND id <> ?', [$request->wallet_name, session("user_id"), $id])->get()->Count();
        if ($checkWalletName == 0) {
            $checkAccountNumber = Wallet::whereRaw('account_number = ? AND user_id = ? AND id <> ?', [$request->account_number, session("user_id"), $id])->get()->Count();
            if ($checkAccountNumber == 0) {
                Wallet::where("id", "=", $id)->update(array("wallet_name" => $request->wallet_name, "account_number" => $request->account_number, "current_balance" => $amount, "user_id" => session("user_id") ));
                return redirect(url('admin/wallet?mess=edit_wallet-success'));
            } else
                return redirect(url('admin/wallet/edit/$id?err=account_number-exists'));
        } else
            return redirect(url('admin/wallet/edit/' . $id . '?err=wallet_name-exists'));
    }
}
