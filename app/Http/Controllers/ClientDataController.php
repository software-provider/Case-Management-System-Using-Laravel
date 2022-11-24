<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\ListedCase;
use Illuminate\Support\Facades\Validator;

class ClientDataController extends Controller {

    // create client id
    public function create(Request $request) {

        // validate data              \
        $validation = Validator::make($request->all(),[
            'name' => 'required|min:2|max:50',
            'email' => 'email|required|email:rfc,dns',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:6',
            'address' => 'required|min:5|max:255'
        ], [
            'name' => 'Name must be between 2 to 50 characters long!',
            'email' => 'Invalid email address provided!',
            'phone' => 'Invalid phone number!',
            'address' => 'Address must be between 5 to 255 character long!'
        ]);

        // check if validation fails occured and return the first error
        if($validation->fails()) {
            return response()->json(array("response" => "failed", "message" => $validation->errors()->first()));
        }

        // declare new client object
        $client = new Client;
        $client->name = $request->name;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->address = $request->address;

        // save client into database
        if($client->save()) {
            return response()->json(array("response" => "success", "message" => "Client added into database successfully!"));
        } else {
            return response()->json(array("response" => "failed", "message" => "Unable to add client at this moment!"));
        }
    }

    // get client ids
    public function get() {

        // get all sellers and return as response
        return response()->json(array("response" => "success", "data" => Client::select('id','name','email','phone','address','created_at','updated_at')->get()->all()));
    }

    // search get client ids
    public function getList(Request $request) {

        // return list matching the query
        return response()->json(array("response" => "success", "data" => Client::select('id','name')->get()->all()));   
    }

    // update client id
    public function update(Request $request) {

        // validate data
        $validation = Validator::make($request->all(),[
            'name' => 'required|min:2|max:50',
            'email' => 'email|required|email:rfc,dns',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:6',
            'address' => 'required|min:5|max:255'
        ], [
            'name' => 'Name must be between 2 to 50 characters long!',
            'email' => 'Invalid email address provided!',
            'phone' => 'Invalid phone number!',
            'address' => 'Adressm must be between 5 to 255 character long!'
        ]);

        // check if validation fails occured and return the first error
        if($validation->fails()) {
            return response()->json(array("response" => "failed", "message" => $validation->errors()->first()));
        }

        // declare new client object
        $client = Client::find($request->id);
        $client->name = $request->name;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->address = $request->address;

        // save seller into database
        if($client->save()) {
            return response()->json(array("response" => "success", "message" => "Seller data updated successfully!"));
        } else {
            return response()->json(array("response" => "failed", "message" => "Unable to update seller at this moment!"));
        }
    }

    // delete client id
    public function delete(Request $request) {

        // check if client id being use in any case
        if(ListedCase::where('client', $request->id)->count() > 0) {

            // return with response
            return response()->json(array("response" => "success", "message" => "You can not delete this client account as it is being used by one or more than one cases!"));
        }

        // delete by id
        if(Client::where('id', $request->id)->delete()) {

            // return with response
            return response()->json(array("response" => "success", "message" => "Client account deleted successfully!"));
        } else {

            // return with response
            return response()->json(array("response" => "failed", "message" => "Unable to delete client account! Please try again later!"));
        }
    }
}
