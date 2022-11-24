<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Representative;

class RepresentativeDataController extends Controller{

    // get all marketplaces
    public function getRepresentatives() {

        return response()->json(array("response" => "success", "data" => Representative::select("id", "representative_name as name")->get()->all()));
    }
}
