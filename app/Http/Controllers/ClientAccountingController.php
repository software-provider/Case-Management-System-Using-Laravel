<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\Income;
use Illuminate\Support\Facades\Validator;
use DB;

class ClientAccountingController extends Controller {

    // get all client accounting
    public function getClientAccountingAll() {

        // get all client accounting
        $expenses = Expense::orderBy('date', 'desc')->select('amount as expense_amount', 'expenses.*')->with('linked_case')->get()->all();
        $incomes = Income::orderBy('date', 'desc')->select('amount as income_amount', 'incomes.*')->with('linked_case')->get()->all();

        return response()->json(array("response" => "success", "data" => collect(array_merge($expenses, $incomes))->sortByDesc("date")->values()));
    }

    // get client accounting by range
    public function getClientAccountingRange(Request $request) {

        // get all client accounting
        $expenses = Expense::whereBetween('date', [$request->start, $request->end])->orderBy('date', 'desc')->select('amount as expense_amount', 'expenses.*')->with('linked_case')->get()->all();
        $incomes = Income::whereBetween('date', [$request->start, $request->end])->orderBy('date', 'desc')->select('amount as income_amount', 'incomes.*')->with('linked_case')->get()->all();

        return response()->json(array("response" => "success", "data" => collect(array_merge($expenses, $incomes))->sortByDesc("date")->values()));
    }
}
