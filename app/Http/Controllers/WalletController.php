<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Wallet;
use App\Http\Requests\AddEditWalletRequest;
use App\Http\Requests\TransferWalletRequest;

class WalletController extends Controller
{
    public function listWallet()
    {
        $data["arr"] = Wallet::where("user_id", session("user_id"))->orderBy("id", "desc")->paginate(4);
        return view("list_wallet", $data);
    }

    public function deleteWallet($id)
    {
        Wallet::destroy($id);
        return redirect(url('admin/wallet'));
    }
}
