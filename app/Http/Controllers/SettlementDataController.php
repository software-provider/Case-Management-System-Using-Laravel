<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Settlement;
use App\Models\SettlementSeller;
use Illuminate\Support\Facades\Validator;
use Storage;

class SettlementDataController extends Controller {

    // create settlement
    public function create(Request $request) {

        // validate data
        $validation = Validator::make($request->all(),[
            'linked_case' => 'required|exists:listed_cases,id',
            'offered_amount' => 'required|numeric|min:0',
            'marketplace' => 'required|exists:marketplaces,id',
            'representatives' => 'required|exists:representatives,id',
            'status' => 'in:Agreed,Agreement Signed,Contacted,Dismissed,Money Received,Negotiation in Progress',
            'agreement_file' => 'file|mimes:pdf',
            'target' => 'required|numeric|min:0',
            'money_received' => 'required|numeric|min:0'
        ]);

        // check if validation fails occured and return the first error
        if($validation->fails()) {
            return response()->json(array("response" => "failed", "message" => $validation->errors()->first()));
        }

        $seller_counter = 0;
        // now check if seller exist or not
        if(isset($request->sellers)) {
            $sellers = explode (",", $request->sellers);
            foreach($sellers as $key => $value) {
                $seller_counter++;
            }
        }

        if($seller_counter < 1) {
            return response()->json(array("response" => "failed", "message" => "Please select at least one seller!"));
        }

        // generate filename
        $file_name = $request->user()->id .'_'. time() . rand() .'.pdf';

        // save the file
        $request->file('agreement_file')->storeAs('agreements', $file_name);

        // declare new settlement object
        $settlement = new Settlement;
        $settlement->linked_case = $request->linked_case;
        $settlement->settlement_agreement_file = $file_name;
        $settlement->offered_amount = $request->offered_amount;
        $settlement->marketplace = $request->marketplace;
        $settlement->representatives = $request->representatives;
        $settlement->status = $request->status;
        $settlement->target = $request->target;
        $settlement->money_received = $request->money_received;

        // save settlement into database
        if($settlement->save()) {
            $sellers = explode (",", $request->sellers);
            foreach($sellers as $key => $value) {
                $settlementSeller = new SettlementSeller;
                $settlementSeller->linked_case = $request->linked_case;
                $settlementSeller->linked_seller = $value;
                $settlementSeller->linked_settlement = $settlement->id;
                $settlementSeller->save();
            }
            return response()->json(array("response" => "success", "message" => "Settlement added into database successfully!"));
        } else {
            return response()->json(array("response" => "failed", "message" => "Unable to add settlement at this moment!"));
        }
    }

    // get settlements
    public function get() {

        // get all sellers and return as response
        return response()->json(array("response" => "success", "data" => Settlement::with("linked_case")->select("settlements.*", "marketplaces.marketplace_name", "representatives.representative_name")->leftJoin("marketplaces", "settlements.marketplace", "=", "marketplaces.id")->leftJoin("representatives", "settlements.representatives", "=", "representatives.id")->get()->all()));
    }

    // get settlements
    public function getSettlementList() {

        // get all sellers and return as response
        return response()->json(array("response" => "success", "data" => Settlement::select("id", "id as name")->get()->all()));
    }

    // update settlement by id
    public function update(Request $request) {

        // validate data
        $validation = Validator::make($request->all(),[
            'id' => 'required|exists:settlements,id',
            'linked_case' => 'required|exists:listed_cases,id',
            'offered_amount' => 'required|numeric|min:0',
            'marketplace' => 'required|exists:marketplaces,id',
            'representatives' => 'required|exists:representatives,id',
            'status' => 'in:Agreed,Agreement Signed,Contacted,Dismissed,Money Received,Negotiation in Progress',
            'agreement_file' => 'required|file|mimes:pdf',
            'target' => 'required|numeric|min:0',
            'money_received' => 'required|numeric|min:0'
        ]);

        // check if validation fails occured and return the first error
        if($validation->fails()) {
            return response()->json(array("response" => "failed", "message" => $validation->errors()->first()));
        }

        $seller_counter = 0;
        // now check if seller exist or not
        if(isset($request->sellers)) {
            $sellers = explode (",", $request->sellers);
            foreach($sellers as $key => $value) {
                $seller_counter++;
            }
        }

        if($seller_counter < 1) {
            return response()->json(array("response" => "failed", "message" => "Please select at least one seller!"));
        }

        // generate filename
        $file_name = $request->user()->id .'_'. time() . rand() .'.pdf';

        // save the file
        $request->file('agreement_file')->storeAs('agreements', $file_name);

        // get the settlement by id
        $settlement = Settlement::find($request->id);

        // get old seller from settlement seller
        $settlement_seller = SettlementSeller::where("linked_settlement", "=", $request->id);

        // delete old seller from settlement seller
        if($settlement_seller) {
            $settlement_seller->delete();
        }

        // update other fields
        $settlement->linked_case = $request->linked_case;
        $settlement->settlement_agreement_file = $file_name;
        $settlement->offered_amount = $request->offered_amount;
        $settlement->marketplace = $request->marketplace;
        $settlement->representatives = $request->representatives;
        $settlement->status = $request->status;
        $settlement->target = $request->target;
        $settlement->money_received = $request->money_received;

        // save settlement into database
        if($settlement->save()) {
            $sellers = explode (",", $request->sellers);
            foreach($sellers as $key => $value) {
                $settlementSeller = new SettlementSeller;
                $settlementSeller->linked_case = $request->linked_case;
                $settlementSeller->linked_seller = $value;
                $settlementSeller->linked_settlement = $request->id;
                $settlementSeller->save();
            }
            return response()->json(array("response" => "success", "message" => "Settlement data updated successfully!"));
        } else {
            return response()->json(array("response" => "failed", "message" => "Unable to update settlement at this moment!"));
        }
    }

    // delete settlement id
    public function delete(Request $request) {

        // get old seller from settlement seller
        $settlement_seller = SettlementSeller::where("linked_settlement", "=", $request->id);

        // delete old seller from settlement seller
        if($settlement_seller) {
            $settlement_seller->delete();
        }

        // delete by id
        if(Settlement::where('id', $request->id)->delete()) {

            // return with response
            return response()->json(array("response" => "success", "message" => "Settlement deleted successfully!"));
        } else {

            // return with response
            return response()->json(array("response" => "failed", "message" => "Unable to delete settlement account! Please try again later!"));
        }
    }
}
