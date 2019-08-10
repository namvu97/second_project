<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Wallet;
use App\Transaction;
use App\Http\Requests\TransferWalletRequest;

class TransferWalletController extends Controller
{

    public function transferWallet()
    {
        $data["record"] = Wallet::where("user_id", session("user_id"))->get();
        return view("add_edit_transfer", $data);
    }

    public function doTransferWallet(TransferWalletRequest $request)
    {
        $amount = $this->getAmount($request->get("amount"));
        if ($request->get("from_wallet") != $request->get("to_wallet")) {
            $wallet_one = Wallet::whereRaw("wallet_name = ? AND user_id = ?", [$request->get("from_wallet"), session("user_id")])->select("current_balance")->first();
            $wallet_two = Wallet::whereRaw("wallet_name = ? AND user_id = ?", [$request->get("to_wallet"), session("user_id")])->select("current_balance")->first();
            if ($wallet_one->current_balance - $amount >= 0) {
                Wallet::whereRaw("wallet_name = ? AND user_id = ?", [$request->get("from_wallet"), session("user_id")])->update(array("current_balance" => $wallet_one->current_balance - $amount));
                Wallet::whereRaw("wallet_name = ? AND user_id = ?", [$request->get("to_wallet"), session("user_id")])->update(array("current_balance" => $wallet_two->current_balance + $amount));
                Transaction::insert(array("amount" => $amount, "time" => $request->get("time"), "from_wallet" => $request->get("from_wallet"), "to_wallet" => $request->get("to_wallet"), "user_id" => session("user_id") ));
                return redirect(url('admin/wallet'));
            } else
                return redirect(url('admin/wallet/transfer?err=money'));
        } else
            return redirect(url('admin/wallet/transfer?err=wallet'));
    }
}
