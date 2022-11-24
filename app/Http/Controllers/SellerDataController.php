<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seller;
use App\Models\Income;
use App\Models\SettlementSeller;
use App\Models\ListedCase;
use Illuminate\Support\Facades\Validator;

class SellerDataController extends Controller {

    // create seller id
    public function create(Request $request) {

        // validate data
        $validation = Validator::make($request->all(),[
            'doe' => 'numeric|required',
            'name' => 'required|min:2|max:50',
            'total_amount_frozen' => 'required|numeric',
            'units_sold' => 'numeric|min:0|nullable',
            'product_gmv' => 'numeric|min:0|nullable',
            'amount_frozen_usd' => 'numeric|min:0|nullable',
            'amount_frozen_cny' => 'numeric|min:0|nullable',
            'marketplace' => 'required|exists:marketplaces,id',
            'linked_case' => 'required|exists:listed_cases,id',
            'product_url' => 'required|url',
            'store_url' => 'required|url'
        ]);

        // check if validation fails occured and return the first error
        if($validation->fails()) {
            return response()->json(array("response" => "failed", "message" => $validation->errors()->first()));
        }

        // declare new seller object
        $seller = new Seller;
        $seller->doe = $request->doe;
        $seller->name = $request->name;
        $seller->total_amount_frozen = $request->total_amount_frozen;
        $seller->units_sold = $request->units_sold;
        $seller->product_gmv = $request->product_gmv;
        $seller->amount_frozen_usd = $request->amount_frozen_usd;
        $seller->amount_frozen_cny = $request->amount_frozen_cny;
        $seller->marketplace = $request->marketplace;
        $seller->linked_case = $request->linked_case;
        $seller->product_url = $request->product_url;
        $seller->store_url = $request->store_url;

        // save seller into database
        if($seller->save()) {
            return response()->json(array("response" => "success", "message" => "Seller added into database successfully!"));
        } else {
            return response()->json(array("response" => "failed", "message" => "Unable to add seller at this moment!"));
        }
    }

    // get seller ids
    public function get() {

        // get all sellers and return as response
        return response()->json(array("response" => "success", "data" => Seller::with('marketplace', 'linked_case')->get()->all()));
    }

    // search get seller ids
    public function getList(Request $request) {

        // return list matching the query
        return response()->json(array("response" => "success", "data" => Seller::select('id','name', 'total_amount_frozen')->get()->all()));
    }

    // update seller id
    public function update(Request $request) {

        // validate data
        $validation = Validator::make($request->all(),[
            'doe' => 'numeric|required',
            'name' => 'required|min:2|max:50',
            'total_amount_frozen' => 'required|numeric',
            'units_sold' => 'numeric',
            'product_gmv' => 'numeric',
            'amount_frozen_usd' => 'numeric',
            'amount_frozen_cny' => 'numeric',
            'marketplace' => 'required|exists:marketplaces,id',
            'linked_case' => 'required|exists:listed_cases,id',
            'product_url' => 'required|url',
            'store_url' => 'required|url'
        ]);

        // check if validation fails occured and return the first error
        if($validation->fails()) {
            return response()->json(array("response" => "failed", "message" => $validation->errors()->first()));
        }

        // declare new seller object
        $seller = Seller::find($request->id);
        $seller->doe = $request->doe;
        $seller->name = $request->name;
        $seller->total_amount_frozen = $request->total_amount_frozen;
        $seller->units_sold = $request->units_sold;
        $seller->product_gmv = $request->product_gmv;
        $seller->amount_frozen_usd = $request->amount_frozen_usd;
        $seller->amount_frozen_cny = $request->amount_frozen_cny;
        $seller->marketplace = $request->marketplace;
        $seller->linked_case = $request->linked_case;
        $seller->product_url = $request->product_url;
        $seller->store_url = $request->store_url;

        // save seller into database
        if($seller->save()) {
            return response()->json(array("response" => "success", "message" => "Seller data updated successfully!"));
        } else {
            return response()->json(array("response" => "failed", "message" => "Unable to update seller at this moment!"));
        }
    }

    // create seller id
    public function delete(Request $request) {

        try {

            // try to delete the seller
            Seller::where('id', $request->id)->delete();
            return response()->json(array("response" => "success", "message" => "Seller account deleted successfully!"));
        } catch (\Illuminate\Database\QueryException $e) {

            // return with error response
            return response()->json(array("response" => "success", "message" => "You can not delete this seller account as it is being used!"));
        }
    }
}
