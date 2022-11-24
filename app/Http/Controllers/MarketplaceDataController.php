<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marketplace;

class MarketplaceDataController extends Controller{

    // get all marketplaces
    public function getMarketplaces() {

        return response()->json(array("response" => "success", "data" => Marketplace::select("id", "marketplace_name as name")->get()->all()));
    }
}
