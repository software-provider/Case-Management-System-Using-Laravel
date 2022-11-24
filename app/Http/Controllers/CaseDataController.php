<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListedCase;
use Illuminate\Support\Facades\Validator;
use DB;

class CaseDataController extends Controller {

    // create case
    public function create(Request $request) {

        // validate data
        $validation = Validator::make($request->all(),[
            'client' => 'required|exists:users,id',
            'law_firm' => 'required|exists:users,id',
            'allowed_user' => 'required|exists:users,id',
            'status' => 'required|in:Active,Inactive',
            'lf_fee' => 'required|numeric|min:0',
            'axs_fee' => 'required|numeric|min:0'
        ]);

        // check if validation fails occured and return the first error
        if($validation->fails()) {
            return response()->json(array("response" => "failed", "message" => $validation->errors()->first()));
        }

        // declare new case object
        $case = new ListedCase;
        $case->client = $request->client;
        $case->law_firm = $request->law_firm;
        $case->allowed_user = $request->allowed_user;
        $case->status = $request->status;
        $case->lf_fee = $request->lf_fee;
        $case->axs_fee = $request->axs_fee;

        // save case into database
        if($case->save()) {
            return response()->json(array("response" => "success", "message" => "Case added into database successfully!"));
        } else {
            return response()->json(array("response" => "failed", "message" => "Unable to add case at this moment!"));
        }
    }

    // get cases
    public function get() {

        // get all sellers and return as response
        return response()->json(array("response" => "success", "data" => ListedCase::with('client','law_firm','allowed_user')->get()->all()));
    }


    // search and get case ids
    public function getList(Request $request) {

        // return list matching the query
        return response()->json(array("response" => "success", "data" => ListedCase::select("id", "id as name")->get()->all()));
    }

    // update case by id
    public function update(Request $request) {

        // validate data
        $validation = Validator::make($request->all(),[
            'client' => 'required|exists:clients,id',
            'law_firm' => 'required|exists:users,id',
            'allowed_user' => 'required|exists:users,id',
            'status' => 'required|in:Active,Inactive',
            'lf_fee' => 'required|numeric|min:0',
            'axs_fee' => 'required|numeric|min:0'
        ]);

        // check if validation fails occured and return the first error
        if($validation->fails()) {
            return response()->json(array("response" => "failed", "message" => $validation->errors()->first()));
        }

        // declare new seller object
        $case = ListedCase::find($request->id);
        $case->client = $request->client;
        $case->law_firm = $request->law_firm;
        $case->allowed_user = $request->allowed_user;
        $case->status = $request->status;
        $case->lf_fee = $request->lf_fee;
        $case->axs_fee = $request->axs_fee;

        // save case into database
        if($case->save()) {
            return response()->json(array("response" => "success", "message" => "Case data updated successfully!"));
        } else {
            return response()->json(array("response" => "failed", "message" => "Unable to update case at this moment!"));
        }
    }

    // delete case
    public function delete(Request $request) {

        try {
            // try to delete the case and return success
            $case = ListedCase::find($request->id)->delete();
            return response()->json(array("response" => "success", "message" => "Case data deleted successfully!"));
        } catch (\Illuminate\Database\QueryException $e) {
            // return with error response
            return response()->json(array("response" => "failed", "message" => "Failed to delete case as it is already being used!"));
        }
    }
}
