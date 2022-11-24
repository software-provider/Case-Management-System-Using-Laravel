<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class FileHandler extends Controller {

    public function getAgreementFile(Request $request) {

        // return agreement file
        if (Storage::disk('agreements')->exists($request->file)) {
            return response()->file(Storage::disk('agreements')->path($request->file));
        } else {
            abort(404);
        }

    }

    public function getExpenseFile(Request $request) {

        // return agreement file
        if (Storage::disk('expenses')->exists($request->file)) {
            return response()->file(Storage::disk('expenses')->path($request->file));
        } else {
            abort(404);
        }

    }

    public function getLfSentFile(Request $request) {

        // return agreement file
        if (Storage::disk('lfSent')->exists($request->file)) {
            return response()->file(Storage::disk('lfSent')->path($request->file));
        } else {
            abort(404);
        }

    }
}
