<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LfReceived;
use App\Models\ListedCase;
use Illuminate\Support\Facades\Validator;

class LfReceivedDataController extends Controller {

    // create seller id
    public function create(Request $request) {

        // validate data
        $validation = Validator::make($request->all(),[
            'linked_case' => 'required|exists:listed_cases,id',
            'type' => 'required|in:Settlement,Default',
            'comment' => 'required|min:5|max:1000'
        ]);

        // check if validation fails occured and return the first error
        if($validation->fails()) {
            return response()->json(array("response" => "failed", "message" => $validation->errors()->first()));
        }

        // declare new seller object
        $lfReceived = new LfReceived;
        $lfReceived->linked_case = $request->linked_case;
        $lfReceived->type = $request->type;
        $lfReceived->comment = $request->comment;

        // save seller into database
        if($lfReceived->save()) {
            return response()->json(array("response" => "success", "message" => "LF Received data added into database successfully!"));
        } else {
            return response()->json(array("response" => "failed", "message" => "Unable to add LF received data at this moment!"));
        }
    }

    // get seller ids
    public function get() {

        // get all sellers and return as response
        return response()->json(array("response" => "success", "data" => LfReceived::with("linked_case")->get()->all()));
    }

    // update seller id
    public function update(Request $request) {

        // validate data
        $validation = Validator::make($request->all(),[
            'linked_case' => 'required|exists:listed_cases,id',
            'type' => 'required|in:Settlement,Default',
            'comment' => 'required|min:5|max:1000'
        ]);

        // check if validation fails occured and return the first error
        if($validation->fails()) {
            return response()->json(array("response" => "failed", "message" => $validation->errors()->first()));
        }

        // declare new seller object
        $lfReceived = LfReceived::find($request->id);
        $lfReceived->linked_case = $request->linked_case;
        $lfReceived->type = $request->type;
        $lfReceived->comment = $request->comment;

        // save seller into database
        if($lfReceived->save()) {
            return response()->json(array("response" => "success", "message" => "LF received data updated successfully!"));
        } else {
            return response()->json(array("response" => "failed", "message" => "Unable to update LF received data at this moment!"));
        }
    }

    // create seller id
    public function delete(Request $request) {

        // delete by id
        if(LfReceived::where('id', $request->id)->delete()) {

            // return with response
            return response()->json(array("response" => "success", "message" => "LF received data deleted successfully!"));
        } else {

            // return with response
            return response()->json(array("response" => "failed", "message" => "Unable to delete LF received data! Please try again later!"));
        }
    }
}
