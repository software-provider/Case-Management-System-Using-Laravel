<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Income;
use App\Models\ListedCase;
use Illuminate\Support\Facades\Validator;

class IncomeDataController extends Controller {

    // create seller id
    public function create(Request $request) {

        // validate data
        $validation = Validator::make($request->all(),[
            'date' => 'required|date_format:Y-m-d',
            'description' => 'required|min:5|max:1000',
            'amount' => 'required|numeric',
            'linked_case' => 'required|exists:listed_cases,id',
            'settlement_id' => 'required|exists:settlements,id',
            'seller_id' => 'required|exists:sellers,id'
        ]);

        // check if validation fails occured and return the first error
        if($validation->fails()) {
            return response()->json(array("response" => "failed", "message" => $validation->errors()->first()));
        }

        // declare new seller object
        $income = new Income;
        $income->date = $request->date;
        $income->description = $request->description;
        $income->amount = $request->amount;
        $income->linked_case = $request->linked_case;
        $income->settlement_id = $request->settlement_id;
        $income->seller_id = $request->seller_id;

        // save seller into database
        if($income->save()) {
            return response()->json(array("response" => "success", "message" => "Income data added into database successfully!"));
        } else {
            return response()->json(array("response" => "failed", "message" => "Unable to add income data at this moment!"));
        }
    }

    // get seller ids
    public function get() {

        // get all sellers and return as response
        return response()->json(array("response" => "success", "data" => Income::with("linked_case", "settlement", "seller")->get()->all()));
    }

    // update seller id
    public function update(Request $request) {

        // validate data
        $validation = Validator::make($request->all(),[
            'date' => 'required|date_format:Y-m-d',
            'description' => 'required|min:5|max:1000',
            'amount' => 'required|numeric',
            'linked_case' => 'required|exists:listed_cases,id',
            'settlement_id' => 'required|exists:settlements,id',
            'seller_id' => 'required|exists:sellers,id'
        ]);

        // check if validation fails occured and return the first error
        if($validation->fails()) {
            return response()->json(array("response" => "failed", "message" => $validation->errors()->first()));
        }

        // declare new seller object
        $income = Income::find($request->id);
        $income->date = $request->date;
        $income->description = $request->description;
        $income->amount = $request->amount;
        $income->linked_case = $request->linked_case;
        $income->settlement_id = $request->settlement_id;
        $income->seller_id = $request->seller_id;

        // save seller into database
        if($income->save()) {
            return response()->json(array("response" => "success", "message" => "Income data updated successfully!"));
        } else {
            return response()->json(array("response" => "failed", "message" => "Unable to update income data at this moment!"));
        }
    }

    // create seller id
    public function delete(Request $request) {

        // delete by id
        if(Income::where('id', $request->id)->delete()) {

            // return with response
            return response()->json(array("response" => "success", "message" => "Income data deleted successfully!"));
        } else {

            // return with response
            return response()->json(array("response" => "failed", "message" => "Unable to delete income data! Please try again later!"));
        }
    }
}
