<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LfSent;
use App\Models\ListedCase;
use Illuminate\Support\Facades\Validator;

class LfSentDataController extends Controller {

    // create seller id
    public function create(Request $request) {

        // validate data
        $validation = Validator::make($request->all(),[
            'linked_case' => 'required|exists:listed_cases,id',
            'settlement_id' => 'required|exists:settlements,id',
            'date' => 'required|date_format:Y-m-d',
            'description' => 'required|min:5|max:1000',
            'amount_sent' => 'required|numeric|min:0',
            'file_upload' => 'required|file|mimes:pdf'
        ]);

        // check if validation fails occured and return the first error
        if($validation->fails()) {
            return response()->json(array("response" => "failed", "message" => $validation->errors()->first()));
        }

        // generate filename
        $file_name = $request->user()->id .'_'. time() . rand() .'.pdf';

        // save the file
        $request->file('file_upload')->storeAs('lfSent', $file_name);

        // declare new seller object
        $lfSent = new lfSent;
        $lfSent->linked_case = $request->linked_case;
        $lfSent->settlement_id = $request->settlement_id;
        $lfSent->date = $request->date;
        $lfSent->description = $request->description;
        $lfSent->amount_sent = $request->amount_sent;
        $lfSent->file_upload = $file_name;

        // save seller into database
        if($lfSent->save()) {
            return response()->json(array("response" => "success", "message" => "LF sent data added into database successfully!"));
        } else {
            return response()->json(array("response" => "failed", "message" => "Unable to add LF sent data at this moment!"));
        }
    }

    // get seller ids
    public function get() {

        // get all sellers and return as response
        return response()->json(array("response" => "success", "data" => LfSent::with("linked_case", "settlement")->get()->all()));
    }

    // update seller id
    public function update(Request $request) {

        // validate data
        $validation = Validator::make($request->all(),[
            'linked_case' => 'required|exists:listed_cases,id',
            'settlement_id' => 'required|exists:settlements,id',
            'date' => 'required|date_format:Y-m-d',
            'description' => 'required|min:5|max:1000',
            'amount_sent' => 'required|numeric|min:0',
            'file_upload' => 'required|file|mimes:pdf'
        ]);

        // check if validation fails occured and return the first error
        if($validation->fails()) {
            return response()->json(array("response" => "failed", "message" => $validation->errors()->first()));
        }

        // generate filename
        $file_name = $request->user()->id .'_'. time() . rand() .'.pdf';

        // save the file
        $request->file('file_upload')->storeAs('lfSent', $file_name);

        // declare new seller object
        $lfSent = LfSent::find($request->id);
        $lfSent->linked_case = $request->linked_case;
        $lfSent->settlement_id = $request->settlement_id;
        $lfSent->date = $request->date;   
        $lfSent->description = $request->description;
        $lfSent->amount_sent = $request->amount_sent;
        $lfSent->file_upload = $file_name;

        // save seller into database
        if($lfSent->save()) {
            return response()->json(array("response" => "success", "message" => "Income data updated successfully!"));
        } else {
            return response()->json(array("response" => "failed", "message" => "Unable to update income data at this moment!"));
        }
    }

    // create seller id
    public function delete(Request $request) {

        // delete by id
        if(LfSent::where('id', $request->id)->delete()) {

            // return with response
            return response()->json(array("response" => "success", "message" => "LF sent data deleted successfully!"));
        } else {

            // return with response
            return response()->json(array("response" => "failed", "message" => "Unable to delete LF sent data! Please try again later!"));
        }
    }
}
