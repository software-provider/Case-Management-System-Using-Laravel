<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\ListedCase;
use Illuminate\Support\Facades\Validator;

class ExpenseDataController extends Controller {

    // create seller id
    public function create(Request $request) {

        // validate data
        $validation = Validator::make($request->all(),[
            'date' => 'required|date_format:Y-m-d',
            'expense_name' => 'required|min:2|max:50',
            'amount' => 'required|numeric',
            'linked_case' => 'required|exists:listed_cases,id',
            'file_upload' => 'required|file|mimes:pdf'
        ]);

        // check if validation fails occured and return the first error
        if($validation->fails()) {
            return response()->json(array("response" => "failed", "message" => $validation->errors()->first()));
        }

        // generate filename
        $file_name = $request->user()->id .'_'. time() . rand() .'.pdf';

        // save the file
        $request->file('file_upload')->storeAs('expenses', $file_name);

        // declare new seller object
        $expense = new Expense;
        $expense->date = $request->date;
        $expense->expense_name = $request->expense_name;
        $expense->amount = $request->amount;
        $expense->linked_case = $request->linked_case;
        $expense->file_upload = $file_name;

        // save seller into database
        if($expense->save()) {
            return response()->json(array("response" => "success", "message" => "Expense data added into database successfully!"));
        } else {
            return response()->json(array("response" => "failed", "message" => "Unable to add expense data at this moment!"));
        }
    }

    // get seller ids
    public function get() {

        // get all sellers and return as response
        return response()->json(array("response" => "success", "data" => Expense::with("linked_case")->get()->all()));
    }

    // update seller id
    public function update(Request $request) {

        // validate data
        $validation = Validator::make($request->all(), [
            'date' => 'required|date_format:Y-m-d',
            'expense_name' => 'required|min:2|max:50',
            'amount' => 'required|numeric',
            'linked_case' => 'required|exists:listed_cases,id',
            'file_upload' => 'required|file|mimes:pdf'
        ]);

        // check if validation fails occured and return the first error
        if($validation->fails()) {
            return response()->json(array("response" => "failed", "message" => $validation->errors()->first()));
        }

        // generate filename
        $file_name = $request->user()->id .'_'. time() . rand() .'.pdf';

        // save the file
        $request->file('file_upload')->storeAs('expenses', $file_name);

        // declare new seller object
        $expense = Expense::find($request->id);
        $expense->date = $request->date;
        $expense->expense_name = $request->expense_name;
        $expense->amount = $request->amount;
        $expense->linked_case = $request->linked_case;
        $expense->file_upload = $file_name;

        // save seller into database
        if($expense->save()) {
            return response()->json(array("response" => "success", "message" => "Expense data updated successfully!"));
        } else {
            return response()->json(array("response" => "failed", "message" => "Unable to update expense data at this moment!"));
        }
    }

    // create seller id
    public function delete(Request $request) {

        // delete by id
        if(Expense::where('id', $request->id)->delete()) {

            // return with response
            return response()->json(array("response" => "success", "message" => "Expense data deleted successfully!"));
        } else {

            // return with response
            return response()->json(array("response" => "failed", "message" => "Unable to delete expense data! Please try again later!"));
        }
    }
}
