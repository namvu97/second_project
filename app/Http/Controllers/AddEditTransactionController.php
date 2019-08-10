<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Wallet;
use App\Category;
use DB;
use App\Http\Requests\AddEditTransactionRequest;

class AddEditTransactionController extends Controller
{

    public function addTransaction($type)
    {
        $data["type"] = $type;
        $data["wallet"] = Wallet::where("user_id", session("user_id"))->get();
        if($type == "type=category_revenue"){
            $data["revenue"] = Category::where("category.user_id", "=", session("user_id"))->where('category_type', '=', 0)->get();
        }else if($type == "type=category_expense"){
            $data["expense"] = Category::where("category.user_id", "=", session("user_id"))->where('category_type', '=', 1)->get();
        }
        return view("add_edit_transaction", $data);
    }

    public function doAddTransaction($type, AddEditTransactionRequest $request)
    {
        $transaction = new Transaction;
        $transaction->from_wallet = $request->get("from_wallet");
        $transaction->to_wallet = $request->get("to_wallet");
        $amount = $this->getAmount($request->get("amount")) ;
        $transaction->time = $request->get("time");
        $transaction->user_id = session("user_id");
        if ($transaction->from_wallet != $transaction->to_wallet) {
            if ($type == "type=tranfer") {
                $wallet_one = Wallet::whereRaw("wallet_name = ? AND user_id = ?", [$transaction->from_wallet, session("user_id")])->first();
                $wallet_two = Wallet::whereRaw("wallet_name = ? AND user_id = ?", [$transaction->to_wallet, session("user_id")])->first();
                if ($wallet_one->current_balance - $amount >= 0) {
                    Wallet::whereRaw("wallet_name = ? AND user_id = ?", [$transaction->from_wallet, session("user_id")])->update(array("current_balance" => $wallet_one->current_balance - $amount));
                    Wallet::whereRaw("wallet_name = ? AND user_id = ?", [$transaction->to_wallet, session("user_id")])->update(array("current_balance" => $wallet_two->current_balance + $amount));
                    $transaction->user_id = session("user_id");
                    $transaction->amount = $amount;
                    $transaction->save();
                    return redirect(url('admin/transaction/' . $type . '?mess=add_transaction-success'));
                } else
                    return redirect(url('admin/transaction/' . $type . '/add?err=money'));
            }else if ($type == "type=category_revenue") {
                $to_wallet = Wallet::whereRaw("wallet_name = ? AND user_id = ?", [$transaction->to_wallet, session("user_id")])->first();
                Wallet::whereRaw("wallet_name = ? AND user_id = ?", [$transaction->to_wallet, session("user_id")])->update(array("current_balance" => $to_wallet->current_balance + $amount));
                $transaction->user_id = session("user_id");
                $transaction->category_id = $request->get("category_id");
                $transaction->amount = $amount;
                $transaction->save();
                return redirect(url('admin/transaction/' . $type . '?mess=add_transaction-success'));
            } else if ($type == "type=category_expense") {
                $from_wallet = Wallet::whereRaw("wallet_name = ? AND user_id = ?", [$transaction->from_wallet, session("user_id")])->first();
                if ($from_wallet->current_balance - $amount >= 0) {
                    Wallet::whereRaw("wallet_name = ? AND user_id = ?", [$transaction->from_wallet, session("user_id")])->update(array("current_balance" => $from_wallet->current_balance - $amount));
                    $transaction->user_id = session("user_id");
                    $transaction->category_id = $request->get("category_id");
                    $transaction->amount = $amount;
                    $transaction->save();
                    return redirect(url('admin/transaction/' . $type . '?mess=add_transaction-success'));
                } else
                    return redirect(url('admin/transaction/' . $type . '/add?err=money'));
            }
        } else
            return redirect(url('admin/wallet/transfer?err=wallet'));
    }

    public function editTransaction($type, $id)
    {
        $data["wallet"] = Wallet::where("user_id", session("user_id"))->get();
        $data["type"] = $type;
        $data["revenue"] = Category::whereRaw("category.user_id = ? AND category_type = ?", [session("user_id"), 0])->get();
        $data["expense"] = Category::whereRaw("category.user_id = ? AND category_type = ?", [session("user_id"), 1])->get();
        $data["record"] = Transaction::find($id);
        return view("add_edit_transaction", $data);
    }

    public function doEditTransaction($type, $id, AddEditTransactionRequest $request)
    {
        $transaction = new Transaction;
        $transaction = $transaction->find($id);
        $oldTransaction = new Transaction;
        $oldTransaction = $transaction->find($id);
        $oldFromWallet = $oldTransaction->from_wallet;
        $oldToWallet = $oldTransaction->to_wallet;
        $oldAmount = $oldTransaction->amount;
        $transaction->from_wallet = $request->get("from_wallet");
        $transaction->to_wallet = $request->get("to_wallet");
        $transaction->amount = $this->getAmount($request->get("amount")) ;
        $transaction->time = $request->get("time");
        $transaction->user_id = session("user_id");
        $wallet = new Wallet;
        if ($transaction->from_wallet != $transaction->to_wallet) {
            if ($type == "type=tranfer") {
                $wallet->walletOne($oldFromWallet, $oldAmount);
                $wallet->walletTwo($oldToWallet, $oldAmount);
                $wallet_one = Wallet::whereRaw("wallet_name = ? AND user_id = ?", [$transaction->from_wallet, session("user_id")])->first();
                $wallet_two = Wallet::whereRaw("wallet_name = ? AND user_id = ?", [$transaction->to_wallet, session("user_id")])->first();
                if ($wallet_one->current_balance - $transaction->amount >= 0) {
                    Wallet::whereRaw("wallet_name = ? AND user_id = ?", [$transaction->from_wallet, session("user_id")])->update(array("current_balance" => $wallet_one->current_balance - $transaction->amount));
                    Wallet::whereRaw("wallet_name = ? AND user_id = ?", [$transaction->to_wallet, session("user_id")])->update(array("current_balance" => $wallet_two->current_balance + $transaction->amount));
                    $transaction->user_id = session("user_id");
                    $transaction->save();
                    return redirect(url('admin/transaction/' . $type . '?mess=edit_transaction-success'));
                } else
                    return redirect(url('admin/transaction/' . $type . '/add?err=money'));
            }else if ($type == "type=category_revenue") {
                $wallet->walletTwo($oldToWallet, $oldAmount);
                $to_wallet = Wallet::whereRaw("wallet_name = ? AND user_id = ?", [$transaction->to_wallet, session("user_id")])->first();
                Wallet::whereRaw("wallet_name = ? AND user_id = ?", [$transaction->to_wallet, session("user_id")])->update(array("current_balance" => $to_wallet->current_balance + $transaction->amount));
                $transaction->user_id = session("user_id");
                $transaction->category_id = $request->get("category_id");
                $transaction->save();
                return redirect(url('admin/transaction/' . $type . '?mess=edit_transaction-success'));
            } else if ($type == "type=category_expense") {
                $wallet->walletOne($oldFromWallet, $oldAmount);
                $from_wallet = Wallet::whereRaw("wallet_name = ? AND user_id = ?", [$transaction->from_wallet, session("user_id")])->first();
                if ($from_wallet->current_balance - $transaction->amount >= 0) {
                    Wallet::whereRaw("wallet_name = ? AND user_id = ?", [$transaction->from_wallet, session("user_id")])->update(array("current_balance" => $from_wallet->current_balance - $transaction->amount));
                    $transaction->user_id = session("user_id");
                    $transaction->category_id = $request->get("category_id");
                    $transaction->save();
                    return redirect(url('admin/transaction/' . $type . '?mess=edit_transaction-success'));
                } else
                    return redirect(url('admin/transaction/' . $type . '/add?err=money'));
            }
        } else
            return redirect(url('admin/wallet/transfer?err=wallet'));
    }
}
