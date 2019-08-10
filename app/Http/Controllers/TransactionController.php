<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Category;
use DB;

class TransactionController extends Controller
{

    public function listTransaction($type)
    {
        $data["type"] = $type;
        if ($type == "type=tranfer") {
            $data["arr"] = Transaction::where("category_id", NULL)
            ->where("user_id",session("user_id"))
            ->orderBy("id", "desc")
            ->paginate(4);
            return view("list_transaction", $data);
        }
        else if ($type == "type=category_revenue") {
            $data["arr"] = Transaction::join('category', 'category_id', '=', 'category.id')
            ->where("category.user_id",session("user_id"))
            ->where("category.category_type",0)
            ->select("transaction.*","category.category_name","category.category_type")
            ->orderBy("transaction.id", "desc")
            ->paginate(4);
            return view("list_transaction", $data);
        }
        else if ($type == "type=category_expense") {
            $data["arr"] = Transaction::join('category', 'category_id', '=', 'category.id')
            ->whereRaw("category.user_id = ? AND category.category_type = ?", [session("user_id"), 1])
            ->select("transaction.*","category.category_name","category.category_type")
            ->orderBy("transaction.id", "desc")
            ->paginate(4);
            return view("list_transaction", $data);
        }
        else if ($type == "type=time") {
            $data["arr"] = Transaction::where("user_id", session("user_id"))
            ->orderBy("time", "desc")
            ->paginate(4);
            return view("list_transaction", $data);
        }else {
            return view("report_layout");
        }
    }

    public function deleteTransaction($type, Request $request, $id)
    {
        Transaction::destroy($id);
        return redirect(url('admin/transaction/' . $type));
    }
}
