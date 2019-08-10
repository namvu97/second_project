<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Category;
use DB;

class CreateReportController extends Controller
{

    public function createReport(Request $request)
    {
        $transaction = new Transaction();
        $category = new Category();
        $year = $request->get("year");
        $month = $request->get("month");
        $trans = $transaction->join('category', 'category_id', '=', 'category.id')->where("category.user_id", "=", session("user_id"))
            ->whereMonth('transaction.time', $month)
            ->whereYear('transaction.time', $year);
        $revenue1 = with(clone $trans)
            ->where("category.category_type", "=", 0)
            ->select('transaction.*', 'category.category_name', 'category.category_type')
            ->get();
        $expense1 = with(clone $trans)
            ->where("category.category_type", "=", 1)
            ->select('transaction.*', 'category.category_name', 'category.category_type')
            ->get();
        $revenue = with(clone $trans)
            ->where("category.category_type", "=", 0)
            ->select('transaction.*', 'category.category_name', 'category.category_type', DB::raw('sum(transaction.amount) total'))
            ->groupBy('category.category_name')
            ->get();
        $expense = with(clone $trans)
            ->where("category.category_type", "=", 1)
            ->select('transaction.*', 'category.category_name', 'category.category_type', DB::raw('sum(transaction.amount) total'))
            ->groupBy('category.category_name')
            ->get();
        $total_revenue = 0;
        $total_expense = 0;
        foreach ($revenue1 as $rows) {
            $total_revenue += $rows->amount;
        }
        foreach ($expense1 as $rows) {
            $total_expense += $rows->amount;
        }
        $data["total_revenue"] = $total_revenue;
        $data["total_expense"] = $total_expense;
        $data["profit"] = $total_revenue - $total_expense;
        $data["revenue"] = $revenue;
        $data["expense"] = $expense;
        return view("report_layout", $data);
    }
}
